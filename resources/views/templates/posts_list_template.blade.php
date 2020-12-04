@if($posts->count() > 0)
    @foreach($posts as $post)

    @php $route = route(isset($routeName) ? $routeName : 'posts.show', ['post' => $post->slug]); @endphp
    <a href="{{ $route }}" class="blog-post mb-sm-3">
      @if($post->featured_image && !$agent->isMobile())
        <div class="blog-post-thumbnail">
            <div class="blog-post-thumbnail-inner">
                <span class="blog-item-tag">{{ $post->community->name }} </span>
                <img src="{{ $post->featured_image }}" alt="">
            </div>
        </div>
      @endif
        <!-- Blog Post Content -->
        <div class="blog-post-content p-sm-1">
            <div class="blog-post-content-info">
                @if(!$post->featured_image || $agent->isMobile())
                <span class="blog-post-info-tag button soft-danger"> {{ $post->community->name }} </span>
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


