@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
              <div class="card shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <h4>Reset Password</h4>
                    <small>Please enter your new password to continue</small>
                  </div>

                  @include('layouts.partials.alert')

                  <form action="{{ route('store-password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label><small>Password</small></label>
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input class="form-control" name="password" placeholder="Password" type="password">
                        <input name="email" value="{{ $token->email }}" type="hidden">
                      </div>
                    </div>
                    <div class="form-group">
                        <label><small>Confirm Password</small></label>
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input class="form-control" name="password_confirmation" placeholder="Confirm Password" type="password">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-block btn-primary my-4">Save new password</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
@endsection
