@extends('layouts.app')

@section('content')
<div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-1-3@m uk-width-1-2@s m-auto">
            <div class="px-2 uk-animation-scale-up">
                @include('layouts.partials.alert')
                @include('auth.login-form')
            </div>       
        </div>
    </div>
@endsection
