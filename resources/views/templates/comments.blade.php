<div class="card">
    <!-- Card body -->
    <div class="card-body p-0">
        <!-- List group -->
        @if($comments->count() > 0)
        @foreach ($comments as $comment)
        <div class="list-group list-group-flush" id="#{{ $comment->id }}">
            <div class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                <div class="d-flex w-100 justify-content-between">
                <div>
                <h4 class="mb-1"><a class="text-dark" href="#{{ $comment->id }}">Re: {{ $post->title }}</a></h4>
                <div class="d-flex w-50 align-items-center">
                <img src="{{ $comment->user->avatar }}" alt="{{ ucfirst($comment->user->username) }}" class="avatar avatar-xs mr-2">
                <h5 class="mb-1">{{ ucfirst($comment->user->username) }}</h5>
                </div>
            </div>
            <small>{{ $comment->date }}</small>
            </div>
            <p class="text-sm my-4">{!! $comment->comment !!}</p>
                <div class="row align-items-center my-3">
                    <div class="col-sm-6">
                    <div class="icon-actions">
                            <a href="#" class="like active">
                                <i class="ni ni-like-2"></i> <span class="text-muted">Like</span>
                            </a>
                            <a href="#" class="like active">
                                <i class="ni ni-like-2"></i> <span class="text-muted">Quote</span>
                            </a>
                            <a href="#" class="like active">
                                <i class="ni ni-like-2"></i> <span class="text-muted">Report</span>
                            </a>
                            <a href="#">
                                <i class="ni ni-like-2"></i> <span class="text-muted">Share</span>
                            </a>
                    </div>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
        @endif

    </div>
</div>

{{ $comments->links() }}
