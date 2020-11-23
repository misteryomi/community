@extends('layouts.app')

@section('content')
  <div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-1-3@m uk-width-1-2@s m-auto">
            <div class="px-2 uk-animation-scale-up">
                <div class="my-4 uk-text-center">
                    <h1 class="mb-2"> Reset Password</h1>
                    <p class="my-2">Enter your username or email address to continue</p>
                </div>


    
                  @include('layouts.partials.alert')

                  <form action="{{ route('post.forgot-password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="uk-form-group">
                            <div class="uk-position-relative">
                                <input class="uk-input bg-secondary" type="text" required name="username" placeholder="Username or email address">
                            </div>
                        </div>

                    <div class="text-center">
                      <button type="submit" class="button block primary my-4">Reset password</button>
                    </div>
                  </form>
                  <a href="{{ route('login') }}" class="text-center uk-display-block"> Go back to login</a>
                  <a href="{{ route('register') }}" class="text-center uk-display-block"> New here? Create a new account</a>

                </div>
            </div>       
        </div>
    </div>
@endsection

