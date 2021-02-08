@extends('layouts.app')


@section('content')


<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m ">

    @if(isset($isSearchPage))
      <div class="uk-margin border-bottom border-top p-4 bg-light" uk-margin="">
          <form action="{{ route('search') }}" class="uk-grid-small" uk-grid method="get">
              <div class="uk-width-2-5@s">
                  <input class="uk-input uk-form-width-large uk-form-large" name="q" type="text" placeholder="Search Topics" value="{{ request()->q }}" >
              </div>
              <div class="uk-width-1-5@s">
                  <button type="submit" class="button xlarge block dark text-white">Search</button>
              </div>
          </form>
      </div>

    @endif
    @include('templates.topics_list')
  </div>
  <div class="uk-width-1-4 uk-first-column">

        @if(isset($community))


        <div class="card mb-4">
                <div class="p-4 text-center">
        
                    <h4 class="uk-text-bold"> About {{ $community->name}} </h4>

                    {!! $community->displayAvatar() !!}

                    <p>{{ $community->about }}</p>
                    <hr/>
                    <p> <small>{{ $community->posts->count() }} Topics   - 
                        {{ $community->followers->count() }} Followers</small> </p>

                    @if($community->userFollows(auth()->user()))
                    <a href="{{ route('community.unfollow', ['community' => $community->slug])  }}" class="button block secondary  mb-1">
                            Unfollow</a>
                    @else
                    <a href="{{ route('community.follow', ['community' => $community->slug]) }}" class="button block soft-primary  mb-1">
                            Follow</a>
                    @endif                          
                </div>
        
        
        </div>

        @endif
    </div>
 </div>
</div>

@endsection
