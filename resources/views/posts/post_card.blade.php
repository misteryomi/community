@php $route = $post->route(); @endphp
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
        {!! request()->has('q') ? $post->highlightSearchQuery($post->excerpt, request()->q) : $post->excerpt !!} </span>
        @if($post->featured_image && $agent->isMobile())
        <div class="blog-post-thumbnail my-2 mb-3">
            <div class="blog-post-thumbnail-inner">
                <img src="{{ $post->featured_image }}" alt="">
            </div>
        </div>
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
