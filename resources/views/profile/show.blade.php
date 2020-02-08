@extends('layouts.app')


@section('content')

<div class="row">
  <div class="col-xl-3 d-none d-md-block">
      @if($user->id == auth()->user()->id)
        <a href="{{ isset($community) ? route('posts.new', ['community' => $community->slug]) : route('posts.new') }}" class="btn btn-icon btn-default btn-block mb-4">
                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                    Create New Topic
        </a>
      @endif
      <div class="card my-4">
        <!-- Card body -->
        @include('profile.user_card');
      </div>

  </div>
  <div class="col-xl-9 mb-xl-0">
      @php $userTopics = true @endphp
      @include('templates.topics_list')
  </div>
</div>

@endsection
