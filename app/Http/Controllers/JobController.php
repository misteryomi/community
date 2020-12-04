<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsListCollection;
use App\Post;
use App\User;
use App\Mood;
use App\Community;
use App\JobMeta;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Traits\ContentTrait;
use App\Http\Controllers\Traits\PostTrait;

use \Carbon\Carbon;

use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    use PostTrait;

    private $post;
    private $user;
    private $agent;

    private static $PAGINATION_LIMIT = 20;

    function __construct(Post $post, Community $community, JobMeta $meta) {
        $this->post = $post;
        $this->category = $community;
        $this->meta = $meta;
        $this->agent = new Agent();
        $this->job_community = $community->where('name', 'jobs')->first();

        $this->middleware(function($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });

    }



    /**
     * Display feed of all posts
     * @return response
     */
    public function all(Request $request) {
        $agent = $this->agent;
        $community = $this->job_community;

        $posts = $this->post->where('community_id', $community->id)->orWhereHas('community', function($query) use($community) {

                    $query->where('parent_id', $community->id);

                })->latest();
                
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $title = 'Latest Jobs Listing';

        return view('jobs.list', compact('posts', 'agent', 'title'));
    }





    /**
     * Create new Post
     * @return view
     */
    public function new() {

        $community = $this->job_community;
        $communities = $this->category->where('parent_id', $this->job_community->id)->ordered();

        return view('jobs.new', compact('communities', 'community'));
    }



    /**
     * Create a new post
     * @param $request
     * @return response
     */
    public function store(Request $request) {

        $requestData = $request->all();

        $post = $this->preSubmit($requestData);

        $this->meta->create([
            'post_id' => $post->id,
        ]);

        $this->postSubmit($request, $post);

        return redirect()->route('jobs.show', ['post' => $post->slug]);

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

        $communities = $this->category->where('parent_id', $this->job_community->id)->ordered();

        return view('jobs.new', compact('post', 'communities', 'community'))->withIsEdit(true);
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

      

        return redirect()->route('jobs.show', ['post' => $post->slug]);
    }


}
