@php $user = auth()->user() ? auth()->user() : null; @endphp
<div id="main_header">
            <header>
                <div class="header-innr">


                    <!-- Logo-->
                    <div class="header-btn-traiger" uk-toggle="target: #wrapper ; cls: collapse-sidebar mobile-visible">
                        <span></span></div>

                    <!-- Logo-->
                    <div id="logo">
                        <a href="homepage.html"> <img src="{{ asset('assets/images/logo.png') }}" alt=""></a>
                        <a href="homepage.html"> <img src="{{ asset('assets/images/logo-light.png') }}" class="logo-inverse"
                                alt=""></a>
                    </div>

                    <!-- form search-->
                    <div class="head_search">
                        <form>
                            <div class="head_search_cont">
                                <input value="" type="text" class="form-control"
                                    placeholder="Search for Friends , Videos and more.." autocomplete="off">
                                <i class="s_icon uil-search-alt"></i>
                            </div>

                            <!-- Search box dropdown -->
                            <div uk-dropdown="pos: top;mode:click;animation: uk-animation-slide-bottom-small"
                                class="dropdown-search">
                                <!-- User menu -->

                                <ul class="dropdown-search-list">
                                    <li class="list-title"> Recent Searches </li>
                                    <li> <a href="#"> <img src="{{ asset('assets/images/avatars/avatar-2.jpg')   }}" alt=""> Erica Jones
                                        </a> </li>
                                    <li> <a href="#"> <img src="{{ asset('assets/images/group/group-2.jpg') }}" alt=""> Coffee
                                            Addicts</a> </li>
                                    <li> <a href="#"> <img src="{{ asset('assets/images/group/group-4.jpg') }}" alt=""> Mountain Riders
                                        </a> </li>
                                    <li> <a href="#"> <img src="{{ asset('assets/images/group/group-5.jpg') }}" alt=""> Property Rent
                                            And Sale </a> </li>
                                    <li class="menu-divider"></li>
                                    <li class="list-footer"> <a href="your-history.html"> Searches History </a>
                                    </li>
                                </ul>

                            </div>


                        </form>
                    </div>

                    <!-- user icons -->
                    <div class="head_user">


                        <a href="{{ route('home') }}" class="opts_icon_link uk-visible@s"> Home </a>

                        

                        @if($user)
                        <a href="{{ route('posts.new') }}" class="button primary uk-visible@s"> Create New Topic</a>

                        <!-- notificiation icon  -->
                        <a href="#" class="opts_icon" uk-tooltip="title: Notifications ; pos: bottom ;offset:7">
                            <img src="{{ asset('assets/images/icons/bell.svg') }}" alt=""> <span>3</span>
                        </a>

                        <!-- notificiation dropdown -->
                        <div uk-dropdown="mode:click ; animation: uk-animation-slide-bottom-small"
                            class="dropdown-notifications">

                            <!-- notification contents -->
                            <div class="dropdown-notifications-content" data-simplebar>

                                <!-- notivication header -->
                                <div class="dropdown-notifications-headline">
                                    <h4>Notifications </h4>
                                    <a href="#">
                                        <i class="icon-feather-settings"
                                            uk-tooltip="title: Notifications settings ; pos: left"></i>
                                    </a>
                                </div>

                                <!-- notiviation list -->
                                <ul>
                                    <li>
                                        <a href="#">
                                            <span class="notification-avatar">
                                                <img src="{{ asset('assets/images/avatars/avatar-2.jpg') }}" alt="">
                                            </span>
                                            <span class="notification-icon bg-gradient-primary">
                                                <i class="icon-feather-thumbs-up"></i></span>
                                            <span class="notification-text">
                                                <strong>Adrian Moh.</strong> Like Your Comment On Video
                                                <span class="text-primary">Learn Prototype Faster</span>
                                                <br> <span class="time-ago"> 9 hours ago </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="notification-avatar">
                                                <img src="{{ asset('assets/images/avatars/avatar-3.jpg') }}" alt="">
                                            </span>
                                            <span class="notification-icon bg-gradient-danger">
                                                <i class="icon-feather-star"></i></span>
                                            <span class="notification-text">
                                                <strong>Alex Dolgove</strong> Added New Review In Video
                                                <span class="text-primary">Full Stack PHP Developer</span>
                                                <br> <span class="time-ago"> 19 hours ago </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="notification-avatar">
                                                <img src="{{ asset('assets/images/avatars/avatar-4.jpg') }}" alt="">
                                            </span>
                                            <span class="notification-icon bg-gradient-success">
                                                <i class="icon-feather-message-circle"></i></span>
                                            <span class="notification-text">
                                                <strong>Stella John</strong> Replay Your Comment in
                                                <span class="text-primary">Adobe XD Tutorial</span>
                                                <br> <span class="time-ago"> 12 hours ago </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="notification-avatar">
                                                <img src="{{ asset('assets/images/avatars/avatar-2.jpg') }}" alt="">
                                            </span>
                                            <span class="notification-icon bg-gradient-primary">
                                                <i class="icon-feather-thumbs-up"></i></span>
                                            <span class="notification-text">
                                                <strong>Adrian Moh.</strong> Like Your Comment On Video
                                                <span class="text-primary">Learn Prototype Faster</span>
                                                <br> <span class="time-ago"> 9 hours ago </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="notification-avatar">
                                                <img src="{{ asset('assets/images/avatars/avatar-3.jpg') }}" alt="">
                                            </span>
                                            <span class="notification-icon bg-gradient-warning">
                                                <i class="icon-feather-star"></i></span>
                                            <span class="notification-text">
                                                <strong>Alex Dolgove</strong> Added New Review In Video
                                                <span class="text-primary">Full Stack PHP Developer</span>
                                                <br> <span class="time-ago"> 19 hours ago </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="notification-avatar">
                                                <img src="{{ asset('assets/images/avatars/avatar-4.jpg') }}" alt="">
                                            </span>
                                            <span class="notification-icon bg-gradient-success">
                                                <i class="icon-feather-message-circle"></i></span>
                                            <span class="notification-text">
                                                <strong>Stella John</strong> Replay Your Comment in
                                                <span class="text-primary">Adobe XD Tutorial</span>
                                                <br> <span class="time-ago"> 12 hours ago </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>

                            </div>


                        </div>
                        @endif


                        <!-- profile -image -->
                        @guest
                        <a href="{{ route('login') }}" class="button primary uk-visible@s"> Login </a>
                        <a href="{{ route('register') }}" class="button outline-danger ml-2 uk-visible@s"> Create an account </a>
                        @else
                        <a class="opts_account" href="#"> <img src="{{ $user->avatar }}" alt=""></a>
                        <!-- profile dropdown-->
                        <div uk-dropdown="mode:click ; animation: uk-animation-slide-bottom-small"
                            class="dropdown-notifications rounded">

                            <!-- User Name / Avatar -->
                            <a href="{{ route('profile.show', ['user' => $user->clean_username]) }}">

                                <div class="dropdown-user-details">
                                    <div class="dropdown-user-avatar">
                                        <img src="{{ $user->avatar }}" alt="">
                                    </div>
                                    <div class="dropdown-user-name"> {{ $user->name }}   <span>{{ $user->name != $user->username ? $user->username : "View profile" }}</span> </div>
                                </div>

                            </a>

                            <hr class="m-0">
                            <ul class="dropdown-user-menu">
                                <li><a href="{{ route('profile.show', ['user' => $user->clean_username]) }}"> <i class="uil-user"></i> Profile </a> </li>
                                <li><a href="group-feed.html"> <i class="uil-bookmark"></i> Bookmarks </a></li>
                                <li><a href="group-feed.html"> <i class="uil-thumbs-up"></i> Liked Posts </a></li>
                                <li><a href="{{ route('profile.settings') }}"> <i class="uil-cog"></i> Settings</a></li>
                                <li>
                                    <a href="#" id="night-mode" class="btn-night-mode">
                                        <i class="uil-moon"></i> Night mode
                                        <span class="btn-night-mode-switch">
                                            <span class="uk-switch-button"></span>
                                        </span>
                                    </a>
                                </li>
                                </li>
                            </ul>

                            <hr class="m-0">
                            <ul class="dropdown-user-menu">
                                <li><a href="{{ route('logout') }}"> <i class="uil-sign-out-alt"></i>Log Out</a>
                                </li>
                            </ul>

                        </div>
                        @endguest

                    </div>

                </div> <!-- / heaader-innr -->
            </header>

        </div>
