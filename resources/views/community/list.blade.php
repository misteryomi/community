@extends('layouts.app')


@section('content')

<h1> Communities </h1>
<div class="uk-flex uk-flex-between">
    <nav class="responsive-tab style-1 mb-5">
        <ul>
            <li class="uk-active"><a href="#"> All Communities </a></li>
            <li><a href="#"> Joined Communities</a></li>
            <li><a href="#"> My Communities</a></li>
        </ul>
    </nav>
    <a href="#" class="button primary small circle uk-visible@s"> <i class="uil-plus"> </i> Create new
    </a>
</div>


<div class="uk-position-relative" uk-slider="finite: true">

<div class="uk-slider-container pb-3">

    <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s  pr-lg-1 uk-grid"
        uk-scrollspy="target: > div; cls: uk-animation-slide-bottom-small; delay: 100">

        @foreach($communities as $community)
        <li>
            <div class="group-card">

                <!-- Group Card Thumbnail -->
                <div class="group-card-thumbnail">
                    <img src="assets/images/group/group-cover-1.jpg" alt="">
                </div>

                <!-- Group Card Content -->
                <div class="group-card-content">
                    <h3><a href="{{  route('community.list', ['community' => $community->slug]) }}">{{ $community->name }}</a></h3>

                    <p class="info"> <a href="{{  route('community.list', ['community' => $community->slug]) }}"> <span> {{ $community->posts->count() }} Topics  </span> </a> - 
                        <a href="#"> <span> {{ $community->followers->count() }} Followers </span> </a>
                    </p>
                    <div class="uk-width-expand">
                        <p>{{ $community->excerpt }}</p>
                    </div>

                    <div class="group-card-btns">

                        @if($community->userFollows(auth()->user()))
                        <a href="{{ route('community.unfollow', ['community' => $community->slug])  }}" class="button secondary small mb-1">
                                Unfollow</a>
                        @else
                        <a href="{{ route('community.follow', ['community' => $community->slug]) }}" class="button primary small mb-1">
                                Follow</a>
                        @endif
                   </div>

                </div>
            </div>

        </li>
        @endforeach

    </ul>

    <a class="uk-position-center-left-out uk-position-small uk-hidden-hover slidenav-prev" href="#"
        uk-slider-item="previous"></a>
    <a class="uk-position-center-right-out uk-position-small uk-hidden-hover slidenav-next" href="#"
        uk-slider-item="next"></a>

</div>


</div>



@endsection
