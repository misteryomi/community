@extends('layouts.posts.new')

@section('form_title')
    @if(isset($isEdit))
        <h1>Edit Topic</h1>
    @else
        <h1>Create a new Topic @if($community != null) in {{ $community->name }} @endif</h1>
    @endif
@endsection

@section('form_content')
@include('posts.form')
@endsection
