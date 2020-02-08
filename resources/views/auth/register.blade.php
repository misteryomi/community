@extends('layouts.app')

@section('content')
        @include('layouts.partials.alert')
        <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Create an account</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('post.register') }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="form-control-label" for="username">Desired Username</label>
              <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="email">Email address</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
            </div>
            <div class="form-group">
              <label class="form-control-label" for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="*********">
            </div>
            <button type="submit" class="btn btn-default">Create account</button>
          </form>
        </div>
      </div>
@endsection
