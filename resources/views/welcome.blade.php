@extends('layouts.app')


@section('content')


<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
    <div class="uk-width-2-3@m uk-first-column">

                <div class="post-newer">

                    <div class="post-new" uk-toggle="target: body ; cls: post-focus">
                        <div class="post-new-media">
                            <div class="post-new-media-user">
                                <img src="assets/images/avatars/avatar-2.jpg" alt="">
                            </div>
                            <div class="post-new-media-input">
                                <input type="text" class="uk-input" placeholder="Share anything... memes, your thoughts, trending videos...">
                            </div>

                        </div>
                        <hr>
                        <div class="post-new-type">

                            <a href="#">
                                <i class="uil-angry pr-2"></i> Rant!
                            </a>

                            <a href="#" class="uk-visible@s">
                                <i class="uil-comment-alt-question pr-2"></i> Ask a Question
                            </a>

                            <a href="#">
                                <i class="uil-briefcase-alt pr-2"></i> Post a Job
                            </a>

                        </div>
                    </div>

                    <div class="post-pop">

                        <div class="post-new-overyly" uk-toggle="target: body ; cls: post-focus"></div>

                        <div class="post-new uk-animation-slide-top-small">


                            <div class="post-new-header">

                                <h4> Post new stuff!</h4>

                                <!-- close button-->
                                <span class="post-new-btn-close" uk-toggle="target: body ; cls: post-focus"
                                    uk-tooltip="title:Close; pos: left "></span>

                            </div>

                            <div class="uk-form-group">
                                    <label>Title</label>
                                    <input type="text" class="uk-input bg-secondary" 
                                        placeholder="Title" autofocus>
                                </div>

                                <div class="uk-position-relative editor-container">
                                    <label>Additional text (completely optional)</label>
                                    <div class="editor"></div>
                                    <textarea class="uk-textarea bg-secondary init-editor" placeholder=""> </textarea>
                                </div>



                            <div class="uk-flex uk-flex-between mt-2">

                                <a href="#" class="button button-block primary px-6"> Share </a>
                            </div>
                        </div>

                    </div>

                </div>



    @include('templates.topics_list')
  </div>
      <div class="uk-width-expand uk-grid-margin uk-first-column">
        <div class="rounded bg-grey mb-2">
                <div class="p-5 uk-light"  style="background-blend-mode: color-burn; background-color: rgba(62 65 109, 0.06); background-image: url({{ asset('assets/images/title-bg.png') }})" data-src="{{ asset('assets/images/title-bg.png') }}" uk-img="" >
                    <h4 class="mb-2">
                        <i class="uil-users-alt p-1 text-dark bg-white circle icon-small"></i>
                        Join a Community </h4>
                    <p>  Find interesting communities to join. Connect and discuss anything Nigerian. Do remember to be nice, free and have fun!</p>
                    <a href="{{ route('community.all') }}" class="button white small m-1"> Find a Community</a> 
                </div>
        </div>

      <!-- <div class="p-5 uk-light"  style="background-blend-mode: color-burn; background-color: rgba(62 65 109, 0.06); background-image: url({{ asset('assets/images/title-bg.png') }})" data-src="{{ asset('assets/images/title-bg.png') }}" uk-img="" >
            <div class="uk-width-4-5">
                <h3 class="mb-2">
                    <i class="uil-users-alt p-1 text-dark bg-white circle icon-small"></i>
                    Groups </h3>
                <p> New ways to find and join communications .</p>
                <a href="#" class="button white small"> Find your groups</a>
            </div>
        </div>         -->


  
        @if($engagements->count() > 0)
        <div class="card mb-4">
            <h4 class="mt-2">Top Active Users this Week</h4>
            <hr/>
            @foreach($engagements as $engagement)
            <div class="friend-card">
                <div class="uk-width-auto">
                    {!! $engagement->user->displayAvatar() !!} 
                </div>
                <div class="uk-width-expand">
                    <strong><a href="{{ route('profile.show', [$engagement->user->name]) }}">{{ $engagement->user->name }}</a></strong>
                    <p> <small>{{ $engagement->posts_count }} posts | {{ $engagement->comments_count }} comments</small></p>
                </div>
            </div>
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
