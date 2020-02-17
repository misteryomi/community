@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
              <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <h4>Reset Password</h4>
                    <small>Please enter your email address or username to continue</small>
                  </div>

                  @include('layouts.partials.alert')

                  <form action="{{ route('post.forgot-password') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                     <label><small>Username or email address</small></label>
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input class="form-control" name="username"  placeholder="Username or email address">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-block btn-primary my-4">Reset Password</button>
                    </div>
                  </form>
                  <hr/>
                  <div class="text-center mt-4">
                    <a href="{{ route('login') }}"><small><strong>Go back to login</strong></small></a><br/>
                    <a href="{{ route('register') }}"><small><strong>New on IRS? Create new account</strong></small></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
@endsection
