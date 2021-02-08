@php $route = $post->route(); @endphp

<div class="card mt-2">
    <div class="pt-2">
        <div class="blog-post-content-info pb-0">
            <span>
            {!! $post->community->displayButton() !!}
            </span>
            <span class="blog-post-info-date"><a href="{{ $post->user->profileRoute() }}">{{ $post->user->username }}</a> &bull; {{ $post->date_ago }}</span>
        </div>
        <a href="{{ $route }}">        
        <div class="uk-flex-middle  ml-0" uk-grid>
            <div class="uk-width-5-5 pl-0">
                <h4 class="m-0 py-2">{!! request()->has('q') ? $post->highlightSearchQuery($post->title, request()->q) : $post->title !!}</h4>
                <p class="m-0 py-2 uk-visible@m">{!! request()->has('q') ? $post->highlightSearchQuery($post->excerpt, request()->q) : $post->excerpt !!}</p>
            </div>
            @if(!empty($post->youtube_id))
                <div class="uk-width-5-5 pl-0 m-0">
                    <div class="card-thumbnail mb-2">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{$post->youtube_id}}"></iframe>
                    </div>
                </div>
            @elseif(!empty($post->featured_image))
                <div class="uk-width-5-5 pl-0 m-0">
                    <div class="card-thumbnail mb-2" style="background-image: url({{ $post->featured_image }})">
                    </div>
                </div>
            @endif
        </div>


        </a>  
        <div class="uk-flex">
            <div class="mr-2 text-dark "><small><i class="icon-feather-message-square ml-2"></i> <strong>{{ $post->comments->count() }} comments</strong></small></div>
            <div class="mr-2"><small> 
                    <a href="#bookmark" data-slug="{{ $post->slug }}" class="mr-2 text-gray bookmark {{ $post->bookmarked() ? 'bookmarked' : '' }} " data-toggle="tooltip" data-placement="top" title="{{ $post->bookmarked() ? 'Remove from Saved' : 'Save for later' }}">
                        <i class="fa {{ $post->bookmarked() ? 'fa-bookmark' : 'fa-bookmark-o' }}"></i> <strong>{{ $post->bookmarked() ? 'Remove from Bookmarks' : 'Save for later' }} </strong>
                    </a>
                </small>
            </div>
            <div>
                    <small><a class="dropdown-arrow" type="button"><strong><i class="fa fa-share"></i> Share</strong></a></small>
                    <div uk-dropdown="mode: click, pos:top-right">
                        <ul class="uk-nav uk-dropdown-nav p-0">
                            <li>
                                <a target="blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&quote={{ $post->title }}&utm_source=jaracentral.com" class="mr-2 text-gray">
                                    <i class="fa fa-facebook"></i> <small><strong>Facebook</strong></small>
                                </a>
                            </li>
                            <li class="uk-nav-divider"></li>
                            <li>
                                <a target="blank" href="http://twitter.com/share?text={{ $post->title }}&url={{ route('posts.show', ['post' => $post->slug]) }}&utm_source=jaracentral.com" class="mr-2 text-gray">
                                    <i class="fa fa-twitter"></i> <small><strong>Twitter</strong></small>
                                </a>
                            </li>
                        </ul>
                    </div>
                

            </div>
        </div>

    </div>
</div>

@section('script')
<script>

$("a.bookmark").click(function(e) {

    e.preventDefault();
    let slug = $(this).data('slug');

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

</script>
@endsection