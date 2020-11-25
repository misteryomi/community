<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use \App\Comment;
use \App\Post;
use \App\User;
use App\Http\Controllers\Traits\ContentTrait;

class CommentController extends Controller
{

    use ContentTrait;

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
        // dd($request->all());

        $this->validate($request, [
                'comment' => 'required',
                // 'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
            ]);


        $requestData = $request->all();
        $requestData['user_id'] = $this->user->id;

        $comment = $post->comments()->create($requestData);

        $mentions = $this->fetchMentions($request->comment);

        if(count($mentions) > 0) {
            $this->notifyMentions($comment, $mentions);
        }


        return redirect(route('posts.show', ['post' => $post->slug]).'#'.$comment->id)->withMessage('Your comment has been successfully shared');
    }

    public function edit(Post $post, Comment $comment) {
        if(!$this->user->canEditComment($comment)) {
            abort(404);
        }
        return view('posts.edit-comment', compact('comment'));
    }

    public function storeEdit(Request $request, Post $post, Comment $comment) {
        if(!$this->user->canEditComment($comment)) {
            abort(404);
        }

        $comment->update(['comment' => $request->comment]);

        $mentions = $this->fetchMentions($request->comment);

        if(count($mentions) > 0) {
            $this->notifyMentions($comment, $mentions);
        }


        return redirect(route('posts.show', ['post' => $post->slug]).'#'.$comment->id)->withMessage('Your comment has been successfully updated');
    }

    public function like(Comment $comment) {

        $comment->likes()->firstOrCreate(['user_id' => $this->user->id], ['created_at' => now()]);

        return response(['status' => true]);
    }

    public function unlike(Comment $comment) {

        $comment->likes()->where('user_id', $this->user->id)->delete();

        return response(['status' => true]);
    }


}
