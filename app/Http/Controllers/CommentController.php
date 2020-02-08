<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use \App\Comment;
use \App\Post;
use \App\User;

class CommentController extends Controller
{
    private $post;
    private $user;
    private $comment;


    function __construct(Post $post, Comment $comment) {
        $this->post = $post;
        $this->comment = $comment;

        $this->middleware(function($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }


    /**
     * Make comment on a post
     * @param $request
     * @return response
     */
    public function store(Request $request, Post $post) {

        $this->validate($request, [
                'comment' => 'required|max:255',
                // 'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
            ]);


        $requestData = $request->all();
        $requestData['user_id'] = $this->user->id;

        $comment = $post->comments()->create($requestData);

        return redirect(route('posts.show', ['post' => $post->slug]).'#'.$comment->id)->withMessage('Your comment has been successfully shared');
    }

}
