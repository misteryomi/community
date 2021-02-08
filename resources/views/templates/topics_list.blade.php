@include('layouts.partials.alert')

      @if(auth()->user() && (auth()->user()->followedCommunities()->count() == 0))
      <div class="uk-alert-danger" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <p><strong>You are not following any community at the moment. <a href="{{ route('community.all') }}" class="text-dark">Find a community</a></strong></p>
          </p>
      </div>
      @endif
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
                        <li @if(!$displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=featured"> Featured</a></li>
                        <li @if($displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=communities"> Followed </a></li>
                        <li><a href="{{ route('latest') }}">Latest</a></li>
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