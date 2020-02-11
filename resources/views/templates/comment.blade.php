@if($post->comments->count() == 0)
<h3>Be the first to comment</h3>
@else
<h3>Drop a Comment</h3>
@endif
<div class="mt-3 py-4 bg-secondary">
    <form method="post" id="comment-form" action="{{ route('posts.comment', ['post' => $post->slug ]) }}">
        @csrf
        <div class="editor">
        </div>
        <input type="hidden" name="comment">
        <!-- <div class="form-group">
            <textarea id="editor" name="comment" class="form-control form-control-alternative" rows="20"></textarea>
        </div> -->
        <button type="submit" id="submit-comment" class="btn btn-default">Reply Post</button>
    </form>
</div>
