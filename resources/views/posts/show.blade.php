@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3 d-none d-lg-block">
            <a href="#comment" class="btn mb-2 btn-default btn-block text-center">
                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                <span class="btn-inner--text">Reply Topic</span>
            </a>

            <div class="card my-4">
                @php $user = $post->user; @endphp
                @include('profile.user_card')
            </div>
        </div>


        <div class="col-md-9">
            <h1 class="mb-1"> {{ $post->title }}</h1>
            <small>{{ $post->pl_comments }} | {{ $post->pl_views }}</small><br/>
            <a href="#comment" class=" d-lg-none btn btn-default btn-sm btn-icon">
                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                <span class="btn-inner--text">Reply Topic</span>
            </a>
            @if($comments->onFirstPage())
            <div class="card mt-2">
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
                                <a href="#" class="text-gray ">
                                    <i class="fa fa-xlg like {{ $post->liked() ? 'liked fa-thumbs-up ' : 'fa-thumbs-o-up ' }}"></i>
                                    <small class="text-muted likes-count {{ $post->likes()->count() > 0  ? '' : 'd-none'  }}">{{ $post->likes()->count() }}</small>
                                </a>
                            </div>

                            <div class="col-sm-6 text-right">
                                <a target="blank" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&quote={{ $post->title }}&utm_source=facebook" class="mr-2 text-gray">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a target="blank" title="Share on Twitter" href="http://twitter.com/share?text={{ $post->title }}&url=https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&text={{ $post->title }}&utm_source=twitter" class="mr-2 text-gray">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="mr-2 text-gray bookmark {{ $post->bookmarked() ? 'bookmarked' : '' }} " data-toggle="tooltip" data-placement="top" title="{{ $post->bookmarked() ? 'Remove from Saved' : 'Save for later' }}">
                                 <i class="fa {{ $post->bookmarked() ? 'fa-bookmark' : 'fa-bookmark-o' }}"></i>
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
          @include('templates.comments')
          @if(auth()->user())
          @include('templates.comment')
          @endif
        </div>

    </div>
@endsection

@section('scripts')
@include('templates.scripts.tinymce')

<script>
    var slug = "{{ $post->slug }}";
    var loggedIn = "{{ auth()->check() ? true : false }}"
</script>
<script src="{{asset('js/post-script.js')}}" ></script>
@endsection
