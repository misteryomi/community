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
                        <div class="d-flex w-50 align-items-center">
                            <img src="{{ $post->user->avatar }}" alt="{{ ucfirst($post->user->username) }}" class="avatar avatar-xs mr-2">
                            <h5 class="mb-1">{{ ucfirst($post->user->username) }}</h5>
                        </div>
                        </a>
                    </div>
                    <small>{{ $post->date }}</small>
                    </div>
                    <p class="text-sm my-4">{!! $post->details !!}</p>

                        <div class="row align-items-center my-3">
                            <div class="col-sm-6">
                            <div class="icon-actions">
                                <a href="#" class="like active">
                                    <i class="ni ni-like-2"></i> <span class="text-muted">Like</span>
                                </a>
                                <a href="{{ route('posts.edit', ['post' => $post->slug]) }}">
                                    <i class="ni ni-curved-next"></i> <span class="text-muted">Edit</span>
                                </a>
                                <a href="#">
                                    <i class="ni ni-curved-next"></i> <span class="text-muted">Quote</span>
                                </a>
                                <a href="#">
                                    <i class="ni ni-curved-next"></i> <span class="text-muted">Report</span>
                                </a>
                                <a href="#">
                                    <i class="ni ni-like-2"></i> <span class="text-muted">Share</span>
                                </a>
                                <a href="#">
                                    <i class="ni ni-like-2"></i> <span class="text-muted">Bookmark</span>
                                </a>
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
@endsection
