@extends('layouts.posts.new')

@section('form_title')
    @if(isset($isEdit))
        <h1>Edit Rant</h1>
    @else
        <h1>Rant - Express yourself, freely!</h1>
    @endif
@endsection
@section('form_content')
@include('rants.form');
@endsection
