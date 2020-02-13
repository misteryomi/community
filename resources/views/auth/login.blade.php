@extends('layouts.app')

@section('content')
        <h1 class="mb-4 text-center">Login to continue</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.partials.alert')
                        <div class="row">
                            <div class="col-md-6 border-right">
                                @include('auth.login-form')
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <div class="text-center mb-3">
                                    <a href="login/google" class="btn btn-label btn-danger text-white mb-2">
                                        <i class="fa fa-google"></i> Signup with Google
                                    </a>
                                    <a href="login/google" class="btn btn-label btn-default text-white mb-2">
                                        <i class="fa fa-google"></i> Signup with Facebook
                                    </a>
                                    <a href="login/google" class="btn btn-label btn-primary text-white mb-2">
                                        <i class="fa fa-google"></i> Signup with Twitter
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
@endsection
