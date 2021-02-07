@extends('layouts.app')


@section('content')
<div class=" p-sm-0 ml-sm-4">

<h1 c> Settings </h1>

@include('layouts.partials.alert')

<div class="uk-position-relative" uk-grid>
    <div class="uk-width-1-4@m uk-flex-last@m pl-sm-0">


        @php 
            $route = request()->route() ? request()->route()->getName() : '';

            $links = [
                ['name' => 'Profile', 'routeName' => 'profile.settings', 'icon' => 'uil-user'],  
                ['name' => 'Password', 'routeName' => 'profile.password.settings', 'icon' => 'uil-unlock-alt'],                               
                ['name' => 'Profile Picture', 'routeName' => 'profile.avatar.settings', 'icon' => 'icon-feather-users'], 
               /* ['name' => 'Coins', 'routeName' => 'profile.settings.coins', 'icon' => 'uil-dollar-alt'], */
                ['name' => 'Homepage', 'routeName' => 'profile.feed.settings', 'icon' => 'uil-home'], 
                ['name' => 'Deactivate Account', 'routeName' => 'profile.deactivate.settings', 'icon' => 'uil-trash-alt']
            ]
        @endphp

        <nav class="responsive-tab style-3 setting-menu"
            uk-sticky="top:30 ; offset:100; media:@m ;bottom:true; animation: uk-animation-slide-top">
            <ul>
                @foreach($links as $link)
                <li @if($route == $link['routeName']) class="uk-active" @endif><a href="{{ route($link['routeName']) }}"> <i class="{{ $link['icon'] }}"></i> {{ $link['name'] }} </a></li>
                @endforeach
            </ul>
        </nav>

    </div>

    <div class="uk-width-2-3@m mt-sm-3 pl-sm-0 p-sm-4">
    
    @yield('settings_page')

    </div>

</div>

</div>



@endsection
