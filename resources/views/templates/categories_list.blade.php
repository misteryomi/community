    <div class="affixed">

      @if(isset($community))
        <div class="card">
            <div class="card-body text-center">
            {!! $community->icon('lg') !!}
            <h3 class=" mt-2">{{ $community->name }}</h3>
                <p><small>{{ $community->posts->count() }} Topics &nbsp; | &nbsp; {{ $community->followers->count() }} Followers</small></p>
                <p>{{ $community->excerpt }}</p>

                <a href="{{ isset($community) ? route('topics.new', ['community' => $community->slug]) : route('topics.new') }}" class="btn btn-icon btn-block btn-primary mb-1">
                        
                          Create New Topic</a>

                          @if($community->userFollows(auth()->user()))
                          <a href="{{ route('community.unfollow', ['community' => $community->slug])  }}" class="btn btn-icon btn-block btn-outline-dark mb-1">
                                    Unfollow</a>
                          @else
                          <a href="{{ route('community.follow', ['community' => $community->slug]) }}" class="btn btn-icon btn-block btn-outline-primary mb-1">
                                    Follow</a>
                          @endif

            </div>
        </div>

      
        {{-- @if($community->children->count() > 0)
        <p class="mt-4"><strong>Sub Communities</strong><p>
        @endif --}}
      @else
      <a href="{{ isset($community) ? route('topics.new', ['community' => $community->slug]) : route('topics.new') }}" class="btn btn-icon btn-default btn-block mb-4">
            <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
              Create New Topic</a>
      <p><strong>Featured Communities</strong><p>
      @include('templates.categories_list_only')
      @endif
  </div>
