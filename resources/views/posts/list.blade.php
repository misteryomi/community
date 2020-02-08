@extends('layouts.app')


@section('content')

<div class="row">
  <div class="col-xl-3 d-none d-md-block">
    @include('templates.categories_list')
  </div>
  <div class="col-xl-9 mb-xl-0">
      @include('templates.topics_list')
  </div>
</div>

@endsection
