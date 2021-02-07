@extends('layouts.app')

@section('content')
<div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-2-5@m uk-width-1-2@s m-auto">
            <div class="p-4 uk-animation-scale-up bg-white shadow-xl rounded-md">
                @include('layouts.partials.alert')
                @include('auth.login-form')
            </div>       
        </div>
    </div>
@endsection
