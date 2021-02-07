@extends('layouts.app')

@section('content')
  <div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-1-3@m uk-width-1-2@s m-auto">
            <div class="p-4 uk-animation-scale-up bg-white shadow-xl rounded-md">
                <div class="my-4 uk-text-center">
                    <h1 class="mb-2"> Reset Password an Account  </h1>
                    <p class="my-2">Enter your new password to continue</p>
                </div>


    
                  @include('layouts.partials.alert')

                  <form action="{{ route('store-password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="uk-form-group">
                            <div class="uk-position-relative">
                                <label class="form-control-label" for="username">Password</label>
                                <input class="uk-input bg-secondary" type="password" required name="password" placeholder="Enter Password">
                            </div>
                        </div>

                        <div class="uk-form-group">
                            <div class="uk-position-relative">
                                <label class="form-control-label" for="username">Password</label>
                                <input class="uk-input bg-secondary" type="password" required name="password_confirmation" placeholder="Confirm Password">
                                <input name="email" value="{{ $token->email }}" type="hidden">
                            </div>
                        </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-block btn-primary my-4">Update password</button>
                    </div>
                  </form>

                </div>
            </div>       
        </div>
    </div>
@endsection
