<section id="comment" class="mt-4">

    <div class="d-flex w-100 align-items-center mb-2">
        <div>
        <a href="{{ route('profile.show', ['user' => $post->user->username]) }}">
            <div class="d-flex  align-items-center">
                <img src="{{ $post->user->avatar }}" alt="{{ ucfirst($post->user->username) }}" class="avatar avatar-xs mr-2">
            </div>
        </a>
        </div>
        <h3 class="text-gray-500 ">Reply Topic</h3>

    </div>

<div class="mt-1  bg-secondary">
    <form method="post" id="comment-form" action="{{ route('posts.comment', ['post' => $post->slug ]) }}">
        @csrf
        <div class="editor">
        </div>
        <input type="hidden" name="comment">
        <!-- <div class="form-group">
            <textarea id="editor" name="comment" class="form-control form-control-alternative" rows="20"></textarea>
        </div> -->
        <button type="submit" id="submit-comment" class="btn btn-block btn-default">Reply Topic</button>
    </form>
</div>
</section>
