@extends('layouts.app')

@section('content')
        <h1 class="mb-4 text-center">Create an account</h1>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('layouts.partials.alert')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 border-right">
                            <form action="{{route( 'post.register' )}} " method="post">
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
                                <button type="submit" class="btn btn-block btn-default">Create account</button>
                            </form>
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <div class="text-center mb-3">
                                    <a href="login/google" class="btn btn-label btn-danger text-white mb-2">
                                        <i class="fa fa-google"></i> Signup with Google
                                    </a>
                                    <hr/>
                                    <a href="{{ route('forgot-password') }}">Forgot your password? Reset Password</a><br/>
                                    <a href="{{ route('login') }}">Already own an account? Login now</a><br/>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
@endsection
