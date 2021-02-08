@extends('layouts.app')


@section('content')

<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
    <div class="uk-width-2-3@m">
     <div class="uk-width-5-5@m m-auto">
        <div class="mt-lg-4" uk-grid>
            <div class="uk-width-3-3@m">
                @include('layouts.partials.alert')
                
                <h1 class="mt-3 lead-text text-dark mb-0">{{ $post->title }}</h1>

                

                <div class="uk-flex mt-2">            
                    <div class="mr-2 text-dark ">{!! $post->community->displayButton(true) !!}</div>
                    <div class="mr-2 text-dark "><small><i class="icon-feather-message-square ml-2"></i> <strong>{{ $post->comments->count() }} comments</strong></small></div>
                    <div class="mr-2 text-dark "><small><i class="icon-feather-eye"></i> <strong>{{ $post->views->count() }} views</strong></small></div>
                </div>


            </div>
        </div>

        @if($comments->onFirstPage())

        <div class="mt-2 card">
                <div class="user-details-card py-0">
                    <div class="user-details-card-avatar" style="max-width: 40px">
                        {!! $post->user->displayAvatar() !!}
                    </div>
                    <div class="user-details-card-name">
                        {{ ucfirst($post->user->username) }} <span> {{ $post->user->level }}<span><small>{{ $post->date }}</small> </span> </span>
                    </div>
                </div>


            <div class="blog-content mt-3 mt-lg-6">
                @yield('extra_info_before')

                {!! $post->details !!}
                

                @yield('extra_info_after')
            </div>
    
            <div class="btn-acts mt-5">
                <div>
                    <a href="#" @guest  uk-toggle="target: #modal-close-default" class="button white circle" @else class="button white circle like {{ $post->liked() ? 'liked ' : '' }}" @endguest uk-tooltip="{{ $post->liked() ? 'Unlike ' : 'Like' }}" title="" aria-expanded="false">
                       <small> <i class="uil-thumbs-up mr-1"></i> <span class="liked_text m-0 pr-1"> {{ $post->liked() ? 'Liked ' : 'Like' }}</span><span class="m-0 {{ $post->likes()->count() > 0  ? '' : 'uk-hidden'  }}"> - <span class=" m-0 likes-count">{{ $post->likes()->count() }}</span></span></small>
                    </a>
                    @yield('action_buttons')
                </div>
                <div>
                @include('layouts.posts.share')
                    <!-- <a href="#" class="#"><i class="uil-share-alt"></i></a> -->
                    <a href="#" class="#"><i class="uil-ellipsis-h"></i></a>

                    <div uk-dropdown="mode: click">
                        <ul class="uk-list uk-list-divider">
                            <!-- <li>
                                <a href="#">Report </a>
                            </li> -->
                            @if($post->canEdit())
                            <li>
                                <a href="{{ route('posts.edit', ['post' => $post->slug]) }}">Edit</a>
                            </li>
                            @endif
                            

                            @if($post->canModerate())
                            <li>
                                @if($post->is_featured)
                                <a href="{{ route('posts.remove-featured', ['post' => $post->slug]) }}">Remove from Featured</a> 
                                @else
                                <a href="{{ route('posts.set-featured', ['post' => $post->slug]) }}">Set as Featured</a> 
                                @endif
                            </li>
                            @endif
                        </ul>
                    </div>                
                
                </div>
            </div>
        </div>
    
        @endif
          @include('templates.comments')
          @if(auth()->user())
          @include('templates.comment')
          @else
                <div id="comment" class="card">
                    <textarea uk-toggle="target: #modal-close-default" class="uk-textarea" rows="5" placeholder="Drop a comment"></textarea>
                        <!-- <a href="#" class="uk-margin-small-right" uk-toggle="target: #modal-close-default"><strong>Login/Sign up to drop a comment</strong></a> -->
                </div>
        @endif


    </div>

  </div>

  <div class="uk-width-expand uk-grid-margin uk-first-column">
    <div class="sidebar-filter uk-sticky" uk-sticky="offset:70 ; media : @s: bottom: true" style="">
    <div class="card">
    <h4>Related</h4>
    <hr class="mt-0"/>
        <ul class="uk-list uk-list-divider">
            @foreach($related as $topic)
            <li>
                <a href="{{ route('posts.show', ['post' => $topic->slug]) }}">{{ $topic->title }} </a>
            </li>
            @endforeach
        </ul>
    </div>
    </div>
