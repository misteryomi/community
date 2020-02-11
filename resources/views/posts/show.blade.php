@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1 class="mb-1"> {{ $post->title }}</h1>
            <small>{{ $post->pl_comments }} | {{ $post->pl_views }}</small>
            <button type="button" class="d-flex btn mb-2 btn-default btn-sm btn-icon">
                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                <span class="btn-inner--text">Reply Topic</span>
            </button>
            @if($comments->onFirstPage())
            <div class="card">
                <div class="list-group list-group-flush">
                    <div class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                        <div class="d-flex w-100 justify-content-between">
                        <div>
                        <a href="{{ route('profile.show', ['user' => $post->user->username]) }}">
                            <div class="d-flex  align-items-center">
                                <img src="{{ $post->user->avatar }}" alt="{{ ucfirst($post->user->username) }}" class="avatar avatar-xs mr-2">
                                <h5 class="mb-1">{{ ucfirst($post->user->username) }}
                                <br/><small class="text-gray">{{ $post->user->short_bio }}</small>
                                </h5>
                                
                            </div>
                        </a>
                    </div>
                    <br/><small class="text-gray">{{ $post->date }}</small>
                    </div>
                    <div class="my-4">{!! $post->details !!}</div>

                        <div class="row align-items-center border-top pt-3">
                            <div class="col-sm-6">
                                <a href="#" class="text-gray">
                                    <i class="fa fa-heart"></i>
                                    <small class="text-muted">150</small>
                                </a>
                            </div>

                            <div class="col-sm-6 text-right">                            
                                <a target="blank" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&utm_source=facebook" class="mr-2 text-gray">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a target="blank" title="Share on Twitter" href="http://twitter.com/share?text={{ $post->title }}&url=https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&utm_source=twitter" class="mr-2 text-gray">
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
                                        @if(auth()->user()->canEditPost($post))
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
            @endif
          @include('templates.comments')
          @include('templates.comment')
        </div>

        <div class="col-md-3">
            <button type="button" class="btn mb-2 btn-default btn-block text-center">
                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                <span class="btn-inner--text">Reply Topic</span>
            </button>

            <div class="card my-4">
                @php $user = $post->user; @endphp
                @include('profile.user_card');
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@include('templates.scripts.tinymce')

<script>
  $(document).ready(function() {

      $('#submit-comment').click(function(e) {
        e.preventDefault();

        let comment = editor.getData();

        $("input[name=comment]").val(comment);
        
        $('#comment-form').submit();
        
        return false;
      })
  })
</script>
@endsection
