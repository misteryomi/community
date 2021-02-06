@php $route = $post->route(); @endphp

<div class="card mt-2">
    <div class="pt-2">
        <div class="blog-post-content-info pb-0">
            <span>
            <a href="#"><span href="#" class="blog-post-info-tag button soft-danger"> {{ $post->community->name }} </span></a>
            </span>
            <span class="blog-post-info-date"><a href="">{{ $post->user->username }}</a> &bull; {{ $post->date }}</span>
        </div>
        <a href="{{ $route }}">        
        <div class="uk-flex-middle uk-flex-column@m uk-width-5-5@m ml-0" uk-grid>
            <div class="@if(!empty($post->featured_image)) uk-width-4-5 @endif uk-width-auto@m uk-flex-first@m pl-0">
                <h4 class="m-0 py-2">{!! request()->has('q') ? $post->highlightSearchQuery($post->title, request()->q) : $post->title !!}</h4>
            </div>
            @if(!empty($post->featured_image))
                <div class="uk-width-1-5 uk-width-auto@m pl-0">
                    <div class="card-thumbnail">
                        <img src="{{ $post->featured_image }}" alt="">
                    </div>
                </div>
            @endif
        </div>


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