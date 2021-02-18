@extends('layouts.posts.show')

@section('extra_info_before')

    <h3>About the Job</h3>

@endsection

@section('extra_info_after')
@if($post->meta->type)
    <strong>Job Type</strong>: {{ $post->meta->type->type }} </p>
    @endif
    @if($post->meta->min_salary || $post->meta->min_salary)
    <p><strong>Salary</strong>: {{ $post->meta->min_salary ? 'NGN'.$post->meta->min_salary : '' }} {{ $post->meta->max_salary ? ' - NGN'.$post->meta->max_salary : ''}} {{ $post->meta->salaryType ? $post->meta->salaryType->type : '' }} </p>
    @endif
    @if($post->meta->deadline)
    <p><strong>Application Deadline</strong>: {{ $post->meta->deadline }} </p>
    @endif
    @if($post->meta->category)
    <p><strong>Category</strong>: {{ $post->meta->category->name }} </p>
    @endif

    @if($post->meta->url)
    <p>Apply here: <a href="{{ $post->meta->url }}" target="_blank">{{ $post->meta->url }}</a> </p>
    @endif

@endsection
