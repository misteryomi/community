@include('layouts.partials.alert')



    <div class="mt-3 card">
        @if(isset($title))
        <h1 class="uk-heading-divider">{{ $title }}</h1>
        @elseif(!isset($isHomepage))
          <h1 class="uk-heading-divider">{{  'All Topics' }} {{ isset($community) ? 'in '.$community->name : '' }} {{ isset($userTopics) ? 'by '.$user->username : '' }} {{ request()->has('q')? 'relating to "'.request()->q.'"' : '' }}</h1>          
        @endif     



          <div class="uk-child-width-expand@s " uk-grid>
            @if(isset($displayTopicsType))
              @php
                $displayCommunityFeed = (auth()->user() && auth()->user()->settings && auth()->user()->settings->feed_type == 'communities') ? true : false;
              @endphp
              <div>
                <nav class="responsive-tab style-2 ">
                    <ul>
                        <li @if(!$displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=featured"> Featured</a></li>
                        <li @if($displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=communities"> Followed Communities </a></li>
                    </ul>
                </nav>
              </div>
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