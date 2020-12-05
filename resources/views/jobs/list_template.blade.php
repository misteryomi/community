@include('layouts.partials.alert')

    <div class="mt-3">
      <h1 class="uk-heading-divider">
        
        @if(isset($title))
          {{ $title }}
        @else 
         Latest Rants {{ isset($community) ? 'in '.$community->name : '' }} {{ isset($userTopics) ? 'by '.$user->username : '' }} {{ request()->has('q')? 'relating to "'.request()->q.'"' : '' }}
        @endif      
      </h1>

      <a href="{{ route('jobs.new') }}" class="button primary small circle"> <i class="uil-plus"> </i> Post a new Job</a>
        <br/><br/>

        @if(isset($community))
        <div class="uk-child-width-expand@s mb-4" uk-grid>
            <div>

          </div>
            <div>
              <div class="text-right block-mobile">
              <a href="{{ route('posts.community.new', ['community' => $community->slug]) }}" class="button primary small circle"> <i class="uil-plus"> </i> Create a New Topic
                </a>
              </div>
            </div>
        </div>        
        @endif
    </div>

@php $routeName = 'rants.show'; @endphp
@include('templates.posts_list_template')