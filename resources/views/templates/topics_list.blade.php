@include('layouts.partials.alert')

    <div class="d-flex justify-content-md-between">
        <h1 class="font-weight-normal mb-3"><strong>{{ isset($isHomepage) ? 'Topics Feed' : 'All Topics' }} {{ isset($community) ? 'in '.$community->name : '' }} {{ isset($userTopics) ? 'by '.$user->username : '' }}</strong></h1>

        @if(isset($isHomepage))
        <div class="dropdown">
            <a href="#" class="text-dark badge" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Displaying Featured topics <i class="fa fa-cog"></i>
            </a>
            <div class="dropdown-menu  dropdown-menu-arrow dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#"><small>Display Followed Communities</small></a>
                <a class="dropdown-item" href="#"><small>Display Featured Topics</small></a>
            </div>
        </div>
        @endif
    </div>

    @if($posts->count() > 0)
    @foreach($posts as $post)
    @php $route = route('posts.show', ['post' => $post->slug]); @endphp
    <div class="card border-0 shadow--hover">
        <div class="card-body  border-top d-flex align-items-center">
            <div class="d-flex align-items-center">
              <a href="#" class="ml--3 ml-lg-0">
                <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                  {{-- <i class="ni ni-active-40"></i> --}}
                  <strong>{{ strtolower(substr($post->title, 0, 1)) }}</strong>
                </div>
              </a>
              <div class="ml-3 ml-lg-3 mr-lg-4">
                <a href="{{ $route }}" class="text-dark font-weight-600 text-lg-lg" title="{{ $post->title }}">{{ $post->title }}</a>
                <span class="badge badge-md badge-primary mb-1">{{ $post->category->name }}</span>
                <small class="d-block text-muted">
                   Posted by {{ $post->user->username }}<br/>
                </small>
                <small class="d-block text-muted mt-2">
                        {{ $post->excerpt }} ...
                  <a href="{{ $route }}">Read more</a>
                </small>
              </div>
            </div>
            <div class="text-right d-none d-md-block ml-auto">
                <div class="icon-actions">
                    <a href="{{ $route }}" class="text-muted" title="{{ $post->pl_comments }} ">
                      <span class="text-lg"><strong>{{ $post->comments->count() }}</strong></span>
                      <i class="ni ni-chat-round"></i>
                    </a>
                  </div>
              </div>
          </div>
    </div>
    @endforeach
    {{ $posts->links() }}

    @else
        <p>Oops! No topic has been created in this community. Be the champion, <a href="{{ route('posts.new') }}"><strong>click here to create a topic</strong></a>.</p>
    @endif


