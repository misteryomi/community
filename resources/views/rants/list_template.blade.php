@include('layouts.partials.alert')

    <div class="mt-3">
      <h1 class="uk-heading-divider">
        
        @if(isset($title))
          {{ $title }}
        @else 
         Latest Rants {{ isset($community) ? 'in '.$community->name : '' }} {{ isset($userTopics) ? 'by '.$user->username : '' }} {{ request()->has('q')? 'relating to "'.request()->q.'"' : '' }}
        @endif      
      </h1>


        <a href="{{ route('rants.new') }}" class="button primary small circle"> <i class="uil-plus"> </i> Post a new rant</a>
        <br/><br/>

    </div>

@include('templates.posts_list_template')