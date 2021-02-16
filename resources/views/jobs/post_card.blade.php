@extends('layouts.posts.post_card')
@section('additional_info')
          @if($post->meta)
            @if($post->meta->category)
            <a href="?&category={{ $post->meta->category->name }}" class="button"> {{ $post->meta->category->name }} </a>
            @endif
            @if($post->meta->location)
            <a href="?&location={{ $post->meta->location }}" class="button">  {{ ucwords($post->meta->location) }}  </a>
            @endif
            @if($post->meta->type)
            <a href="?&job_type={{ $post->meta->type->type }}" class="button">  {{ ucwords($post->meta->type->type) }}  </a>
            @endif
          @endif
@endsection
