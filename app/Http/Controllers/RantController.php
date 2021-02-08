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
use App\PostType;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Traits\ContentTrait;
use App\Http\Controllers\Traits\PostTrait;

use \Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Route;

class RantController extends Controller
{
    use PostTrait;

    private $post;
    private $mood;
    private $user;
    private $agent;

    private static $PAGINATION_LIMIT = 20;

    function __construct(Post $post, Community $community, Mood $mood, RantMeta $meta, PostType $post_type) {
        $this->post = $post;
        $this->mood = $mood;
        $this->meta = $meta;
        $this->agent = new Agent();
        $this->communityObj = $community->where('name', 'rants')->first();
        $this->post_type = $post_type->where('name', 'rants')->first();
        $this->meta_fields = ['is_public', 'is_anonymous', 'category'];

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
 
        $posts = $this->post->getPostsType($this->post_type->name)->latest();

        // $posts = $this->post->where('community_id', $community->id)->orWhereHas('community', function($query) use($community) {
        //             $query->where('parent_id', $community->id);
        //         })->latest();
                
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $title = 'Latest Rants';

        return view('rants.list', compact('posts', 'agent', 'title'));
    }





    /**
     * Create new Post
     * @return view
     */
    public function new() {

        $community = $this->communityObj;
        // $communities = $this->communityObj->where('parent_id', $community->id)->ordered();

        $useChildCategories = true;

        return view('rants.new', compact('communities', 'community', 'useChildCategories'));
    }



    /**
     * Create a new post
     * @param $request
     * @return response
     */
    public function store(Request $request) {

        $requestData = $request->all(); //$request->except($this->meta_fields);
        $requestData['community'] = $this->communityObj->id;

        $validationFields = [
            'title' => 'required|max:255',
            // 'details' => 'required',
            'category' => 'required|exists:App\RantCategory,id'
        ];

        $validation =  Validator::make($requestData, $validationFields);

        if($validation->fails()) {
             return redirect()->back()->withErrors($validation->errors())->withInput()->send();
        }

        $post = $this->preSubmit($requestData, false, $validationFields);

        $post->update(['post_type' => $this->post_type->id]);
        
        $this->meta->create([
            'post_id' => $post->id,
            'is_public' => (isset($request->is_public) && $request->is_public == true),
            'is_anonymous' =>(isset($request->is_anonymous) && $request->is_anonymous == true),
            'category_id' => $request->category,
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

        $this->preUpdate($request, $post);

        $this->meta->where('post_id', $post->id)->update([
            'is_public' => (isset($request->is_public) && $request->is_public == true),
            'is_anonymous' =>(isset($request->is_anonymous) && $request->is_anonymous == true)
        ]);
      

        return redirect()->route('rants.show', ['post' => $post->slug]);
    }


}
