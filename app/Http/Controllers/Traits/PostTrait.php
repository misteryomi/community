<?php

namespace App\Http\Controllers\Traits;

use App\Community;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsListCollection;
use App\Post;
use App\User;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Traits\ContentTrait;

use \Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Route;
use App\Http\Controllers\SEOTrait;

trait PostTrait
{

    use SEOTrait, ContentTrait;

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
     * Display post
     * @param $post_id post_id of the post
     * @return response
     */
    public function show(Request $request, Post $post) {
        $comments = $post->comments()->paginate(SELF::$PAGINATION_LIMIT);
        $related = $this->post->relatedTopics($post)->take(8)->get();

        $this->preShow($request, $post);

        return view('posts.show', compact('post', 'comments', 'related'));
    }



    public function delete(Post $post) {
        $post->delete();

        return redirect()->back()->withMessage('Topic deleted successfully!');

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

    protected function preShow($request, $post) {

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

        $this->setSEO($post->title, $post->excerpt, route('posts.show', ['post' => $post->slug]), $post->featured_image);

    }

    protected function preSubmit($requestData) {


        $validation =  Validator::make($requestData, [
            'title' => 'required|max:255',
            'details' => 'required',
            'community_id' => 'required'
        ]);

        if($validation->fails()) {
         return redirect()->back()->withErrors($validation->errors())->withInput()->send();
        }


        $newID = $this->post->count() + 1;
        $requestData['slug'] = \Str::slug(substr($requestData['title'], 0, 50), '-').'-'.$newID;

        $post = $this->user->posts()->create($requestData);

        $this->user->coins->increment('balance', 2);

        return $post;

    }



    protected function postSubmit($request, $post) {
        //Notify all mentions
        $mentions = $this->fetchMentions($request->details);

        if(count($mentions) > 0) {
            $this->notifyMentions($post, null, $mentions);
        }        
    }


    protected function preUpdate($request, $post) {
        if(!$this->user->canEditPost($post)) {
            abort(404);
        }

        //only owner or moderator can edit

        $requestData = isset($this->meta_fields) ? $request->except($this->meta_fields) : $request->all();
        $validation =  Validator::make($requestData, [
                        'title' => 'required|max:255',
                        'details' => 'required'
                        // 'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $post->update($requestData);

    }
}
