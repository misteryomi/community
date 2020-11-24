@extends('layouts.app')

@section('content')
<div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-1-3@m uk-width-1-2@s m-auto">
            <div class="px-2 uk-animation-scale-up">
                <div class="my-4 uk-text-center">
                    <h1 class="mb-2"> Create an Account  </h1>
                    <p class="my-2">Already registered?
                    <a href="{{ route('login') }}" class="uk-link text-primary">Log in</a> </p>
                </div>


                    @include('layouts.partials.alert')
                            <form action="{{route( 'post.register' )}}{{ request()->has('utm_redirect') ? '?utm_redirect='.request()->utm_redirect : '' }}" method="post">
                            @csrf
                            <div class="uk-form-group">
                                <div class="uk-position-relative">
                                    <label class="form-control-label" for="username">Desired Username</label>
                                    <input class="uk-input bg-secondary" type="text" required name="username" placeholder="Enter Username">
                                </div>
                            </div>
                            <div class="uk-form-group">
                                <div class="uk-position-relative">
                                    <label class="form-control-label" for="email">Email address</label>
                                    <input class="uk-input bg-secondary" type="email" required name="email" placeholder="Enter Email Address">
                                </div>
                            </div>
                            <div class="uk-form-group">
                                <div class="uk-position-relative">
                                    <label class="form-control-label" for="password">Password</label>
                                    <input class="uk-input bg-secondary" type="password" required name="password" placeholder="*******">
                                </div>
                            </div>
                            <button type="submit" class="button primary block">Create account</button>
                            </form>

                            <hr/>
                            <div class="text-center mb-3">
                                <a href="login/google" class="button danger block text-white mb-2">
                                    <i class="fa fa-google mr-3"></i> Continue with Google
                                </a>
                            </div>

                </div>
            </div>       
        </div>
    </div>
@endsection
