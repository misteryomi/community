    <h3><strong>All Topics {{ request()->has('category') ?? 'in '.$request->category }}</strong></h3>
    @if($posts)
    @foreach($posts as $post)
        @php $route = route('posts.show', ['post' => $post->slug]); @endphp
    <div class="card border-0 shadow--hover">
        <div class="card-body  border-top d-flex align-items-center">
            <div class="d-flex align-items-center">
              <a href="#" class="d-none d-md-block" >
                <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                  <i class="ni ni-active-40"></i>
                </div>
              </a>
              <div class="ml-3 mr-4">
                <a href="{{ $route }}" class="text-dark font-weight-600 text-lg" title="{{ $post->title }}">{{ $post->title }}</a>
                <span class="badge badge-md badge-primary mb-1">Category</span>
                <small class="d-block text-muted mt-2">
                  {{ $post->excerpt }} ...
                  <a href="{{ $route }}">Read more</a>
                </small>
              </div>
            </div>
            <div class="text-right d-none d-md-block ml-auto">
                <div class="icon-actions">
                    <a href="{{ $route }}" class="text-muted" title="{{ $post->comments->count() }} Comments">
                      <span class="text-lg"><strong>{{ $post->comments->count() }}</strong></span>
                      <i class="ni ni-chat-round"></i>
                    </a>
                  </div>
              </div>
          </div>
      </div>
      @endforeach
      @endif

    {{ $posts->links() }}


