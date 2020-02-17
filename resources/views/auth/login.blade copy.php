@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
              <div class="card shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <h4>Welcome to Primera Internal Resource Stream (IRS)</h4>
                    <small>Please login to continue</small>
                  </div>

                  @include('layouts.partials.alert')

                  <form action="{{ route('post.login') }}" method="POST">
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
                    <div class="form-group">
                    <label><small>Password</small></label>
                      <div class="input-group input-group-alternative" id="password-container">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input class="form-control" name="password" id="password" placeholder="Password" type="password">
                        <span class="toggle-password"><i class="fa fa-eye-slash"></i></span>
                    </div>
                    </div>
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" name="remember-me" id=" customCheckLogin" type="checkbox">
                      <label class="custom-control-label" for=" customCheckLogin">
                        <span class="text-muted">Remember me</span>
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-block btn-primary my-4">Sign in</button>
                    </div>
                  </form>
                  <hr/>
                  <div class="text-center mt-4">
                    <a href="{{ route('forgot-password') }}"><small><strong>Forgot password? Retrieve your password</strong></small></a><br/>
                    <a href="{{ route('register') }}"><small><strong>New on IRS? Create new account</strong></small></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
@endsection
