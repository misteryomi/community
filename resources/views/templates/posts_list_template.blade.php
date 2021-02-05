@if($posts->count() > 0)
    @foreach($posts as $post)

    @include('posts.post_card')            


    @endforeach
    <div class="uk-pagination my-5 uk-flex-center">
        {{ $posts->links('layouts.pagination.custom') }}
    </div>

    @else
      @if(request()->has('q'))
      <p class="text-center card  mt-4">No topic found. Be the champion, <a href="{{ route('topics.new') }}"><strong>create a topic</strong></a>.</p>
      @else 
      <p class="text-center card mt-4">No topic found. Be the champion, <a href="{{ route('topics.new') }}"><strong>create a topic</strong></a>.</p>
      @endif
    @endif


