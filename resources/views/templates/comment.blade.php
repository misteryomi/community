        <div class="comments">
            <h3>Add Comment </h3>
            <ul>
                <li>
                    <div class="comments-avatar"><img src="{{ $post->user->avatar }}" alt="">
                    </div>
                    <div class="comment-content">
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
                </li>
            </ul>
        </div>
