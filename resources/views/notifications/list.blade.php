@extends('layouts.app')
@section('header')

@endsection
@section('content')

    <div class="container mt-5">
      <div class="row">
        <div class="col-xl-12">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white benquiry-0">
              <div class="row align-items-center">
                <div class="col-12">
                  <h3 class="mb-0">Notifications</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if($notifications->isEmpty())
                <p>You have no new notification</p>
              @else
              <ul class="list-group">
                @foreach($notifications as $notification)     
                  @if($notification->route) <a href="{{ route($notification->route) }}"> @endif          
                  <li class="list-group-item"><p class="mb-0">{{ $notification->message }}</p><small>{{ $notification->created_at->diffForHumans() }}</small></li>
                  @if($notification->route)</a> @endif          

                @endforeach
              </ul>            
              @endif
          </div>
          <div class="justify-content-center d-flex mt-4">
            {{ $notifications->links() }}
          </div>
        </div>
      </div>
    </div>


@endsection

@section('script')

@endsection
