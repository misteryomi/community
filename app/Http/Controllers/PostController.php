<?php

namespace App\Http\Controllers;

use App\Community;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsListCollection;
use App\Post;
use App\User;
use Jenssegers\Agent\Agent;

use \Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Route;

class PostController extends Controller
{
    use SEOTrait;

    private $post;
    private $community;
    private $user;
    private $agent;

    private static $PAGINATION_LIMIT = 20;

    function __construct(Post $post, Community $community) {
        $this->post = $post;
        $this->category = $community;
        $this->agent = new Agent();

        $this->middleware(function($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });

    }


    /**
     * Display feed of {featured} posts
     * @return response
     */
    public function index(Request $request) {
        $agent = $this->agent;


        if($this->user && $this->user->settings && $this->user->settings->feed_type == 'communities') {
            $posts = $this->user->communitiesTopics()->latest()->paginate(SELF::$PAGINATION_LIMIT);
        } else {
            $posts = $this->post->where('is_featured', 1)->take('30')->latest()->paginate(SELF::$PAGINATION_LIMIT);
        }

        $communities = \App\Community::where('is_parent', true)->get(); //->ordered();
        
        $isHomepage = true;

        if($request->feed_type && $this->user) {
            $this->user->settings()->updateOrCreate(['user_id' => $this->user->id], ['feed_type' => $request->feed_type]);
            return redirect()->route('home');
        }

        $trending = $this->getTrending()->take(7)->get();

        return view('welcome', compact('posts', 'communities', 'isHomepage', 'agent', 'trending'));
    }


    /**
     * Display feed of all posts
     * @return response
     */
    public function all(Request $request) {
        $agent = $this->agent;

        $posts = $this->post->latest();
        
        if($request->has('q')) {
           $posts =  $posts->where('title', 'like', '%'.$request->q.'%')->orWhere('details', 'like', '%'.$request->q.'%');
        }
        
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $communities = $this->category->where('is_featured', true)->get();

        return view('posts.list', compact('posts', 'communities', 'agent'));
    }


    public function latest(Request $request) {
        $agent = $this->agent;

        $posts = $this->post->latest();
        
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $communities = $this->category->where('is_featured', true)->get();

        $title = 'Latest Topics';

        return view('posts.list', compact('posts', 'communities', 'title', 'agent'));
    }    

    public function trending(Request $request) {
        $agent = $this->agent;

        $posts = $this->getTrending();
        
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $communities = $this->category->where('is_featured', true)->get();

        $title = 'Trending Topics';

        return view('posts.list', compact('posts', 'communities', 'title', 'agent'));
    }    


    private function getTrending() {
       return $this->post->withCount('views')->whereBetween('created_at', [Carbon::now()->subDays(7), now()])->orderBy('views_count', 'DESC');
    }
    /**
     * Display post
     * @param $post_id post_id of the post
     * @return response
     */
    public function show(Request $request, Post $post) {
        $comments = $post->comments()->paginate(SELF::$PAGINATION_LIMIT);

        $session_id =  $request->getSession()->getId();

        $guestHasViewed = !$this->user && $post->views()->where('session_id', $session_id)->first();

        $loggedInUserHasViewed = $this->user && $post->views()->where('user_id', $this->user->id)->first();

        $hasViewed = $this->user ? $loggedInUserHasViewed : $guestHasViewed;

        if(!$hasViewed) {
            $post->views()->create([
                'session_id' => $session_id,
                'ip' => $request->getClientIp(),
                'agent' => $request->header('User-Agent'),
                'user_id' => $this->user ? $this->user->id : null,
                'created_at' => now(),
            ]);
        }

        $this->setSEO($post->title, $post->excerpt, route('posts.show', ['post' => $post->slug]));

        $related = $this->post->relatedTopics()->take(8)->get();

        return view('posts.show', compact('post', 'comments', 'related'));
    }



    /**
     * Create new Post
     * @return view
     */
    public function new($community = null) {
        $community = $this->category->where('slug', $community)->first();

        if(!$community) {
            $categories = $this->category->ordered(); //->where('is_parent', true)->
        } else {
            $categories = $this->category->where('parent_id', $community->id)->ordered();
        }

        return view('posts.new', compact('categories', 'community'));
    }



