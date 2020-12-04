@extends('layouts.app')


@section('content')

<h1> Communities </h1>
<div class="uk-flex uk-flex-between">
    <nav class="responsive-tab style-1 mb-5">
        @php $routeName = request()->route()->getName(); @endphp
        <ul>
            <li @if($routeName == 'community.all') class="uk-active" @endif><a href="{{ route('community.all') }}""> All Communities </a></li>
            <li @if($routeName == 'community.joined') class="uk-active" @endif><a href="{{ route('community.joined') }}"> Joined Communities</a></li>
            @if(auth()->user())
            <li @if($routeName == 'community.user') class="uk-active" @endif><a href="{{ route('community.user', ['user' => auth()->user()->clean_username]) }}""> My Communities</a></li>
            @endif
        </ul>
    </nav>
    <a href="{{ route('community.new') }}" class="button primary small circle uk-visible@s"> <i class="uil-plus"> </i> Create new Community
    </a>
</div>

<div class="uk-margin border-bottom border-top p-4 bg-light" uk-margin="">
    <form action="?" method="get">
        <div class="uk-form-custom uk-first-column">
            <input class="uk-input uk-form-width-large uk-form-large" name="q" type="text" placeholder="Search for Community" value="{{ request()->q }}" >
        </div>
        <button type="submit" class="button large warning text-white">Search</button>
    </form>
</div>

@if(request()->has('q'))
    <h3>All results matching "{{ request()->q }}"</h3>
@endif

    @if($communities->count() > 0)
    <ul class=" uk-child-width-1-4@m uk-child-width-1-3@s  pr-lg-1 uk-grid"
        uk-scrollspy="target: > div; cls: uk-animation-slide-bottom-small; delay: 100">

        @foreach($communities as $community)
        <li>
            <div class="group-card">

                <!-- Group Card Thumbnail -->
                <div class="group-card-thumbnail">
                    <img src="{{ asset('assets/images/group/group-cover-1.jpg') }}" alt="">
                </div>

                <!-- Group Card Content -->
                <div class="group-card-content">
                    <h3><a href="{{  route('community.list', ['community' => $community->slug]) }}">{{ $community->name }}</a></h3>

                    <p class="info"> <a href="{{  route('community.list', ['community' => $community->slug]) }}"> <span> {{ $community->posts->count() }} Topics  </span> </a> - 
                        <a href="#"> <span> {{ $community->followers->count() }} Followers </span> </a>
                    </p>
                    <div class="uk-width-expand">
                        <p>{{ $community->excerpt }}</p>
                    </div>

                    <div class="group-card-btns">

                        @if($community->userFollows(auth()->user()))
                        <a href="{{ route('community.unfollow', ['community' => $community->slug])  }}" class="button secondary small mb-1">
                                Unfollow</a>
                        @else
                        <a href="{{ route('community.follow', ['community' => $community->slug]) }}" class="button primary small mb-1">
                                Follow</a>
                        @endif
                   </div>

                </div>
            </div>

        </li>
        @endforeach

    </ul>

    {{ $communities->links('layouts.pagination.custom')}}

    @else
    
        @if(request()->has('q'))
            <p>No result matching your seeach query. <a href="{{ route('community.new') }}">Create a community</a>.</p>
        @else
            @if($routeName == 'community.joined')
            <p>You have not joined any community yet. <a href="{{ route('community.all') }}">Join your first community</a>!</p>
            @else
            <p>No community has been created yet. <a href="{{ route('community.new') }}">Create your first community</a>!</p>
            @endif
        @endif

    @endif




@endsection
