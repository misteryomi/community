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
use App\QuestionMeta;
use App\PostType;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Traits\ContentTrait;
use App\Http\Controllers\Traits\PostTrait;
use App\QuestionCategory;
use \Carbon\Carbon;

use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    use PostTrait;

    private $post;
    private $user;
    private $agent;

    private static $PAGINATION_LIMIT = 20;

    function __construct(Post $post, QuestionCategory $category, QuestionMeta $meta) {
        $this->post = $post;
        $this->category = $category;
        $this->meta = $meta;
        $this->agent = new Agent();
        $this->post_type = PostType::where('name', 'questions')->first();
        $this->question_community = Community::where('name', 'questions')->first();

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
        $community = $this->question_community;

        $posts = $this->post->where('community_id', $community->id)->orWhereHas('type', function($query)  {
                    $query->where('name', $this->post_type->name);
                })->latest();
                
        $posts =  $posts->paginate(SELF::$PAGINATION_LIMIT);

        $title = 'Latest Questions';

        return view('questions.list', compact('posts', 'agent', 'title'));
    }





    /**
     * Create new Post
     * @return view
     */
    public function new() {

        $community = $this->question_community;
        $categories = $this->category->ordered();

        // $categories = $this->category->where('parent_id', $this->question_community->id)->ordered();

        return view('questions.new', compact('categories', 'community'));
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
        $best_answer = $post->comments()->find($post->meta->comment_answer_id);

        if($request->has('best_answer')) {
            $this->markAsBestAnswer($request, $post);
        }

        return view('questions.show', compact('post', 'comments', 'related', 'best_answer'));
    }

    /**
     * Create a new post
     * @param $request
     * @return response
     */
    public function store(Request $request) {

        $requestData = $request->all(); //$request->except($this->meta_fields);
        $requestData['community'] = $this->question_community->id;

        $validationFields = [
            'title' => 'required|max:255',
            // 'details' => 'required',
            'category' => 'required|exists:App\QuestionCategory,id'
        ];

        $validation =  Validator::make($requestData, $validationFields);

        if($validation->fails()) {
             return redirect()->back()->withErrors($validation->errors())->withInput()->send();
        }

        $post = $this->preSubmit($requestData);

        $post->update(['post_type' => $this->post_type->id]);

        $this->meta->create([
            'post_id' => $post->id,
            'category_id' => $requestData['category']
        ]);

        $this->postSubmit($request, $post);

        return redirect()->route('questions.show', ['post' => $post->slug]);

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

        // $categories = $this->category->ordered();

        return view('questions.new', compact('post', 'community'))->withIsEdit(true);
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
                        // 'details' => 'required'
                        // 'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $post->update($requestData);

      

        return redirect()->route('questions.show', ['post' => $post->slug]);
    }


    private function markAsBestAnswer($request, $post) {

        //check if the comment_id exists and if it doesn't belong to same original poster

            $comment = $post->comments()->find($request->best_answer);

            if(!$comment) {
                return redirect()->back()->withError('Comment does not exist');
            }

            if($comment->user_id == $post->user_id) {
                return redirect()->back()->withError('Sorry, you cannot mark your comment as best answer');
            }

            $comment->user->coins()->increment('balance', 2);
            
            return redirect()->back()->withMessage('Comment successfully marked as best answer');

    }

}
