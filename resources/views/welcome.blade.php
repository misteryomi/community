@extends('layouts.app')


@section('content')

<div class="mb-3 rounded bg-grey">
    <div class="p-5 uk-light"  style="background-blend-mode: color-burn; background-color: rgba(62 65 109, 0.06); background-image: url({{ asset('assets/images/title-bg.png') }})" data-src="{{ asset('assets/images/title-bg.png') }}" uk-img="" >
        <div class="uk-width-5-5">
            <h3 class="mb-2">
                <i class="uil-users-alt p-1 text-dark bg-white circle icon-small"></i>
                Welcome{{ auth()->user() ? ', '.auth()->user()->username : ' to ' .env('APP_NAME') }}! </h3>
            <p>  {{ env('APP_NAME') }} is an online Nigerian community to connect and discuss anything Nigerian.<br/>Remember to be nice, free and have fun!</p>
            <a href="{{ route('community.all') }}" class="button white small m-1"> Find a Community</a> <a href="{{ route('question.new') }}" class="button white small m-1"> Ask a question</a> <a href="{{ route('rants.new') }}" class="button white small m-1"> Rant!</a>
        </div>
    </div>
</div>




<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-2-3@m uk-first-column">
    @include('templates.topics_list')
  </div>
  <div class="uk-width-expand uk-grid-margin uk-first-column">
    <div class="sidebar-filter uk-sticky" uk-sticky="offset:70 ; media : @s: bottom: true" style="">

        @if($engagements->count() > 0)
        <div class="mb-4">
            <h3 class="mt-2">Top Active Users this Week</h3>
            @foreach($engagements as $engagement)
            <div class="friend-card">
                <div class="uk-width-auto">
                    {{-- {!! $engagement->user->displayAvatar() !!} --}}
                </div>
                <div class="uk-width-expand">
                    <h3><a href="{{ route('profile.show', [$engagement->user->name]) }}">{{ $engagement->user->name }}</a></h3>
                    <p> <small>{{ $engagement->posts_count }} posts | {{ $engagement->comments_count }} comments</small></p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

    <h3 class="mt-2">Trending Topics</h3>
    <div class="uk-card-default rounded mb-4 p-3">
        <ul class="uk-list uk-list-divider">
            @foreach($trending as $topic)
            <li>
                <a href="#">{{ $topic->title }} </a>
            </li>
            @endforeach
            <li>
                <a href="{{ route('trending') }}"><strong>See More →</strong></a>
            </li>
        </ul>
    </div>
    
    <!-- Sidebar Ads -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-3576547045661858"
         data-ad-slot="4076916587"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>    

</div>


@endsection
