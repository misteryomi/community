<div class="job-block-details">
    <div class="job-block-logo">
        {!! $post->user->displayAvatar() !!}
    </div>

    <div class="job-block-description">
        <a href="{{$route = $post->route()}}">
        <h4>By {{ $post->user->name }} </h4>
        <h3> {{ $post->title }} </h3>
        <p class="job-block-text"> {{ $post->excerpt }}</p>
        </a>
        <div class="job-block-tags">
            <a href="{{ route('community.list', ['community' => $post->community->name]) }}" class="button"> {{ $post->community->name }} </a>
          <a href="{{ route('community.list', ['community' => $post->community->name]) }}" class="button"> Lagos </a>
          <a href="{{ route('community.list', ['community' => $post->community->name]) }}" class="button"> Full Time </a>
          <a href="{{ route('community.list', ['community' => $post->community->name]) }}" class="button"> Sample Keyword </a>
        </div>
  </div>

</div>