<div class="job-block-details card my-2 border-0">
    <div class="job-block-logo">
        {!! $post->user->displayAvatar() !!}
    </div>

    <div class="job-block-description">
        <a href="{{$route = $post->route()}}">
        <h4>By <a href="#">{{ $post->user->name }}</a> </h4>
        <h3> {{ $post->title }} </h3>
        <p class="job-block-text"> {{ $post->excerpt }}</p>
        </a>
        <div class="job-block-tags">
          @if($post->category)
          <a href="?&category={{ $post->category->name }}" class="button"> {{ $post->category->name }} </a>
          @endif
          @if($post->meta)
            @if($post->meta->location)
            <a href="?&location={{ $post->meta->location }}" class="button">  {{ ucwords($post->meta->location) }}  </a>
            @endif
            @if($post->meta->type)
            <a href="?&job_type={{ $post->meta->type->type }}" class="button">  {{ ucwords($post->meta->type->type) }}  </a>
            @endif
          @endif
        </div>
  </div>

</div>