@extends('layouts.app')


@section('content')
<div class="profile">
                    <div class="profile-cover">

                        <!-- profile cover -->
                        <img src="assets/images/avatars/profile-cover.jpg" alt="">

                        <a href="#"> <i class="uil-camera"></i> Edit </a>

                    </div>

                    <div class="profile-details">
                        <div class="profile-image">
                            <img src="assets/images/avatars/avatar-2.jpg" alt="">
                            <a href="#"> </a>
                        </div>
                        <div class="profile-details-info">
                            <h1> Josephine Williams </h1>
                            <p> Family , Food , Fashion , Fourever <a href="#">Edit </a></p>
                        </div>

                    </div>


                    <div class="nav-profile" uk-sticky="offset:61;media : @s">
                        <div class="py-md-2 uk-flex-last">
                            <a href="#" class="button primary mr-2"> <i class="uil-plus"></i> Add your story</a>
                            <a href="#" class="button secondary button-icon mr-2"> <i class="uil-list-ul"> </i> </a>
                            <a href="#" class="button secondary button-icon"> <i class="uil-ellipsis-h"> </i> </a>
                            <div uk-dropdown="pos: bottom-left ; mode:hover ">
                                <ul class="uk-nav uk-dropdown-nav">
                                    <li><a href="#"> View as guast </a></li>
                                    <li><a href="#"> Bloc this person </a></li>
                                    <li><a href="#"> Report abuse</a></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <nav class="responsive-tab">
                                <ul>
                                    <li class="uk-active"><a class="active" href="#">Timeline</a></li>
                                    <li><a href="timeline-friends.html">About</a></li>
                                    <li><a href="timeline-friends.html">Friend</a></li>
                                    <li><a href="timeline-friends.html">Photoes</a></li>
                                    <li><a href="timeline-friends.html">Videos</a></li>
                                </ul>
                            </nav>
                            <div class="uk-visible@s">
                                <a href="#" class="nav-btn-more"> More</a>
                                <div uk-dropdown="pos: bottom-left ; mode:click ">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li><a href="#">Moves</a></li>
                                        <li><a href="#">Likes</a></li>
                                        <li><a href="#">Events</a></li>
                                        <li><a href="#">Groups</a></li>
                                        <li><a href="#">Gallery</a></li>
                                        <li><a href="#">Sports</a></li>
                                        <li><a href="#">Gallery</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



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
        @include('profile.user_card')
      </div>

  </div>
  <div class="col-xl-9 mb-xl-0">
      @php $userTopics = true @endphp
      @include('templates.topics_list')
  </div>
</div>
@endsection

