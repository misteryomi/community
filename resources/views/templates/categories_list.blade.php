    <div class="affixed">

      @if(isset($community))
        <div id="card-blockquote-component" class="tab-pane text-center" role="tabpanel" aria-labelledby="card-blockquote-component-tab">
        <div class="card bg-gradient-default">
            <div class="card-body">
            {!! $community->icon('lg') !!}                
            <h3 class="card-title text-white mt-2">{{ $community->name }}</h3>
            <blockquote class="blockquote text-white mb-0">
                <p>{{ $community->description }}</p>

                <a href="{{ isset($community) ? route('posts.new', ['community' => $community->slug]) : route('posts.new') }}" class="btn btn-icon btn-block btn-white mb-1">
                        <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                          Create New Topic</a>

                @if($community->userFollows(auth()->user()))
                <a href="{{ route('community.unfollow', ['community' => $community->slug])  }}" class="btn btn-icon btn-block btn-dark mb-1">
                        <span class="btn-inner--icon">
                          Unfollow</a>
                @else
                <a href="{{ route('community.follow', ['community' => $community->slug]) }}" class="btn btn-icon btn-block btn-danger mb-1">
                        <span class="btn-inner--icon"><i class="fa fa-users"></i></span>
                          Follow</a>
                @endif
                
            </blockquote>
            </div>
        </div>
        </div>


        @if($community->children->count() > 0)
        <p class="mt-4"><strong>Sub Categories</strong><p>
        @endif
      @else
      <a href="{{ isset($community) ? route('posts.new', ['community' => $community->slug]) : route('posts.new') }}" class="btn btn-icon btn-default btn-block mb-4">
            <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
              Create New Topic</a>

      <p><strong>Featured Categories</strong><p>
      @endif

      <ul class="navbar-nav sidebar-nav">
          @php $communities = isset($isHomepage) ? $communities : $community->children; @endphp 
          @foreach($communities as $community)
          <li class="nav-item  class=">
          <a class=" nav-link active " href="{{ route('community.list', ['community' => $community->slug]) }}">
            {!! $community->icon() !!}

            <span class="ml-3">
                {{ $community->name }}
            </span>
            </a>
          </li>
          @endforeach
        </ul>
    </div>
