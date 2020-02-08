@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="card mb-4">
                <!-- Card header -->
                <div class="card-header">
                    @if(isset($isEdit))
                        <h3 class="mb-0">Edit Topic</h3>
                    @else
                        <h3 class="mb-0">Create a new Topic @if($community != null) in {{ $community->name }} @endif</h3>
                    @endif
                </div>
                <!-- Card body -->
                <div class="card-body">

                    @include('layouts.partials.alert')

                        <form action="{{ isset($isEdit) ? route('posts.post.edit', ['post' => $post->slug ]) : route('posts.post.new') }}" method="POST" id="form">
                        @csrf
                          <div class="form-group">
                            <label class="form-control-label" for="title">Title</label>
                              <input type="text" name="title" class="form-control" id="title" value="{{ isset($isEdit) ? $post->title : '' }}">
                          </div>

                          @if(!isset($community) || $community == null)
                          <div class="form-group">
                            <label class="form-control-label" for="category">Community</label>
                            <select class="form-control select2" name="community_id" id="category">
                              @foreach($categories as $community)
                                <option {{ isset($isEdit) && $post->category->id == $community->id ? 'selected' : '' }} value="{{ $community->id }}">{{ $community->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          @else
                            <input type="hidden" name="community_id" value="{{ $community->id }}">
                        @endif
                          <div class="form-group">
                            <label class="form-control-label" for="details">Details</label>
                            <textarea class="form-control" name="details" id="textarea" rows="3">
                                {{ isset($isEdit) ? $post->details : '' }}
                            </textarea>
                          </div>
                          <button type="submit" class="btn btn-default">Reply Post</button>
                        </form>
                      </div>
            </div>


        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">
                        Community Guidelines
                    </h3>
                </div>
                <div class="card-body">
                    Hello
                </div>
            </div>
        </div>
    </div>

@endsection
@section('styles')
<link href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('scripts')
@include('templates.scripts.tinymce')
@include('templates.scripts.select2')
@endsection
