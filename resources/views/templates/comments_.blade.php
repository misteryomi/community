
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





















            <div class="card mx--3 mx-md-0  mt-2" id="comment-{{ $comment->id }}">
                <!-- Card body -->
                <div class="card-body p-0">
                        <!-- List group -->
                        <div class="list-group list-group-flush" id="#{{ $comment->id }}">
                            <div class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                <div class="d-flex w-100 justify-content-between">
                                <div>
                                <!-- <h4 class="mb-1"><a class="text-dark" href="#{{ $comment->id }}">Re: {{ $comment->title }}</a></h4> -->
                                <a href="{{ route('profile.show', ['user' => $comment->user->username]) }}">
                                <div class="d-flex w-50 align-items-center">
                                    <img src="{{ $comment->user->avatar }}" alt="{{ ucfirst($comment->user->username) }}" class="avatar avatar-xs mr-2">
                                    <h5 class="mb-1">{{ ucfirst($comment->user->username) }}</h5>
                                </div>
                                </a>
                            </div>
                            <small class="text-gray">{{ $comment->date }}</small>
                            </div>
                            <div class="my-4">{!! $comment->comment !!}</div>


                                <div class="row align-items-center border-top pt-3">
                                    <div class="col-sm-6">
                                        <a href="#" class="text-gray comment-like" data-id="{{ $comment->id }}">
                                            <i class="fa fa-xlg {{ $comment->liked() ? 'liked fa-thumbs-up ' : 'fa-thumbs-o-up ' }}"></i>
                                            <small class="text-muted comment-likes-count {{ $comment->likes()->count() > 0  ? '' : 'd-none'  }}">{{ $comment->likes()->count() }}</small>
                                        </a>
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <a target="blank" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}#{{ $comment->id }}&utm_source=facebook" class="mr-2 text-gray">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a target="blank" title="Share on Twitter" href="http://twitter.com/share?text={{ $comment->title }}&url=https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}#{{ $comment->id }}&utm_source=twitter" class="mr-2 text-gray">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <div class="dropdown">
                                            <a class="px-2 text-gray" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-160px, -60px, 0px);">
                                                @if(auth()->user() && auth()->user()->canEditPost($comment))
                                                    <a class="dropdown-item" href="{{ route('posts.comment.edit', ['comment' => $comment->id, 'post' => $post->slug]) }}">
                                                        <span class="text-muted">Edit</span>
                                                    </a>
                                                    @endif
                                                    <a class="dropdown-item"  href="#">
                                                        <span class="text-muted">Report Post</span>
                                                    </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
            </div>


{{ $comments->links('layouts.pagination.custom') }}
