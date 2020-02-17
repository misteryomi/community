@extends('layouts.app')


@section('content')
<div class="pt-2 pb-4 mb-3 text-center text-md-left" role="alert">
    <h1>Welcome to {{ env('APP_NAME') }} {{ auth()->user() ? ', '.auth()->user()->username : '' }}!</h1>
    <small>411.ng is a place to discuss anything Nigerian. Remember to be nice, free and have fun!</small>
</div>
<div class="row">
  <div class="col-md-3 d-none d-lg-block">
    @include('templates.categories_list')
  </div>
  <div class="col-md-9 mb-xl-0">
      @include('templates.topics_list')
  </div>
</div>

@endsection
