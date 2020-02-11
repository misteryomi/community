        @if($comments->count() > 0)
        @foreach ($comments as $comment)
            <div class="card mt-2">
                <!-- Card body -->
                <div class="card-body p-0">
                        <!-- List group -->
                        <div class="list-group list-group-flush" id="#{{ $comment->id }}">
                            <div class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                <div class="d-flex w-100 justify-content-between">
                                <div>
                                <!-- <h4 class="mb-1"><a class="text-dark" href="#{{ $comment->id }}">Re: {{ $post->title }}</a></h4> -->
                                <a name="#{{ $comment->id }}"></a>
                                <a href="{{ route('profile.show', ['user' => $post->user->username]) }}">
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
                                                <a href="#" class="text-gray">
                                                    <i class="fa fa-heart"></i>
                                                    <small class="text-muted">150</small>
                                                </a>
                                            </div>

                                            <div class="col-sm-6 text-right">
                                                <a href="#" class="mr-2 text-gray">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                                <a href="#" class="mr-2 text-gray">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                                <a href="#" class="mr-2 text-gray">
                                                    <i class="fa fa-bookmark"></i>
                                                </a>
                                                <div class="dropdown">
                                                    <a class="px-2 text-gray" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-160px, -60px, 0px);">
                                                            @if(auth()->user() && auth()->user()->canEditPost($post))
                                                            <a class="dropdown-item" href="{{ route('posts.edit', ['post' => $post->slug]) }}">
                                                                <span class="text-muted">Edit</span>
                                                            </a>
                                                            @endif
                                                            <a class="dropdown-item"  href="#">
                                                                <span class="text-muted">Report Post</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fa fa-bookmark"></i>
                                                                <span class="text-muted">Save for later</span>
                                                            </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                            </div>

                        </div>
                    </div>
            </div>

        @endforeach
        @endif

{{ $comments->links() }}
