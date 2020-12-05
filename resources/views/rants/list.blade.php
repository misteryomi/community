@extends('layouts.app')


@section('content')


<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
    @include('rants.list_template')
  </div>
  <div class="uk-width-expand uk-grid-margin uk-first-column">
    <div class="sidebar-filter uk-sticky" uk-sticky="offset:30 ; media : @s: bottom: true" style="">


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

            <h4 class="uk-text-bold"> Subsicribe </h4>
            <p> Get the Latest Posts and Article for us On Your Email</p>

            <form class="mt-3">
                <input type="text" class="uk-input uk-form-small" placeholder="Enter your email address">
                <input type="submit" value="Subscirbe" class="button button-default block mt-3">
            </form>

        </div>
        </div>

        </div><div class="uk-sticky-placeholder" style="height: 540px; margin: 0px;" hidden=""></div>



    </div>

</div>

@endsection
