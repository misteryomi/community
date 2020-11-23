@include('layouts.partials.alert')



    <div class="d-md-flex justify-content-md-between mb-3 mb-md-0">
        <h1 class="font-weight-normal md-0 mb-md-3"><strong>
        
        @if(isset($title))
          {{ $title }}
        @else 
          {{ isset($isHomepage) ? 'Topics Feed' : 'All Topics' }} {{ isset($community) ? 'in '.$community->name : '' }} {{ isset($userTopics) ? 'by '.$user->username : '' }} {{ request()->has('q')? 'relating to "'.request()->q.'"' : '' }}
        @endif      
        </strong></h1>

        @if(isset($isHomepage) && auth()->user())
        <div class="dropdown">
            <a href="#" class="text-dark badge" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog d-inline d-md-none"></i> Displaying {{ auth()->user()->settings && auth()->user()->settings->feed_type == 'communities' ? 'Followed Communities' : 'Featured topics'}} <i class="fa fa-cog d-none d-md-inline"></i>
            </a>
            <div class="dropdown-menu  dropdown-menu-arrow dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="?feed_type=communities"><small>Display Followed Communities</small></a>
                <a class="dropdown-item" href="?feed_type=featured"><small>Display Featured Topics</small></a>
            </div>
        </div>
        @endif
    </div>

    @if($posts->count() > 0)
    @foreach($posts as $post)
    @php $route = route('posts.show', ['post' => $post->slug]); @endphp
    <a href="{{ $route }}" class="blog-post">
      @if($post->featured_image)
        <div class="blog-post-thumbnail">
            <div class="blog-post-thumbnail-inner">
                <span class="blog-item-tag">Tips</span>
                <img src="assets/images/blog/img-1.jpg" alt="">
            </div>
        </div>
      @endif
        <!-- Blog Post Content -->
        <div class="blog-post-content">
            <div class="blog-post-content-info">
                <span class="blog-post-info-tag button soft-danger"> {{ $post->category->name }} </span>
                <span class="blog-post-info-date">{{ $post->date }}</span>
            </div>
            <h3>{!! request()->has('q') ? $post->highlightSearchQuery($post->title, request()->q) : $post->title !!}</h3>
            {!! request()->has('q') ? $post->highlightSearchQuery($post->excerpt, request()->q) : $post->excerpt !!} 

            <div class="group-card-content pl-0">
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
      <p class="text-center text-md-left">Oops! No topic found. Be the champion, <a href="{{ route('posts.new') }}"><strong>click here to create a topic</strong></a>.</p>
      @else 
      <p class="text-center text-md-left">Oops! No topic has been created in this community. Be the champion, <a href="{{ route('posts.new') }}"><strong>click here to create a topic</strong></a>.</p>
      @endif
    @endif


