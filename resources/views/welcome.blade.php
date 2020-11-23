@extends('layouts.app')


@section('content')
<div class="pt-2 pb-4 mb-3 text-center text-md-left" role="alert">
    <h1>Welcome to {{ env('APP_NAME') }}{{ auth()->user() ? ', '.auth()->user()->username : '' }}!</h1>
    <small>411.ng is an online Nigerian community to connect and discuss anything Nigerian. Remember to be nice, free and have fun!</small>
</div>


<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
    @include('templates.topics_list')
  </div>
  <div class="uk-width-expand uk-grid-margin uk-first-column">
    <div class="sidebar-filter uk-sticky" uk-sticky="offset:30 ; media : @s: bottom: true" style="">
    <a href="{{ route('posts.new') }}" class="button primary block my-3"><i class="icon-feather-plus"></i> Create a New Topic</a>

    <div class="uk-card-default rounded mb-4">

        <ul class="uk-child-width-expand uk-tab" uk-switcher="animation: uk-animation-fade">
            <li class="uk-active"><a href="#" aria-expanded="true">Newest</a></li>
            <li><a href="#" aria-expanded="false">Popular</a></li>
        </ul>

        <ul class="uk-switcher" style="touch-action: pan-y pinch-zoom;">
            <!-- tab 1 -->
            <li class="uk-active">
                <div class="py-3 px-4">

                    <div class="uk-grid-small uk-grid" uk-grid="">
                        <div class="uk-width-expand uk-first-column">
                            <p> Overview of SQL Commands and PDO </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img1.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>
                    <div class="uk-grid-small uk-grid" uk-grid="">
                        <div class="uk-width-expand uk-first-column">
                            <p> Writing a Simple MVC App in Plain </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img2.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>
                    <div class="uk-grid-small uk-grid" uk-grid="">
                        <div class="uk-width-expand uk-first-column">
                            <p> How to Create and Use Bash Scripts </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img3.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>

                </div>
            </li>

            <!-- tab 2 -->
            <li>
                <div class="py-3 px-4">

                    <div class="uk-grid-small uk-grid uk-grid-stack" uk-grid="">
                        <div class="uk-width-expand">
                            <p> Overview of SQL Commands and PDO </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img1.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>
                    <div class="uk-grid-small uk-grid uk-grid-stack" uk-grid="">
                        <div class="uk-width-expand">
                            <p> Writing a Simple MVC App in Plain </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img2.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>
                    <div class="uk-grid-small uk-grid uk-grid-stack" uk-grid="">
                        <div class="uk-width-expand">
                            <p> How to Create and Use Bash Scripts </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img3.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>

                </div>
            </li>
        </ul>

        </div>

        <div class="uk-card-default rounded uk-overflow-hidden">
        <div class="p-4 text-center">

            <h4 class="uk-text-bold"> Subscribe </h4>
            <p> Get latest topics right in your inbox</p>

            <form class="mt-3">
                <input type="text" class="uk-input uk-form-small" placeholder="Enter your email address">
                <input type="submit" value="Subscirbe" class="button primary block mt-3">
            </form>

        </div>
        </div>

        </div><div class="uk-sticky-placeholder" style="height: 540px; margin: 0px;" hidden=""></div>



    </div>

</div>


@endsection
