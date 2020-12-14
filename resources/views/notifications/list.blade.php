@extends('layouts.app')


@section('content')

<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-4-4@m uk-first-column">
    <h1>Notifications</h1>

              @if($notifications->isEmpty())
                <p>You have no new notification</p>
              @else
              <ul class="uk-list uk-list-divider">
                @foreach($notifications as $notification)     
                  @if($notification->route) <a href="{{ route($notification->route) }}"> @endif    
                  <li> <strong><a href="{{  route('profile.show', ['user' =>  $notification->fromUser->clean_username]) }}">{{ $notification->fromUser->username }}</a></strong> <a href="{{ route('notification.show', $notification) }}">{{ $notification->message }}</a><br/><small>{{ $notification->created_at->diffForHumans() }}</small></li>      
                  @if($notification->route)</a> @endif          

                @endforeach
              </ul>            
              @endif
          </ul>

          {{ $notifications->links() }}

  </div>
</div>


@endsection

@section('script')

@endsection
