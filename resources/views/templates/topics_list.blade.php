@include('layouts.partials.alert')

    <div class="mt-3 card">
        @if(isset($title))
        <h3 class="m-0">{{ $title }}</h3>
        @elseif(!isset($isHomepage))
          <h3 class="m-0">{{  'All Topics' }} {{ isset($community) ? 'in '.$community->name : '' }} {{ isset($userTopics) ? 'by '.$user->username : '' }} {{ request()->has('q')? 'relating to "'.request()->q.'"' : '' }}</h3>          
        @endif     



          <div class="uk-child-width-expand@s " uk-grid>
            @if(isset($displayTopicsType))
              @php
                $displayCommunityFeed = (auth()->user() && auth()->user()->settings && auth()->user()->settings->feed_type == 'communities') ? true : false;
              @endphp
                <nav class="responsive-tab style-1 ">
                    <ul>
                        <li @if(!$displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=featured"><i class="icon-feather-activity"></i> Featured</a></li>
                        <li @if($displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=communities"><i class="icon-feather-users"></i> Followed </a></li>
                        <li @if($displayCommunityFeed) class="uk-active" @endif><a href="{{ route('trending')}}"><i class="uil-fire"></i> Trending </a></li>
                        <li><a href="{{ route('latest') }}"><i class="icon-feather-chevrons-down"></i>Latest</a></li>
                    </ul>
                </nav>
              @endif

              <!-- <div>
                <div class="mt-3 @if(isset($displayTopicsType)) text-right @endif block-mobile">
                  <a href="{{ route('topics.new') }}" class="button primary small circle"> <i class="uil-plus"> </i> Create a New Topic
                  </a>
                </div>
              </div> -->
          </div>        
    </div>

@include('templates.posts_list_template')