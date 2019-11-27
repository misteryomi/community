<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsListCollection;
use App\Post;
use App\User;

class PostController extends Controller
{
    private $post;
    private $user;

    function __construct(Post $post) {
        $this->post = $post;
        $this->user = Auth::user();
    }


    /**
     * Display feed of posts
     * @return response
     */
    public function index() {
        $posts = $this->post->latest()->paginate(15);

        return view('welcome', compact('posts'));
    }

    /**
     * Display post
     * @param $post_id post_id of the post
     * @return response
     */
    public function show(Post $post) {

        return view('posts.show', compact('post'));
    }

    /**
     * Create a new post
     * @param $request
     * @return response
     */
    public function store(Request $request) {



        $validate = $this->validate($request, [
                        'text' => 'required|max:255',
                        'date' => 'date_format:Y-m-d',
                        'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
                    ]);


        $requestData = $request->all();
        $requestData['post_id'] = $this->post->generatePostId();

        $post = $this->user->posts()->create($requestData);

        return response([
                            'status' => true,
                            'message' => "You have successfully shared your post!",
                            'data' =>  new PostResource($post),
                            ]);
    }



}
