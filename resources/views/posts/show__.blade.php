@extends('layouts.app')

@section('content')

<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
     <div class="uk-width-4-5@m m-auto">
        <div class="mt-lg-4" uk-grid>
            <div class="uk-width-3-3@m">
                <h1>Developing a Wordpress Theme from Scratch</h1>

                <div class="user-details-card pt-0">
                    <div class="user-details-card-avatar" style="max-width: 40px">
                        <img src="{{ $post->user->avatar }}" alt="">
                    </div>
                    <div class="user-details-card-name">
                        {{ ucfirst($post->user->username) }} <span> {{ $post->user->level }} <span> {{ $post->date }} </span> </span>
                    </div>
                </div>

            </div>
        </div>


        <a href="#" class="button default small"> Css </a>
        <a href="#" class="button default small"> Design</a>


        <div class="blog-content mt-3 mt-lg-6">
            {!! $post->details !!}
        </div>



        <br>
        <br>



    </div>

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







    <div class="row">
        <div class="col-md-3 d-none d-lg-block">
            <a href="#comment" class="btn mb-2 btn-default btn-block text-center">
                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                <span class="btn-inner--text">Reply Topic</span>
            </a>

            <div class="card my-4">
                @php $user = $post->user; @endphp
                @include('profile.user_card')
            </div>
        </div>


        <div class="col-md-9">
            <h1 class="mb-1"> {{ $post->title }}</h1>
            <small>{{ $post->pl_comments }} | {{ $post->pl_views }}</small><br/>
            <a href="#comment" class=" d-lg-none btn btn-default btn-sm btn-icon">
                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                <span class="btn-inner--text">Reply Topic</span>
            </a>
            @if($comments->onFirstPage())
            <div class="card mx--3 mx-md-0 mt-2">
                <div class="list-group list-group-flush">
                    <div class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                        <div class="d-flex w-100 justify-content-between">
                        <div>
                        <a href="{{ route('profile.show', ['user' => $post->user->username]) }}">
                            <div class="d-flex  align-items-center">
                                <img src="{{ $post->user->avatar }}" alt="{{ ucfirst($post->user->username) }}" class="avatar avatar-xs mr-2">
                                <h5 class="mb-1">{{ ucfirst($post->user->username) }}
                                <br/><small class="text-gray">{{ $post->user->short_bio }}</small>
                                </h5>

                            </div>
                        </a>
                    </div>
                    <br/><small class="text-gray">{{ $post->date }}</small>
                    </div>
                    <div class="my-4">{!! $post->details !!}</div>

                        <div class="row align-items-center border-top pt-3">
                            <div class="col-sm-6">
                                <a href="#" class="text-gray ">
                                    <i class="fa fa-xlg like {{ $post->liked() ? 'liked fa-thumbs-up ' : 'fa-thumbs-o-up ' }}"></i>
                                    <small class="text-muted likes-count {{ $post->likes()->count() > 0  ? '' : 'd-none'  }}">{{ $post->likes()->count() }}</small>
                                </a>
                            </div>

                            <div class="col-sm-6 text-right">
                                <a target="blank" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&quote={{ $post->title }}&utm_source=facebook" class="mr-2 text-gray">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a target="blank" title="Share on Twitter" href="http://twitter.com/share?text={{ $post->title }}&url=https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&text={{ $post->title }}&utm_source=twitter" class="mr-2 text-gray">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="mr-2 text-gray bookmark {{ $post->bookmarked() ? 'bookmarked' : '' }} " data-toggle="tooltip" data-placement="top" title="{{ $post->bookmarked() ? 'Remove from Saved' : 'Save for later' }}">
                                 <i class="fa {{ $post->bookmarked() ? 'fa-bookmark' : 'fa-bookmark-o' }}"></i>
                                </a>
                                <div class="dropdown">
                                    <a class="px-2 text-gray" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-160px, -60px, 0px);">
                                        @if(auth()->user() && auth()->user()->canEditPost($post))
                                            <a class="dropdown-item" href="{{ route('posts.edit', ['post' => $post->slug]) }}">
                                                <span class="text-muted">Edit</span>
                                            </a>
                                            @endif
                                            @if(auth()->user() && auth()->user()->canDeletePost($post))
                                            <a class="dropdown-item" href="{{ route('posts.delete', ['post' => $post->slug]) }}">
                                                <span class="text-muted">Delete</span>
                                            </a>
                                            @endif
                                            <a class="dropdown-item"  href="#">
                                                <span class="text-muted">Report Post</span>
                                            </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
          @include('templates.comments')
          @if(auth()->user())
          @include('templates.comment')
          @else
                <div id="comment" class="card mt-3">
                    <div class="card-body text-center">
                        <a href="#" data-toggle="modal" data-target="#auth-modal"><strong>Drop your comment</strong></a>               
                    </div>
                </div>
          @endif
          
        </div>

    </div>
@endsection

@section('scripts')
@include('templates.scripts.tinymce')

<script>
    var slug = "{{ $post->slug }}";
    var loggedIn = "{{ auth()->check() ? true : false }}"
</script>
<script src="{{asset('js/post-script.js')}}" ></script>
@endsection
