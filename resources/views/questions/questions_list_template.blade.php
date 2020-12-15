@if($posts->count() > 0)
    @foreach($posts as $post)

    @include('questions.post_card')

    @endforeach
    <div class="uk-pagination my-5 uk-flex-center">
        {{ $posts->links('layouts.pagination.custom') }}
    </div>

    @else
      @if(request()->has('q'))
      <p class="text-center text-md-left">No question found. Be the champion, <a href="{{ route('topics.new') }}"><strong>ask a question</strong></a>.</p>
      @else 
      <p class="text-center text-md-left">No question found. Be the champion, <a href="{{ route('topics.new') }}"><strong>ask a question</strong></a>.</p>
      @endif
    @endif