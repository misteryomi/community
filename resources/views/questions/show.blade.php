@extends('layouts.app')


@section('content')

<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
     <div class="uk-width-5-5@m m-auto">
        <div class="mt-lg-4" uk-grid>
            <div class="uk-width-3-3@m">
                <h1 class="mb-0">{{ $rant->title }}</h1>
                <div class="group-card-content pl-0 p-sm-0 mb-0 ">
                    <p class="info"> 
                        <a href="{{ route('mood.list', ['mood' => $rant->mood->slug]) }}" class="button small"> {{ $rant->mood->name }} </a>
                        <span><i class="icon-feather-eye ml-2"></i>  
                        {{ $rant->views->count() }} views </span> <span> <i class="icon-feather-message-square ml-2"></i> {{ $rant->comments->count() }} comments </span>            
                    </p>
                </div>
                
    
                @if($rant->canEdit())
                   <!-- <a href="{{ route('rants.edit', ['rant' => $rant->slug]) }}">Edit</a> -->
                @endif


                @if($comments->onFirstPage())
                <div class="user-details-card py-0">
                    <div class="user-details-card-avatar" style="max-width: 40px">
                        <img src="{{ $rant->user->avatar }}" alt="">
                    </div>
                    <div class="user-details-card-name">
                        {{ ucfirst($rant->user->username) }} <span> {{ $rant->user->level }} <span> {{ $rant->date }} </span> </span>
                    </div>
                </div>
                @endif

            </div>
        </div>

        @if($comments->onFirstPage())

        <div class="border-bottom pb-3">


            <div class="blog-content mt-3 mt-lg-6">
                {!! $rant->details !!}
            </div>
    
            <div class="btn-acts mt-5">
                <div>
                </div>
                <div>
                    <a target="blank" title="Share on Facebook" uk-tooltip="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('rants.show', ['rant' => $rant->slug]) }}&quote={{ $rant->title }}&utm_source=facebook" class="mr-2 text-gray">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a target="blank" title="Share on Twitter" uk-tooltip="Share on Twitter" href="http://twitter.com/share?text={{ $rant->title }}&url=https://www.facebook.com/sharer/sharer.php?u={{ route('rants.show', ['rant' => $rant->slug]) }}&text={{ $rant->title }}&utm_source=twitter" class="mr-2 text-gray">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <!-- <a href="#" class="#"><i class="uil-share-alt"></i></a> -->
                    <a href="#" class="#"><i class="uil-ellipsis-h"></i></a>

                    <div uk-dropdown="mode: click">
                        <ul class="uk-list uk-list-divider">
                            <li>
                                <a href="#">Report </a>
                            </li>
                            @if($rant->canEdit())
                            <li>
                                <a href="{{ route('rants.edit', ['rant' => $rant->slug]) }}">Edit</a>
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
                        <a href="#" data-toggle="modal" data-target="#auth-modal"><strong>Login/Sign up to drop a comment</strong></a>               
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
                <a href="{{ route('rants.show', ['rant' => $topic->slug]) }}">{{ $topic->title }} </a>
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
    var slug = "{{ $rant->slug }}";
    var loggedIn = "{{ auth()->check() ? true : false }}"

    $(document).ready(function() {

        $('a.like').click(function(e) {
            e.preventDefault();

            var likesCountEl = $(this).find('.likes-count');
            var likesCount = parseInt(likesCountEl.text());

                if($(this).hasClass("liked")) {
                    $.rant(slug + "/unlike");
                    $(this).removeClass("liked");
                    $(this).find('.liked_text').text('Like');
                    $(this).attr('uk-tooltip', 'Like')
                    likesCountEl.text(likesCount - 1);
                } else {
                    $.rant(slug + "/like");
                    $(this).addClass("liked");
                    $(this).find('.liked_text').text('Liked');
                    $(this).attr('uk-tooltip', 'Unlike')
                    likesCountEl.text(likesCount + 1);
                }

        })


        $("a.bookmark").click(function(e) {

            e.preventDefault();

                 if($(this).hasClass("bookmarked")) {
                    $.rant(slug + "/remove-bookmark");
                    $(this).removeClass('bookmarked');
                    $("a.bookmark > i").addClass("fa-bookmark-o").removeClass("fa-bookmark"),
                    $(this).attr('uk-tooltip', 'Remove from Bookmarks')
                } else {
                    $.rant(slug + "/bookmark");
                    $(this).addClass('bookmarked');
                    $("a.bookmark > i").addClass("fa-bookmark").removeClass("fa-bookmark-o"),
                    $(this).attr('uk-tooltip', 'Save for later')
                }
        });


        $('#submit-comment').click(function(e) {
          e.preventDefault();

          let rant = editor.getData();

          $("input[name=comment]").val(rant);

          $('#comment-form').submit();

          return false;
        })


    })
</script>
<!-- <script src="{{asset('js/rant-script.js')}}" ></script> -->
@endsection
