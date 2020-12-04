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
use App\RantMeta;
use App\Community;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Traits\ContentTrait;
use App\Http\Controllers\Traits\PostTrait;

use \Carbon\Carbon;

use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    use PostTrait;

    private $post;
    private $mood;
    private $user;
    private $agent;

    private static $PAGINATION_LIMIT = 20;

    function __construct(Post $post, Community $community, Mood $mood, RantMeta $meta) {
        $this->post = $post;
        $this->mood = $mood;
        $this->category = $community;
        $this->meta = $meta;
        $this->agent = new Agent();
        $this->rant_community = $community->where('name', 'rants')->first();
        $this->meta_fields = ['is_public', 'is_anonymous'];

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
        $community = $this->rant_community;

        $posts = $this->post->where('community_id', $community->id)->orWhereHas('community', function($query) use($community) {

                    $query->where('parent_id', $community->id);

                })->latest();
                
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $title = 'Latest Rants';

        return view('rants.list', compact('posts', 'agent', 'title'));
    }





    /**
     * Create new Post
     * @return view
     */
    public function new() {

        $community = $this->rant_community;
        $communities = $this->category->where('parent_id', $this->rant_community->id)->ordered();

        return view('rants.new', compact('communities', 'community'));
    }



    /**
     * Create a new post
     * @param $request
     * @return response
     */
    public function store(Request $request) {

        $requestData = $request->except($this->meta_fields);

        $post = $this->preSubmit($requestData);
        
        $this->meta->create([
            'post_id' => $post->id,
            'is_public' => (isset($request->is_public) && $request->is_public == true),
            'is_anonymous' =>(isset($request->is_anonymous) && $request->is_anonymous == true)
        ]);


        $this->postSubmit($request, $post);

        return redirect()->route('rants.show', ['post' => $post->slug]);

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

        $communities = $this->category->where('parent_id', $this->rant_community->id)->ordered();

        $community = $this->rant_community;

        return view('rants.new', compact('post', 'communities', 'community'))->withIsEdit(true);
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

        $requestData = $request->except($this->meta_fields);
        $validation =  Validator::make($requestData, [
                        'title' => 'required|max:255',
                        'details' => 'required'
                        // 'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $post->update($requestData);


        $this->meta->where('post_id', $post->id)->update([
            'is_public' => (isset($request->is_public) && $request->is_public == true),
            'is_anonymous' =>(isset($request->is_anonymous) && $request->is_anonymous == true)
        ]);
      

        return redirect()->route('rants.show', ['post' => $post->slug]);
    }


}
