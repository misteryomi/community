@extends('layouts.posts.new')

@section('form_title')
    @if(isset($isEdit))
        <h1>Edit</h1>
    @else
        <h1>Post new stuff! @if($community != null) in {{ $community->name }} @endif</h1>
    @endif
@endsection

@section('form_content')
    @include('posts.share_tabs')
@endsection
