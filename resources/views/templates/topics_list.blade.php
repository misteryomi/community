@include('layouts.partials.alert')



    <div class="mt-3">
      <h1 class="uk-heading-divider">
        
        @if(isset($title))
          {{ $title }}
        @else 
          {{ isset($isHomepage) ? 'Topics Feed' : 'All Topics' }} {{ isset($community) ? 'in '.$community->name : '' }} {{ isset($userTopics) ? 'by '.$user->username : '' }} {{ request()->has('q')? 'relating to "'.request()->q.'"' : '' }}
        @endif      
      </h1>

        @if(isset($isHomepage))

        @php
          $displayCommunityFeed = (auth()->user() && auth()->user()->settings && auth()->user()->settings->feed_type == 'communities') ? true : false;
        @endphp


          <div class="uk-child-width-expand@s mb-4" uk-grid>
              <div>
                <nav class="responsive-tab style-1">
                    <ul>
                        <li @if(!$displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=featured"> Featured Topics</a></li>
                        <li @if($displayCommunityFeed) class="uk-active" @endif><a href="?feed_type=communities"> Followed Communities </a></li>
                    </ul>
                </nav>
              </div>
              <div>
                <div class="text-right block-mobile">
                  <a href="{{ route('topics.new') }}" class="button primary small circle"> <i class="uil-plus"> </i> Create a New Topic
                  </a>
                </div>
              </div>
          </div>        
        @endif

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

@include('templates.posts_list_template')