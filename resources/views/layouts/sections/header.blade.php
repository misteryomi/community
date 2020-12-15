@php $user = auth()->user() ? auth()->user() : null; @endphp
<div id="main_header">
            <header>
                <div class="header-innr">


                    <!-- Logo-->
                    <div class="header-btn-traiger" uk-toggle="target: #wrapper ; cls: collapse-sidebar mobile-visible">
                        <span></span></div>

                    <!-- Logo-->
                    <div id="logo">
                        <a href="{{ route('home') }}"> <img src="{{ asset('assets/images/logo.png') }}" alt=""></a>
                        <a href="{{ route('home') }}"> <img src="{{ asset('assets/images/logo.png') }}" class="logo-inverse"
                                alt=""></a>
                    </div>

                    <!-- form search-->
                    <div class="head_search">
                        <form action="{{ route('search') }}">
                            <div class="head_search_cont">
                                <input value="" name="q" type="text" class="form-control"
                                    placeholder="Search Topics..." autocomplete="off">
                                <i class="s_icon uil-search-alt"></i>
                            </div>

                            <!-- Search box dropdown -->
                            <!-- <div uk-dropdown="pos: top;mode:click;animation: uk-animation-slide-bottom-small"
                                class="dropdown-search">

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

                            </div> -->


                        </form>
                    </div>

                    <!-- user icons -->
                    <div class="head_user">


                        <a href="{{ route('home') }}" class="opts_icon_link uk-visible@s text-dark"> <i class="icon-feather-home"></i> Home</a>
                        <a href="{{ route('community.all') }}" class="opts_icon_link uk-visible@s text-dark"> <i class="icon-feather-bar-chart"></i> Communities</a>

                        @if($user)
                        <a href="{{ route('home') }}" class=" uk-visible@s button soft-warning disabled text-dark" style="cursor: pointer"> <i class="icon-line-awesome-money"></i> {{ $user->coins->balance }} Coins</a>
                        <a href="{{ route('topics.new') }}" class="button outline-primary mr-1 small uk-hidden@l"> <i class="fa fa-plus"> </i></a>
                        <a href="{{ route('topics.new') }}" class="button primary uk-visible@s ml-2"> <i class="uil-plus"> </i> Create New Topic</a>

                        <!-- notificiation icon  -->
                        <a href="#" class="opts_icon uk-visible@s"  uk-tooltip="title: Notifications ; pos: bottom ;offset:7">
                            @php $notifications = $user->notifications->where('is_seen', 1)->count(); @endphp
                            <i class="icon-feather-bell"></i>
                            @if($notifications)<span>{{ $notifications }}</span>@endif
                        </a>

                        <!-- notificiation dropdown -->
                        <div uk-dropdown="mode:click ; animation: uk-animation-slide-bottom-small"
                            class="dropdown-notifications" style="display:none">

                            <!-- notification contents -->
                            <div class="dropdown-notifications-content" data-simplebar>

                                <!-- notivication header -->
                                <div class="dropdown-notifications-headline">
                                    <h4>Notifications </h4>
                                    <a href="{{ route('notifications') }}">
                                        <i class="icon-feather-arrow-right"
                                            uk-tooltip="title: View all notifications ; pos: left"></i>
                                    </a>
                                </div>

                                <!-- notiviation list -->
                                <ul>
                                    @foreach($user->notifications()->latest()->take(7)->get() as $notification)
                                    <li>
                                        <a href="{{ route('notification.show', ['notification' => $notification->id]) }}">
                                            <span class="notification-avatar">
                                                {!! $notification->fromUser->displayAvatar() !!}
                                            </span>
                                            <span class="notification-text">
                                                <strong>{{ $notification->fromUser->username }}</strong> {{ $notification->message }}
                                                <br><span class="time-ago"> {{ $notification->date }} </span>
                                            </span>
                                        </a>
                                    </li>
                                    @endforeach
                                    <li class=" text-center">
                                        <a href="{{ route('notifications') }}" class="">View all notifications &raquo;</i></a>
                                    </li>
                                </ul>
                            </div>


                        </div>
                        @endif


                        <!-- profile -image -->
                        @guest
                        <a href="{{ route('login') }}" class="button primary uk-visible@s ml-2"> Login </a>
                        <a href="{{ route('register') }}" class="button warning ml-2 uk-visible@s"> Create an account </a>
                        <a class="opts_account uk-hidden@s mt-2" href="#"> <span class="icon-border"><i class="icon-feather-user"></i></span></a>
                        <!-- profile dropdown-->
                        <div uk-dropdown="mode:click; animation: uk-animation-slide-bottom-small"
                            class="dropdown-notifications rounded" style="display:none">

                            <ul class="dropdown-user-menu">
                                <li><a href="{{ route('login') }}"> <i class="uil-user"></i> Login </a> </li>
                                <li><a href="{{ route('register') }}"> <i class="uil-bookmark"></i> Create an account </a></li>
                                <li>
                                    <a href="#" id="night-mode" class="btn-night-mode">
                                        <i class="uil-moon"></i> Night mode
                                        <span class="btn-night-mode-switch">
                                            <span class="uk-switch-button"></span>
                                        </span>
                                    </a>
                                </li>
                            </ul>

                        </div>

                        @else
                        <!-- style="margin-top:-12px" -->
                        <a class="opts_account mr-2" href="#" > {!! $user->displayAvatar() !!}</a>
                        <!-- profile dropdown-->
                        <div uk-dropdown="mode:click ; animation: uk-animation-slide-bottom-small"
                            class="dropdown-notifications rounded"  style="display:none">

                            <!-- User Name / Avatar -->
                            <a href="{{ route('profile.show', ['user' => $user->clean_username]) }}">

                                <div class="dropdown-user-details">
                                    <div class="dropdown-user-avatar">
                                        {!! $user->displayAvatar() !!}
                                    </div>
                                    <div class="dropdown-user-name"> {{ $user->name }}   <span>{{ $user->name != $user->username ? $user->username : "View profile" }}</span> 
                                    </div>
                                </div>

                            </a>

                            <hr class="m-0">
                            <ul class="dropdown-user-menu">
                                <li><a href="group-feed.html" class="button soft-warning disabled"><i class="icon-line-awesome-money"></i> {{ $user->coins->balance }} Coins  </a></li>                                
                                <li><a href="{{ route('profile.show', ['user' => $user->clean_username]) }}"> <i class="uil-user"></i> Profile </a> </li>
                                <li><a href="{{ route('topics.bookmarks') }}"> <i class="uil-bookmark"></i> Bookmarks </a></li>
                                <li><a href="{{ route('topics.likes') }}"> <i class="uil-thumbs-up"></i> Liked Posts </a></li>
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
