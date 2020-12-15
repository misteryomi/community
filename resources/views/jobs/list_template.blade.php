@include('layouts.partials.alert')

<div class="mt-3">
  <h1 class="uk-heading-divider">
    
    @if(isset($title))
      {{ $title }}
    @else 
     Latest Jobs {{ isset($community) ? 'in '.$community->name : '' }} {{ isset($userTopics) ? 'by '.$user->username : '' }} {{ request()->has('q')? 'relating to "'.request()->q.'"' : '' }}
    @endif      
  </h1>

  <a href="{{ route('jobs.new') }}" class="button primary small circle"> <i class="uil-plus"> </i> Post a new Job</a>
    <br/>


  <!-- job 1 -->
  <div class="job-block">

    @if($posts->count() > 0)
      @foreach($posts as $post)
      @include('jobs.post_card')
      @endforeach
    </div>

  </div>

  @else
  @if(request()->has('q'))
  <p class="text-center text-md-left">No job found. Be the champion, <a href="{{ route('topics.new') }}"><strong>post a new job</strong></a>.</p>
  @else 
  <p class="text-center text-md-left">No job found. Be the champion, <a href="{{ route('topics.new') }}"><strong>post a new job</strong></a>.</p>
  @endif
@endif

