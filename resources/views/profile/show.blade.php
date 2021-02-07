@php $isLoggedInUser = auth()->user() && ($user->id == auth()->user()->id) @endphp
@extends('layouts.app')


@section('content')
                <div class="profile">
                    <div class="profile-cover">
                    </div>

                    <div class="profile-details">
                        <div class="profile-image">
                                {!! $user->displayAvatar('lg') !!}
                                @if($isLoggedInUser)
                                <a href="{{ route('profile.avatar.settings') }}"> </a>
                                @endif
                        </div>
                        <div class="profile-details-info mt-5">
                            <h1> {{ $user->name }} </h1>
                            <p> {{ $user->bio }}
                            <small>Member since: {{ $user->date_joined }}</small>

                            @if($isLoggedInUser)
                            <a href="{{ route('profile.settings') }}">Edit </a></p>
                            @endif
                        </div>

                    </div>


                    <div class="nav-profile" uk-sticky="offset:61;media : @s">
                        <div class="py-md-2 uk-flex-last">
                            @if($isLoggedInUser)

                            <!-- <a href="#" class="button primary mr-2"> <i class="uil-plus"></i>Post a New</a>
                            <div uk-dropdown="pos: bottom-left ; mode:hover ">
                                <ul class="uk-nav uk-dropdown-nav">
                                    <li><a href="{{ route('topics.new') }}"> Topic </a></li>
                                    <li><a href="{{ route('rants.new') }}"> Rant </a></li>
                                    <li><a href="{{ route('questions.new') }}"> Question</a></li>
                                </ul>
                            </div> -->
                            @endif
                        </div>
                        <div>
                            <nav class="responsive-tab">
                                <ul>
                                    <li class="uk-active"><a class="{{ request()->type == 'topics' }}" href="?type=topics">Topics</a></li>
                                    <li><a class="{{ request()->type == 'questions' }}" href="?type=questions">Questions</a></li>
                                    <li><a class="{{ request()->type == 'rants' }}" href="?type=rants">Rants</a></li>
                                    <li><a href="{{ route('community.user', ['user' => $user->original_username]) }}">Communities</a></li>
                                    @if($isLoggedInUser)
                                    <li><a href="{{ route('community.joined') }}">Followed Communities</a></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

<br/>

@if($isLoggedInUser)
    @include('posts.share')
@endif

      @php $userTopics = true @endphp
      @include('templates.topics_list')
</div>
@endsection

