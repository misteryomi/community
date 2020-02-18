@extends('layouts.app')

@section('content')
        <h1 class="mb-4 text-center">Login to continue</h1>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('layouts.partials.alert')
                <div class="card">
                    <div class="card-body py-5">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                @include('auth.login-form')
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <div class="text-center mb-3">
                                    <a href="login/google" class="btn btn-label btn-danger text-white mb-2">
                                        <i class="fa fa-google mr-3"></i> Login with Google
                                    </a>
                                    <hr/>
                                    <a href="{{ route('forgot-password') }}">Forgot your password? Reset Password</a><br/>
                                    <a href="{{ route('register') }}">New here? Create an account</a><br/>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
@endsection
