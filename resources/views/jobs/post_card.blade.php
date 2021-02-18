@extends('layouts.posts.post_card')
@section('additional_info')
          @if($post->meta)
          <div class="mb-2">
            @if($post->meta->category)
            <a href="?&category={{ $post->meta->category->name }}" class="button small soft-warning"> {{ $post->meta->category->name }} </a>
            @endif
            @if($post->meta->location)
            <a href="?&location={{ $post->meta->location }}" class="button small soft-danger">  {{ ucwords($post->meta->location) }}  </a>
            @endif
            @if($post->meta->type)
            <a href="?&job_type={{ $post->meta->type->type }}" class="button small soft-success">  {{ ucwords($post->meta->type->type) }}  </a>
            @endif
            @if($post->meta->company_name)
            <a href="?&company_name={{ $post->meta->company_name }}" class="button small soft-secondary"> {{ ucwords($post->meta->company_name) }} </a>
            @endif
            </div>
          @endif
@endsection
