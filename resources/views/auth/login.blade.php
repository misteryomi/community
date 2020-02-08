@extends('layouts.app')

@section('content')
        @include('layouts.partials.alert')
        <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Login to continue</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('post.login') }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="form-control-label" for="username">Username or Email address</label>
              <input type="text" name="username" class="form-control" id="username" placeholder="name@example.com">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="*********">
            </div>
            <button type="submit" class="btn btn-default">Login</button>
          </form>
        </div>
      </div>
@endsection
