@extends('layouts.app')


@section('content')

<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
     <div class="uk-width-5-5@m m-auto">
        <div class="mt-lg-4" uk-grid>
            <div class="uk-width-3-3@m">
                @include('layouts.partials.alert')
                <h1 class="mb-0">{{ $post->title }}</h1>
                <div class="group-card-content pl-0 p-sm-0 mb-0 ">
                    <p class="info"> 
                        <a href="{{ route('community.list', ['community' => $post->community->slug]) }}" class="button small"> {{ $post->community->name }} </a>
                        <span><i class="icon-feather-eye ml-2"></i>  
                        {{ $post->views->count() }} views </span> <span> <i class="icon-feather-message-square ml-2"></i> {{ $post->comments->count() }} comments </span>            
                    </p>
                </div>
                

                @if($comments->onFirstPage())
                <div class="user-details-card py-0">
                    <div class="user-details-card-avatar" style="max-width: 40px">
                        <!--{!! $post->user->displayAvatar() !!}-->
                    </div>
                    <div class="user-details-card-name">
                        {{ ucfirst($post->user->username) }} <span> {{ $post->user->level }} <span> {{ $post->date }} </span> </span>
                    </div>
                </div>
                @endif

            </div>
        </div>

        @if($comments->onFirstPage())

        <div class="border-bottom pb-3">


            <div class="blog-content mt-3 mt-lg-6">
                @yield('extra_info_before')

                {!! $post->details !!}

                @yield('extra_info_after')
            </div>
    
            <div class="btn-acts mt-5">
                <div>
                    <a href="#" @guest  uk-toggle="target: #modal-close-default" class="button white circle" @else class="button white circle like {{ $post->liked() ? 'liked ' : '' }}" @endguest uk-tooltip="{{ $post->liked() ? 'Unlike ' : 'Like' }}" title="" aria-expanded="false">
                        <i class="uil-thumbs-up mr-1"></i> <span class="liked_text m-0 pr-1"> {{ $post->liked() ? 'Liked ' : 'Like' }}</span><span class="m-0 {{ $post->likes()->count() > 0  ? '' : 'uk-hidden'  }}"> - <span class=" m-0 likes-count">{{ $post->likes()->count() }}</span></span>
                    </a>
                    @yield('action_buttons')
                </div>
                <div>
                    <a target="blank" title="Share on Facebook" uk-tooltip="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&quote={{ $post->title }}&utm_source=jaracentral.com" class="mr-2 text-gray">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a target="blank" title="Share on Twitter" uk-tooltip="Share on Twitter" href="http://twitter.com/share?text={{ $post->title }}&url={{ route('posts.show', ['post' => $post->slug]) }}&utm_source=jaracentral.com" class="mr-2 text-gray">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#" uk-tooltip="{{ $post->bookmarked() ? 'Remove from Bookmarks' : 'Save for later' }}" class="mr-2 text-gray bookmark {{ $post->bookmarked() ? 'bookmarked' : '' }} " data-toggle="tooltip" data-placement="top" title="{{ $post->bookmarked() ? 'Remove from Saved' : 'Save for later' }}">
                        <i class="fa {{ $post->bookmarked() ? 'fa-bookmark' : 'fa-bookmark-o' }}"></i>
                    </a>

                    <!-- <a href="#" class="#"><i class="uil-share-alt"></i></a> -->
                    <a href="#" class="#"><i class="uil-ellipsis-h"></i></a>

                    <div uk-dropdown="mode: click">
                        <ul class="uk-list uk-list-divider">
                            <li>
                                <a href="#">Report </a>
                            </li>
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
                <div id="comment" class="card mt-3">
                    <div class="card-body text-center">
                        <a href="#" class="uk-margin-small-right" uk-toggle="target: #modal-close-default"><strong>Login/Sign up to drop a comment</strong></a>
                    </div>
                </div>
        @endif


    </div>

  </div>

  <div class="uk-width-expand uk-grid-margin uk-first-column">
    <div class="sidebar-filter uk-sticky" uk-sticky="offset:70 ; media : @s: bottom: true" style="">

    <h3 class="mt-2">Related Topics</h3>
    <div class="uk-card-default rounded mb-4 p-3">
        <ul class="uk-list uk-list-divider">
            @foreach($related as $topic)
            <li>
                <a href="{{ route('posts.show', ['post' => $topic->slug]) }}">{{ $topic->title }} </a>
            </li>
            @endforeach
        </ul>
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
        $('figure.media').each(function() {
            let el = $(this);
            let ytUrlEl = el.find('oembed');
            let ytID = youtube_parser(ytUrlEl.attr('url'));

            el.html(`<iframe width="100%" height="450" src="http://www.youtube.com/embed/${ytID}" frameborder="0" allowfullscreen></iframe>`)
        });
    })


    function youtube_parser(url){
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
        var match = url.match(regExp);
        return (match&&match[7].length==11)? match[7] : false;
    }
    
</script>
<!-- <script src="{{asset('js/post-script.js')}}" ></script> -->
@endsection
