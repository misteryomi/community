@extends('layouts.app')


@section('content')



                                <div class="bg-grey uk-light uk-padding pb-0 rounded shadow">
                                        <ul class="uk-tab"
                                            uk-switcher="connect: #component-tab-left; animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
                                            <!-- uk-tab="connect: #component-tab-right; animation: uk-animation-fade"> -->
                                            <li class="uk-active"><a href="#"> <i
                                                        class="icon-feather-home mr-2"></i>Profile</a>
                                            </li>
                                            <li><a href="#"> <i class="icon-feather-message-square mr-2"></i>
                                                    Homepage Settings</a></li>
                                            <li><a href="#"> <i class="icon-feather-settings mr-2"></i> Password</a>
                                            </li>
                                        </ul>
                                </div>

                                @include('layouts.partials.alert')

                                        <ul class="uk-switcher uk-margin" id="component-tab-left">
                                            <!-- tab 1 -->
                                            <li>
                                              @include('profile.edit')
                                            </li>

                                            <!-- tab 2 -->
                                            <li>
                                              @include('profile.feed-settings')        
                                            </li>

                                            <!-- tab 3 -->
                                            <li>
                                              @include('profile.password')        
                                            </li>

                                        </ul>




@endsection
