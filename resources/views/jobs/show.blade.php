@extends('layouts.posts.show')

@section('extra_info_before')

    @if($post->meta->type)
    <strong>Job Type</strong>: {{ $post->meta->type->type }} </p>
    @endif
    @if($post->meta->min_salary || $post->meta->min_salary)
    <p><strong>Salary</strong>: {{ $post->meta->min_salary }} {{ $post->meta->max_salary ? ' - '.$post->meta->max_salary : ''}} {{ $post->meta->salaryType->type }} </p>
    @endif
    @if($post->meta->deadline)
    <p><strong>Application Deadline</strong>: {{ $post->meta->deadline }} </p>
    @endif
    @if($post->meta->category)
    <p><strong>Category</strong>: {{ $post->meta->category->name }} </p>
    @endif

    <strong>Job Details:</strong>
@endsection

@section('extra_info_after')
    @if($post->meta->url)
    <p>Apply here: {{ $post->meta->url }} </p>
    @endif

@endsection
