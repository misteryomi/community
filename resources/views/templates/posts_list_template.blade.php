@if($posts->count() > 0)
    @foreach($posts as $post)

    @include('posts.post_card')            


    @endforeach
        {{ $posts->links('layouts.pagination.custom') }}

    @else
      @if(request()->has('q'))
      <p class="text-center card  mt-4">No topic found. Be the champion, <a href="{{ route('topics.new') }}"><strong>create a topic</strong></a>.</p>
      @else 
      <p class="text-center card mt-4">No topic found. Be the champion, <a href="{{ route('topics.new') }}"><strong>create a topic</strong></a>.</p>
      @endif
    @endif


