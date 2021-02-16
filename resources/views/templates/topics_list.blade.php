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

          </div>        
    </div>

@include('templates.posts_list_template')
@section('additional_scripts')
<script>


$("a.bookmark").click(function(e) {

  e.preventDefault();
  let slug = $(this).data('slug');


  if($(this).hasClass("bookmarked")) {
      $.post('/topic/'+ slug + "/remove-bookmark");
      $(this).removeClass('bookmarked');
      $(this).find("i.fa-bookmark").addClass("fa-bookmark-o").removeClass("fa-bookmark"),
      $(this).find('span').text('Saved for later')
      $(this).attr('uk-tooltip', 'Saved')
      
  } else {
      $.post('topic/' + slug + "/bookmark");
      $(this).addClass('bookmarked');
      $(this).find("i.fa-bookmark-o").addClass("fa-bookmark").removeClass("fa-bookmark-o"),
      $(this).find('span').text('Saved')
      $(this).attr('uk-tooltip', 'Save for later')
  }
});  
</script>
@endsection