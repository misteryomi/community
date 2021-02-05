@php $route = $post->route(); @endphp
<div class="uk-text-center" uk-grid>
    <div class="uk-width-auto@m">
        <div class="uk-card uk-card-default uk-card-body">Auto</div>
    </div>
    <div class="uk-width-1-3@m">
        <div class="uk-card uk-card-default uk-card-body">1-3</div>
    </div>
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default uk-card-body">Expand</div>
    </div>
</div>

<div class="card mt-2">
    <div class="pt-2">
        <div class="blog-post-content-info pb-0">
            <span>
            <a href="#"><span href="#" class="blog-post-info-tag button soft-danger"> {{ $post->community->name }} </span></a>
            </span>
            <span class="blog-post-info-date"><a href="">{{ $post->user->username }}</a> &bull; {{ $post->date }}</span>
        </div>
        <a href="{{ $route }}">        
        <h4 class="m-0 py-2">{!! request()->has('q') ? $post->highlightSearchQuery($post->title, request()->q) : $post->title !!}</h4>
        @if(!empty($post->featured_image))
        <div class="my-2 mb-2 card-thumbnail">
            <img src="{{ $post->featured_image }}" alt="">
        </div>
        @endif
        </a>  
        <div class="uk-flex">
            <div class="mr-2 text-dark "><small><i class="icon-feather-message-square ml-2"></i> <strong>{{ $post->comments->count() }} comments</strong></small></div>
            <div class="mr-2"><small> 
                    <a href="#bookmark" class="mr-2 text-gray bookmark {{ $post->bookmarked() ? 'bookmarked' : '' }} " data-toggle="tooltip" data-placement="top" title="{{ $post->bookmarked() ? 'Remove from Saved' : 'Save for later' }}">
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