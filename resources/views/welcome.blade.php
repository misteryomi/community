@extends('layouts.app')


@section('content')


<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
    <div class="uk-width-2-3@m uk-first-column">

    @include('posts.share')


    @include('templates.topics_list')
  </div>
      <div class="uk-width-expand mt-0">
        <div class="rounded bg-grey mb-2">
                <div class="p-5 uk-light"  style="background-blend-mode: color-burn; background-color: rgba(62 65 109, 0.06); background-image: url({{ asset('assets/images/title-bg.png') }})" data-src="{{ asset('assets/images/title-bg.png') }}" uk-img="" >
                    <h4 class="mb-2">
                        <i class="uil-users-alt p-1 text-dark bg-white circle icon-small"></i>
                        Join a Community </h4>
                    <p>  Find interesting communities to join. Connect and discuss anything Nigerian. Do remember to be nice, free and have fun!</p>
                    <a href="{{ route('community.all') }}" class="button white small m-1"> Find a Community</a> 
                </div>
        </div>



  
        @if($engagements->count() > 0)
        <div class="card mb-4">
            <h4 class="mt-2">Top Active Users this Week</h4>
            <hr/>
            @foreach($engagements as $engagement)
            <div class="friend-card">
                <div class="uk-width-auto">
                    <!-- {!! $engagement->user->displayAvatar() !!}  -->
                </div>
                <div class="uk-width-expand">
                    <strong><a href="{{ route('profile.show', [$engagement->user->original_username]) }}">{{ $engagement->user->name }}</a></strong>
                    <p> <small>{{ $engagement->posts_count }} posts | {{ $engagement->comments_count }} comments</small></p>
                </div>
            </div>
            <hr class="my-1"/>
            @endforeach
        </div>
        @endif

    <div class="card mb-4">
        <h4>Trending Topics</h4>
        <hr/>
            <ul class="uk-list uk-list-divider">
                @foreach($trending as $topic)
                <li>
                    <a href="#">{{ $topic->title }} </a> <span class="text-muted"> in
                    <a href="#">{{ $topic->community->name }}</a></span>
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
@endsection

@section('scripts')
    @include('layouts.posts.script')
@endsection