</div>




@endsection

@section('scripts')
<script>
    var uploadURL  = "{{ route('media.upload') }}"

</script>
@include('templates.scripts.tinymce')
<script>
    var slug = "{{ $post->slug }}";
    var loggedIn = "{{ auth()->check() ? true : false }}"

    $(document).ready(function() {

        $('a.like').click(function(e) {
            e.preventDefault();

            var likesCountEl = $(this).find('.likes-count');
            var likesCount = parseInt(likesCountEl.text());

                if($(this).hasClass("liked")) {
                    $.post(slug + "/unlike");
                    $(this).removeClass("liked");
                    $(this).find('.liked_text').text('Like');
                    $(this).attr('uk-tooltip', 'Like')
                    likesCountEl.text(likesCount - 1);
                } else {
                    $.post(slug + "/like");
                    $(this).addClass("liked");
                    $(this).find('.liked_text').text('Liked');
                    $(this).attr('uk-tooltip', 'Unlike')
                    likesCountEl.text(likesCount + 1);
                }

        })


        $("a.bookmark").click(function(e) {

            e.preventDefault();

                 if($(this).hasClass("bookmarked")) {
                    $.post(slug + "/remove-bookmark");
                    $(this).removeClass('bookmarked');
                    $("a.bookmark > i").addClass("fa-bookmark-o").removeClass("fa-bookmark"),
                    $(this).attr('uk-tooltip', 'Remove from Bookmarks')
                } else {
                    $.post(slug + "/bookmark");
                    $(this).addClass('bookmarked');
                    $("a.bookmark > i").addClass("fa-bookmark").removeClass("fa-bookmark-o"),
                    $(this).attr('uk-tooltip', 'Save for later')
                }
        });


        $('#submit-comment').click(function(e) {
          e.preventDefault();

          let post = editor.getData();

          $("input[name=comment]").val(post);

          $('#comment-form').submit();

          return false;
        })


        //Fix oembedd 
        $('.blog-content figure.media').each(function() {
            let el = $(this);
            let ytUrlEl = el.find('oembed');
            let url = ytUrlEl.attr('url');
            let ytID = youtube_parser(url);
            let twtURL = twitter_parser(url);

            if(ytID) {
                el.html(`<iframe width="100%" height="450" src="http://www.youtube.com/embed/${ytID}" frameborder="0" allowfullscreen></iframe>`)
            } else if(twtURL) {
                el.html(`<blockquote class="twitter-tweet"><a href="${twtURL}"></a></blockquote>`)
            }
        });
    })


    function youtube_parser(url){

        var yt_regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
        var yt_match = url.match(yt_regExp);


        if(yt_match) {
            return (yt_match && yt_match[7].length==11)? yt_match[7] : false;
        }
    }
    

    function twitter_parser(url){

        var twt_regExp = /http(?:s)?:\/\/(?:www\.)?twitter\.com\/([a-zA-Z0-9_]+)/;
        var twt_match = url.match(twt_regExp);


        if(twt_match) {
            return twt_match['input']? twt_match['input'] : false;
        }
    }
    
</script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>                <!-- <blockquote class="twitter-tweet"><p lang="en" dir="ltr">Sunsets don&#39;t get much better than this one over <a href="https://twitter.com/GrandTetonNPS?ref_src=twsrc%5Etfw">@GrandTetonNPS</a>. <a href="https://twitter.com/hashtag/nature?src=hash&amp;ref_src=twsrc%5Etfw">#nature</a> <a href="https://twitter.com/hashtag/sunset?src=hash&amp;ref_src=twsrc%5Etfw">#sunset</a> <a href="http://t.co/YuKy2rcjyU">pic.twitter.com/YuKy2rcjyU</a></p>&mdash; US Department of the Interior (@Interior) <a href="https://twitter.com/Interior/status/463440424141459456?ref_src=twsrc%5Etfw">May 5, 2014</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> -->

<!-- <script src="{{asset('js/post-script.js')}}" ></script> -->
@endsection
