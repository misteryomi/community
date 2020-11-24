<div class="main_sidebar">
            <div class="side-overlay" uk-toggle="target: #wrapper ; cls: collapse-sidebar mobile-visible"></div>

            <!-- sidebar header -->
            <div class="sidebar-header">
                <h4> Navigation</h4>
                <span class="btn-close" uk-toggle="target: #wrapper ; cls: collapse-sidebar mobile-visible"></span>
            </div>

            <!-- sidebar Menu -->
            <div class="sidebar">
                <div class="sidebar_innr" data-simplebar>
                    <?php
                    //  ['name' => 'Questions', 'routeName' => 'home', 'icon' => 'icon-line-awesome-question'], 
                                               ?>
                    @php 
                        $route = request()->route()->getName();
                        $communities = \App\Community::where('is_featured', true)->take(5)->get();

                        $links = [
                            ['name' => 'Home', 'routeName' => 'home', 'icon' => 'icon-line-awesome-home'],  
                            ['name' => 'Latest Topics', 'routeName' => 'latest', 'icon' => 'icon-line-awesome-paw'],                               
                            ['name' => 'Trending', 'routeName' => 'trending', 'icon' => 'icon-line-awesome-fire'], 
                            ['name' => 'Communities', 'routeName' => 'community.all', 'icon' => 'icon-feather-users'], 
                            ['name' => 'Rants', 'routeName' => 'rants', 'icon' => 'icon-brand-first-order-alt'], 
                            ['name' => 'Jobs', 'routeName' => 'jobs', 'icon' => 'icon-line-awesome-folder-open-o'], 
                            
                        ]
                    @endphp
                    <div class="sections">
                        <ul>
                            @foreach($links as $link)
                            <li @if($route == $link['routeName']) class="active" @endif>
                                <a href="{{ route($link['routeName']) }}"> <i class="{{ $link['icon'] }}"></i>
                                    <!-- <img src="{{ asset('assets//images/icons/home.png') }}" alt=""> -->
                                    <span> {{ $link['name'] }} </span>
                                </a>
                            </li>
                            @endforeach
                            <!-- <li>
                                <a href="friends.html"> <img src="{{ asset('assets/images/icons/group.png') }}" alt="">
                                    <span> Friends </span> </a>
                            </li> -->
                            <!-- <li>
                                <a href="courses.html"> <img src="{{ asset('assets/images/icons/pen.png') }}" alt="">
                                    <span> Courses </span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="questions.html"> <img src="{{ asset('assets/images/icons/info.png') }}" alt="">
                                    <span> Questions </span>
                                </a>
                            </li> -->
                            @foreach($communities as $community)
                            <li id="more-veiw" hidden>

                                <a href="book.html"> <img src="{{ asset('assets/images/icons/book.png') }}" alt="">
                                    <span>{{ $community->name }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>

                        <a href="#" class="button secondary px-5 btn-more"
                            uk-toggle="target: #more-veiw; animation: uk-animation-fade">
                            <span id="more-veiw">See More <i class="icon-feather-chevron-down ml-2"></i></span>
                            <span id="more-veiw" hidden>See Less<i class="icon-feather-chevron-up ml-2"></i> </span>
                        </a>

                    </div>


                    <!-- <div class="sections">
                        <h3> Shortcut </h3>
                        <ul>
                            <li> <a href="timeline.html"> <img src="{{ asset('assets/images/avatars/avatar-1.jpg') }}" alt="">
                                    <span> Stella Johnson </span> <span class="dot-notiv"></span></a></li>
                            <li> <a href="timeline.html"> <img src="{{ asset('assets/images/avatars/avatar-2.jpg') }}" alt="">
                                    <span> Alex Dolgove </span> <span class="dot-notiv"></span></a></li>
                            <li> <a href="timeline.html"> <img src="{{ asset('assets/images/avatars/avatar-7.jpg') }}" alt="">
                                    <span> Adrian Mohani </span> </a>
                            </li>
                            <li id="more-veiw-2" hidden> <a href="timeline.html">
                                    <img src="{{ asset('assets/images/avatars/avatar-4.jpg') }}" alt="">
                                    <span> Erica Jones </span> <span class="dot-notiv"></span></a>
                            </li>
                            <li> <a href="group-feed.html"> <img src="{{ asset('assets/images/group/group-3.jpg') }}" alt="">
                                    <span> Graphic Design </span> </a>
                            </li>
                            <li> <a href="group-feed.html"> <img src="{{ asset('assets/images/group/group-4.jpg') }}" alt="">
                                    <span> Mountain Riders </span> </a>
                            </li>
                            <li id="more-veiw-2" hidden> <a href="timeline.html"> <img
                                        src="{{ asset('assets/images/avatars/avatar-5.jpg') }}" alt="">
                                    <span> Alex Dolgove </span> <span class="dot-notiv"></span></a>
                            </li>
                            <li id="more-veiw-2" hidden> <a href="timeline.html"> <img
                                        src="{{ asset('assets/images/avatars/avatar-7.jpg') }}" alt="">
                                    <span> Adrian Mohani </span> </a>
                            </li>
                        </ul>

                        <a href="#" class="button secondary px-5 btn-more"
                            uk-toggle="target: #more-veiw-2; animation: uk-animation-fade">
                            <span id="more-veiw-2">See More <i class="icon-feather-chevron-down ml-2"></i></span>
                            <span id="more-veiw-2" hidden>See Less<i class="icon-feather-chevron-up ml-2"></i> </span>
                        </a>

                    </div> -->


                    <!--  Optional Footer --> 
            <div id="foot">

                <ul>
                    <li> <a href="page-term.html"> About Us </a></li>
                    <li> <a href="page-setting.html"> Setting </a></li>
                    <li> <a href="page-privacy.html"> Privacy Policy </a></li>
                    <li> <a href="page-term.html"> Terms - Conditions </a></li>
                </ul>


                <div class="foot-content">
                    <p>© 2019 <strong>JaraCentral</strong>. All Rights Reserved. </p>
                </div>

            </div> 



                </div>


            </div>

        </div>
