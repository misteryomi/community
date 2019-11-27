<div class="mt-3 py-4 bg-secondary">
    <form method="post" action="{{ route('posts.comment', ['post' => $post->slug ]) }}">
        @csrf
        <div class="form-group">
            <textarea id="reply-topic" name="comment" class="form-control form-control-alternative" rows="20"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Reply Post</button>
    </form>
</div>
