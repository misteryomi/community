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
    <form action="?" class="uk-grid-small" uk-grid method="get">
        <div class="uk-width-2-5@s">
            <input class="uk-input uk-form-width-large uk-form-large" name="q" type="text" placeholder="Search for Community" value="{{ request()->q }}" >
        </div>
        <div class="uk-width-1-5@s">
            <button type="submit" class="button xlarge block dark text-white">Search</button>
        </div>
    </form>
</div>

@if(request()->has('q'))
    <h3>All results matching "{{ request()->q }}"</h3>
@endif

    @if($communities->count() > 0)
    <div class="card">
    <div class="uk-child-width-1-3@m" uk-grid>
        @foreach($communities as $community)

        <div>
                         <div class="friend-card px-3">
                            <div class="uk-width-auto">
                                <a href="{{ route('community.list', ['community' => $community->slug]) }}">
                                {!! $community->displayAvatar('sm') !!}
                                </a>
                            </div>
                            <div class="uk-width-expand">
                                <a href="{{ route('community.list', ['community' => $community->slug]) }}">
                                <p><strong> {{ $community->name}}</strong> </p>
                                <p> <small>{{ $community->posts->count() }} Topics   - 
                                    {{ $community->followers->count() }} Followers</small> </p>
                                </a>                        
                            </div>
                            <div class="uk-width-auto">
               
                                @if($community->userFollows(auth()->user()))
                                <a href="{{ route('community.unfollow', ['community' => $community->slug])  }}" class="button secondary small mb-1">
                                        Unfollow</a>
                                @else
                                <a href="{{ route('community.follow', ['community' => $community->slug]) }}" class="button outline-light small mb-1">
                                        Follow</a>
                                @endif     


                            </div>
                        </div>

         </div>


        @endforeach

    </div>
    </div>
    {{ $communities->links('layouts.pagination.custom')}}

    @else
    
        @if(request()->has('q'))
            <p>No result matching your seeach query. <a href="{{ route('community.new') }}">Create a community</a>.</p>
        @else
            @if($routeName == 'community.joined')
            <p>You have not joined any community yet. <a href="{{ route('community.all') }}">Join your first community</a>!</p>
            @else
            <p>No community has been created yet. <a href="{{ route('community.new') }}"><strong>Create your first community</strong></a>!</p>
            @endif
        @endif

    @endif




@endsection
