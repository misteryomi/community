<ul>
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
