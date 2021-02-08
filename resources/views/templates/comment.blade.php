<div class="mt-4">
    <h3>Reply </h3>
        <form method="post" id="comment-form" action="{{ route('posts.comment', ['post' => $post->slug ]) }}">
            @csrf
            <div id="editor_comments">
            </div>
            <input type="hidden" name="comment">
            <!-- <div class="form-group">
                <textarea id="editor" name="comment" class="form-control form-control-alternative" rows="20"></textarea>
            </div> -->
            <button type="submit" id="submit-comment" class="button primary block mt-2">Reply</button>
        </form>
</div>

