@extends('layouts.posts.new')

@section('form_title')
    @if(isset($isEdit))
        <h1>Edit Question</h1>
    @else
        <h1>Ask a Question</h1>
    @endif
@endsection
@section('form_content')

@include('questions.form')
@endsection
