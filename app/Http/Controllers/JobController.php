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
use App\PostType;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Traits\ContentTrait;
use App\Http\Controllers\Traits\PostTrait;
use App\JobCategory;
use App\JobSalaryType;
use App\JobType;
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
        $this->post_type = PostType::where('name', 'jobs')->first();
        $this->communityObj = $community->where('name', 'jobs')->first();
        $this->meta_fields = ['url', 'is_approved', 'deadline', 'location', 'category_id', 'type_id', 'min_salary', 'max_salary', 'salary_type_id'];

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
        $community = $this->communityObj;

        $posts = $this->post->where('community_id', $community->id)->orWhereHas('type', function($query)  {
                    $query->where('name', $this->post_type->name);
                })->latest();
                

                
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $title = 'Latest Jobs Listing';
        $types = JobType::all();
        $categories = JobCategory::all();
        $salaries = JobSalaryType::all();
        $locations = $this->meta->locations();

        return view('jobs.list', compact('posts', 'agent', 'title', 'types', 'categories', 'salaries', 'locations'));
    }





    /**
     * Create new Post
     * @return view
     */
    public function new() {

        $community = $this->communityObj;
        $communities = $this->category->where('parent_id', $this->communityObj->id)->ordered();
        $types = JobType::all();
        $categories = JobCategory::all();
        $salaries = JobSalaryType::all();

        return view('jobs.new', compact('communities', 'community', 'types', 'categories', 'salaries'));
    }


    /**
     * Display post
     * @param $post_id post_id of the post
     * @return response
     */
    public function show(Request $request, Post $post) {

        $this->preShow($request, $post);
        
        $comments = $post->comments()->paginate(SELF::$PAGINATION_LIMIT);
        $related = $this->post->relatedTopics($post)->take(8)->get();

        return view('jobs.show', compact('post', 'comments', 'related'));
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
            'category' => 'required|exists:App\JobCategory,id',
            'type' => 'required|exists:App\JobType,id',
            'salary_type' => 'required|exists:App\JobSalaryType,id',
            'location' => 'required',
            'job_description' => 'required'
        ];

        $validation =  Validator::make($requestData, $validationFields);

        if($validation->fails()) {
             return redirect()->back()->withErrors($validation->errors())->withInput()->send();
        }

        $requestData['details'] = $request->job_description;

        $post = $this->preSubmit($requestData, false, $validationFields);

        // $post = $this->preSubmit($requestData);
        $post->update(['post_type' => $this->post_type->id]);
        
        $this->meta->create([
            'post_id' => $post->id,
            'location' => $request->location,
            'url' => $request->url,
            'type_id' => $request->type,
            'category_id' => $request->category,
            'salary_type_id' => $request->salary_type,
            'max_salary' => $request->max_salary,
            'min_salary' => $request->min_salary,
            'deadline' => $request->deadline,
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

        $communities = $this->category->where('parent_id', $this->communityObj->id)->ordered();

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