    /**
     * Create a new post
     * @param $request
     * @return response
     */
    public function store(Request $request) {

    
        $requestData = $request->all();
        $validation =  Validator::make($requestData, [
                        'title' => 'required|max:255',
                        'details' => 'required',
                        'community_id' => 'required'
                        // 'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }


    

        $newID = $this->post->count() + 1;
        $requestData['slug'] = \Str::slug($requestData['title'], '-').'-'.$newID;
        $post = $this->user->posts()->create($requestData);


                
        //Fetch images in this post
        $images = $this->fetchImages($request->details);

        if(count($images) > 0) {
            $this->updateMedia($post, $images);
        }

        //Notify all mentions
        $mentions = $this->fetchMentions($request->details);

        if(count($mentions) > 0) {
            $this->notifyMentions($post, $mentions);
        }


        return redirect()->route('posts.show', ['post' => $post->slug]);

    }


    /**
     * Modify Post
     * @return view
     */
    public function edit(Post $post) {

        if(!$this->user->canEditPost($post)) {
            abort(404);
        }
                //only owner or moderator can edit

        $categories = $this->category->where('is_parent', true)->ordered();

        return view('posts.new', compact('post', 'categories'))->withIsEdit(true);
    }


    /**
     * Update Modified Post
     * @return response
     */
    public function update(Request $request, Post $post) {
        if(!$this->user->canEditPost($post)) {
            abort(404);
        }

        //only owner or moderator can edit

        $requestData = $request->all();
        $validation =  Validator::make($requestData, [
                        'title' => 'required|max:255',
                        'details' => 'required'
                        // 'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $post->update($requestData);

                 
        //Fetch images in this post
        $images = $this->fetchImages($request->details);

        if(count($images) > 0) {
            $this->updateMedia($post, $images);
        }

        return redirect()->route('posts.show', ['post' => $post->slug]);
    }

    
    public function delete(Post $post) {
        $post->delete();

        return redirect()->route('profile.show', ['user' => $this->user->username])->withMessage('Topic deleted successfully!');

    }

    public function like(Post $post) {

        $post->likes()->firstOrCreate(['user_id' => $this->user->id], ['created_at' => now()]);

        return response(['status' => true]);
    }

    public function unlike(Post $post) {

        $post->likes()->where('user_id', $this->user->id)->delete();

        return response(['status' => true]);
    }


    public function bookmark(Post $post) {

        $post->bookmarks()->firstOrCreate(['user_id' => $this->user->id], ['created_at' => now()]);

        return response(['status' => true]);
    }

    public function removeBookmark(Post $post) {

        $post->bookmarks()->where('user_id', $this->user->id)->delete();

        return response(['status' => true]);
    }


    private function fetchMentions($post) {
        $post =  html_entity_decode(strip_tags($post));
        preg_match_all('/@(?=.*\w)[\w]{2,}/', $post, $matches);


        return $matches[0];
    }

    private function notifyMentions($mentions){

        foreach($mentions as $mention) {
            $username = str_replace('@', '', $mention);
            $checkExists = $this->user->where('username', $username)->count();

            if($checkExists) {
                //Send Notification of mention here
            }
        }
        
    }

    
    private function updateMedia($post, $images) {
        \App\PostMedia::whereIn('url', $images)->update(['post_id' => $post->id]);
    }


    private function fetchImages($text) {
        $htmlDom = new \DOMDocument;


        @$htmlDom->loadHTML($text);
        
        $imageTags = $htmlDom->getElementsByTagName('img');
        
        //Create an array to add extracted images to.
        $extractedImages = array();
        
        //Loop through the image tags that DOMDocument found.
        foreach($imageTags as $imageTag){
        
            //Get the src attribute of the image.
            $imgSrc = $imageTag->getAttribute('src');        
        
            //Add the image details to our $extractedImages array.
            $extractedImages[] = $imgSrc;
        }
        
        //var_dump our array of images.
        return($extractedImages);        
    }
}
