@extends('layouts.app')


@section('content')
<div class="profile">
                    <div class="profile-cover">

                        <!-- profile cover -->
                        <img src="{{ asset('assets/images/title-bg.png') }}" alt="">

                        <!-- <a href="{{ route('profile.settings') }}"> <i class="uil-camera"></i> Edit </a> -->

                    </div>

                    <div class="profile-details">
                        <div class="profile-image">
                                {!! $user->displayAvatar() !!}
                                <a href="{{ route('profile.avatar.settings') }}"> </a>
                        </div>
                        <div class="profile-details-info">
                            <h1> {{ $user->name }} </h1>
                            @if($user->id == auth()->user()->id)
                            <p> {{ $user->bio }}
                            <small>Member since: {{ $user->date_joined }}</small>

                            <a href="{{ route('profile.settings') }}">Edit </a></p>
                            @endif
                        </div>

                    </div>


                    <div class="nav-profile" uk-sticky="offset:61;media : @s">
                        <div class="py-md-2 uk-flex-last">
                            @if($user->id == auth()->user()->id)

                            <a href="#" class="button primary mr-2"> <i class="uil-plus"></i>Post a New</a>
                            <div uk-dropdown="pos: bottom-left ; mode:hover ">
                                <ul class="uk-nav uk-dropdown-nav">
                                    <li><a href="{{ route('topics.new') }}"> Topic </a></li>
                                    <li><a href="{{ route('rants.new') }}"> Rant </a></li>
                                    <li><a href="{{ route('questions.new') }}"> Question</a></li>
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div>
                            <nav class="responsive-tab">
                                <ul>
                                    <li class="uk-active"><a class="active" href="#">Topics</a></li>
                                    <li><a href="?questions">Questions</a></li>
                                    <li><a href="?rants">Rants</a></li>
                                    <li><a href="?communities">Communities</a></li>
                                    <li><a href="?followed-communities">Followed Communities</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

<br/>


      @php $userTopics = true @endphp
      @include('templates.topics_list')
</div>
@endsection

