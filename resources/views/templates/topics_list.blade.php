@include('layouts.partials.alert')



    <div class="mt-3">
      <h1 class="uk-heading-divider">
        
        @if(isset($title))
          {{ $title }} - {{ $posts->count() }}
        @else 
          {{ isset($isHomepage) ? 'Topics Feed' : 'All Topics' }} {{ isset($community) ? 'in '.$community->name : '' }} {{ isset($userTopics) ? 'by '.$user->username : '' }} {{ request()->has('q')? 'relating to "'.request()->q.'"' : '' }}
        @endif      
      </h1>

        @if(isset($isHomepage) && auth()->user())

        @php
          $displayCommunityFeed = (auth()->user()->settings && auth()->user()->settings->feed_type == 'communities') ? true : false;
        @endphp


          <div class="uk-child-width-expand@s mb-4" uk-grid>
              <div>
                <nav class="responsive-tab style-1">
                    <ul>
                        <li @if(!$displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=featured"> Featured Topics</a></li>
                        <li @if($displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=communities"> Followed Communities </a></li>
                    </ul>
                </nav>
              </div>
              <div>
                <div class="text-right block-mobile">
                  <a href="{{ route('posts.new') }}" class="button primary small circle"> <i class="uil-plus"> </i> Create a New Topic
                  </a>
                </div>
              </div>
          </div>        
        @endif

        @if(isset($community))
        <div class="uk-child-width-expand@s mb-4" uk-grid>
            <div>

          </div>
            <div>
              <div class="text-right block-mobile">
              <a href="{{ route('posts.community.new', ['community' => $community->slug]) }}" class="button primary small circle"> <i class="uil-plus"> </i> Create a New Topic
                </a>
              </div>
            </div>
        </div>        
        @endif
    </div>

    @if($posts->count() > 0)
    @foreach($posts as $post)
    @php $route = route('posts.show', ['post' => $post->slug]); @endphp
    <a href="{{ $route }}" class="blog-post mb-sm-3">
      @if($post->featured_image && !$agent->isMobile())
        <div class="blog-post-thumbnail">
            <div class="blog-post-thumbnail-inner">
                <span class="blog-item-tag">{{ $post->category->name }} </span>
                <img src="{{ $post->featured_image }}" alt="">
            </div>
        </div>
      @endif
        <!-- Blog Post Content -->
        <div class="blog-post-content p-sm-1">
            <div class="blog-post-content-info">
                @if(!$post->featured_image || $agent->isMobile())
                <span class="blog-post-info-tag button soft-danger"> {{ $post->category->name }} </span>
                @endif
                <span class="blog-post-info-date">{{ $post->date }}</span>
            </div>
            <h3>{!! request()->has('q') ? $post->highlightSearchQuery($post->title, request()->q) : $post->title !!}</h3>
            @if(!$agent->isMobile())
            {!! request()->has('q') ? $post->highlightSearchQuery($post->excerpt, request()->q) : $post->excerpt !!} </span>
            @endif

            <div class="group-card-content pl-0 p-sm-0 ">
                <p class="info"> 
                <span><i class="icon-feather-user"></i> {{ $post->user->username }} 
                <span><i class="icon-feather-eye ml-2"></i>  
                 {{ $post->views->count() }} views </span> <span> <i class="icon-feather-message-square ml-2"></i> {{ $post->comments->count() }} comments </span>
                 
                 
                </p>
            </div>
        </div>
    </a>    

    @endforeach
    <div class="uk-pagination my-5 uk-flex-center">
        {{ $posts->links('layouts.pagination.custom') }}
    </div>

    @else
      @if(request()->has('q'))
      <p class="text-center text-md-left">No topic found. Be the champion, <a href="{{ route('posts.new') }}"><strong>create a topic</strong></a>.</p>
      @else 
      <p class="text-center text-md-left">No topic found. Be the champion, <a href="{{ route('posts.new') }}"><strong>create a topic</strong></a>.</p>
      @endif
    @endif


