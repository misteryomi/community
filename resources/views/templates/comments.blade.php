
        @if($comments->count() > 0)
        <div class="comments mt-4">
            <h3>Comments
                <span class="comments-amount">{{ $post->comments->count() }}</span>
            </h3>

            <ul>
                @foreach ($comments as $comment)
                <li>
                    <div class="comments-avatar"><img src="{{ $comment->user->avatar }}" alt="">
                    </div>
                    <div class="comment-content">
                        <div class="comment-by">{{ ucfirst($comment->user->username) }}<span>{{ $comment->user->level}}</span>
                            <a href="#" class="reply"><i class="icon-line-awesome-undo"></i> Reply</a>
                        </div>
                        {!! $comment->comment !!}
                    </div>

                </li>
                @endforeach

            </ul>

        </div>
        @endif
        <hr>

{{ $comments->links('layouts.pagination.custom') }}
