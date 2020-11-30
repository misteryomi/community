@extends('layouts.app')

@section('content')
<div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-1-3@m uk-width-1-2@s m-auto">
            <div class="px-2 uk-animation-scale-up">
        <div class="my-4 uk-text-center">
            <h1 class="mb-2">@yield('code') - @yield('title')  </h1>
            <p class="my-2">@yield('message')</p>
            <a href="{{ route('home') }}" class="uk-link text-primary">Take me back to the homepage</a> 
        </div>
</div>
</div>
</div>
@endsection