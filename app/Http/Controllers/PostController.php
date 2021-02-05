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
use App\PostType;
use App\Comment;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Traits\PostTrait;
use Illuminate\Notifications\Notification;
use App\Notifications\NewPost;
use \Carbon\Carbon;
use \Facebook\Facebook;

use OneSignal;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Route;

class PostController extends Controller
{
    use SEOTrait, PostTrait;

    private $post;
    private $comment;
    private $community;
    private $user;
    private $agent;

    private static $PAGINATION_LIMIT = 20;

    function __construct(Post $post, Community $community, User $users) {
        $this->post = $post;
        $this->users = $users;
        $this->category = $community;
        $this->agent = new Agent();
        $this->post_type = PostType::where('name', 'topics')->first();

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


        $engagements = $this->post->highestEngagements(Carbon::now()->subtract(7, 'years'), Carbon::now())->take(5)->get();

        if($this->user && $this->user->settings && $this->user->settings->feed_type == 'communities') {
            $posts = $this->user->communitiesTopics()->latest()->paginate(SELF::$PAGINATION_LIMIT);
        } else {
            $posts = $this->post->where('is_featured', 1)->take('30')->latest()->paginate(SELF::$PAGINATION_LIMIT);
        }

        $communities = \App\Community::where('is_parent', true)->get(); //->ordered();
        
        $isHomepage = true;
        $displayTopicsType = true;

        if($request->feed_type) {

            if(!$this->user) return redirect('login');

            $this->user->settings()->updateOrCreate(['user_id' => $this->user->id], ['feed_type' => $request->feed_type]);
            return redirect()->route('home');
        }

        $trending = $this->getTrending()->take(7)->get();

        return view('welcome', compact('posts', 'communities', 'isHomepage', 'agent', 'trending', 'displayTopicsType', 'engagements'));
    }


    /**
     * Had to use this hack because I don't want users accessing other post types under the 'topics' route
     */
    public function showPost(Request $request, Post $post) {
        //check post type then redirect to respective url

        if($post->post_type == null || $post->type->name == 'topics') {
            return $this->show($request, $post);
        }

        //redirect to respective route
        return redirect()->route($post->type->name.'.show', ['post' => $post->slug]);
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


        if($this->user && $this->user->settings && $this->user->settings->feed_type == 'communities') {
            $posts = $this->user->communitiesTopics()->latest();
        } else {
            $posts = $this->post->latest();
        }
        
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $communities = $this->category->where('is_featured', true)->get();

        $title = 'Latest Topics';
        $displayTopicsType = true;

        return view('posts.list', compact('posts', 'communities', 'title', 'agent', 'displayTopicsType'));
    }    

    public function trending(Request $request) {
        $agent = $this->agent;

        $posts = $this->getTrending();
        
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $communities = $this->category->where('is_featured', true)->get();

        $title = 'Trending Topics';

        return view('posts.list', compact('posts', 'communities', 'title', 'agent'));
    }    

    public function saved(Request $request) {
        $agent = $this->agent;

        $posts = $this->post->whereHas('bookmarks')->paginate(SELF::$PAGINATION_LIMIT);
        
        $title = 'My Bookmarks';

        return view('posts.list', compact('posts', 'agent', 'title'));
    }

    public function liked(Request $request) {
        $agent = $this->agent;

        $posts = $this->post->whereHas('likes')->paginate(SELF::$PAGINATION_LIMIT);
        
        $title = 'My Liked Topics';

        return view('posts.list', compact('posts', 'agent', 'title'));
    }

    private function getTrending() {
       $trending =  $this->post->withCount('views')->whereBetween('created_at', [Carbon::now()->subDays(7), now()])->orderBy('views_count', 'DESC');

       if(!$trending->count()) {
            $trending =  $this->post->withCount('views')->orderBy('views_count', 'DESC');
       }

       return $trending;
    }


    /**
     * Create new Post
     * @return view
     */
    public function new($community = null) {
        $community = $this->category->where('slug', $community)->first();

        if(!$community) {
            $communities = auth()->user()->followedCommunities()->ordered();
            // $communities = $this->category->ordered(); //->where('is_parent', true)->
        } else {
            $communities = $this->category->where('parent_id', $community->id)->ordered();

        }

        return view('posts.new', compact('communities', 'community'));
    }



    /**
     * Create a new post
     * @param $request
     * @return response
     */
    public function store(Request $request) {

    
        $requestData = $request->all();

        $post = $this->preSubmit($requestData);

        $this->postSubmit($request, $post);

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

        $communities = $this->category->where('is_parent', true)->ordered();

        return view('posts.new', compact('post', 'communities'))->withIsEdit(true);
    }


    /**
     * Update Modified Post
     * @return response
     */
    public function update(Request $request, Post $post) {

        $this->preUpdate($request, $post);
        
        return redirect()->route('posts.show', ['post' => $post->slug]);
    }

    
    public function setFeatured(Request $request, Post $post) {

        if(!$post->canModerate()) {
            return redirect()->back()->withError('You are not authorized to perform this action');
        }

        $post->update([
            'is_featured' => true
        ]);


        // dd($post->notify(new NewPost($post)));

    //     $this->sendPushNotification($post);
    //    dd($post->notify());

        // $this->sendPushNotification($post);
       $this->shareOnFB($post);

        return redirect()->back()->withMessage('Successfully set as Featured!');
    }

    public function removeFeatured(Request $request, Post $post) {

        if(!$post->canModerate()) {
            return redirect()->back()->withError('You are not authorized to perform this action');
        }

        $post->update([
            'is_featured' => false
        ]);

        return redirect()->back()->withMessage('Successfully removed from Featured!');
    }

    private function shareOnFB($post) {

        try {

            $fb = new Facebook([
                'app_id' => '4048791958483854',
                'app_secret' => 'd98eac1cbb6ef96415e6ef7b0d34c16a',
//                'default_graph_version' => 'v2.10',
                // 'default_access_token' => 'EAA5iWtZA0c44BANkYM3C10yRcYek983JdCjdxCOHOmPknXUTZAf2aT0qe9vRtCYSDyaBuT8nZAfZAOENFGC9Ioqrbp8v6fHrFeWQdEEAZA41a9uOkDZCi49RsqOUulv9gUSnsatzKFF9c3Eu9JZAcr9a3swnkj69h0xoiEBZCQDjG7oejnBPZB9eeP18cq8JCqPwZD'
            ]);

            $accessToken = 'EAA5iWtZA0c44BAIwrGGsD1RCuoAXIi18rpMZAxnIfduV6dloKUM2jYzvtGlZAanhZBtPZA6hdKYijIrOZALAq9vbFaIXoe7qzurmwBGdZCa1B1AHgYDMGwBqjh3kMGl0P3ZA7dMnXET3TSkoZBGZAD9XInzr07MZCxFAmQZD';

            $url = route('posts.show', ['post' => $post->slug]); //'https://jaracentral.com';
            $excerpt = html_entity_decode($post->excerpt);

            $response = $fb->post('/150796238294196/feed', ['message' => "$post->title\n\n\n$excerpt\n\nContinue reading: $url", 'link' => $url ], $accessToken);

        } catch(\Exception $e) {
            // dd($e);d
        }
        
    }

    public function sendPushNotification($post) {
        try {

            OneSignal::sendNotificationToAll(
                // "Some Message", 
                $post->title, 
                $url = route('posts.show', ['post' => $post->slug]), //'http://jaracentral.com/',
                $data = null, 
            );
        } catch (\Exception $e) {
            dd($e);
        }
    }


}
