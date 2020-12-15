@extends('layouts.app')


@section('content')


<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
    @include('questions.list_template')
  </div>
  <div class="uk-width-expand uk-grid-margin uk-first-column">
    <div class="sidebar-filter uk-sticky" uk-sticky="offset:30 ; media : @s: bottom: true" style="">


        <h4> Trending Questions </h4>
        <div class="uk-card-default rounded mb-4">


        </div>

    </div>

</div>

@endsection
