@extends('layouts.posts.new')

@section('form_title')
    @if(isset($isEdit))
        <h1>Edit Topic</h1>
    @else
        <h1>Create a new Topic @if($community != null) in {{ $community->name }} @endif</h1>
    @endif
@endsection
@section('form_content')
    <form class="mt-4" id="publish-form" action="{{ isset($isEdit) ? route('posts.post.edit', ['post' => $post->slug ]) : route('posts.post.new') }}" method="POST">
        @csrf
        <div class="uk-form-group">
            <div class="uk-position-relative">
                <input type="text" name="title" class="uk-input uk-form-large text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Title"  id="title" value="{{ isset($isEdit) ? $post->title : '' }}" required>
            </div>
        </div>

            <div class="uk-form-group">
            <div class="uk-position-relative autosuggest">
                <select class="select2 uk-input uk-textarea uk-form-large" name="community_id" @if(isset($isEdit)) value="{{ $post->community_id }}" @endif id="community">
                    <option value="">Select a Community</option>
                    @if(isset($isEdit))
                    <option value="{{ $post->community_id }}" selected>{{ $post->community->name }}</option>
                    @elseif(isset($community))
                    <option value="{{ $community->id }}" selected>{{ $community->name }}</option>
                    @endif
                    @foreach($communities as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>

            </div>
        <div class="uk-form-group mt-2">
            <div class="uk-position-relative editor-container">
            <div id="editor"></div>
            <textarea class="uk-textarea init-editor mt-4" placeholder="Details..."> @if(isset($isEdit)){{ html_entity_decode(strip_tags($post->details)) }} @endif</textarea>
            <input type="hidden" name="details" @if(isset($isEdit)) value="{{ $post->details }}" @endif />
            {{-- <label class="form-control-label" for="details">Details</label>
            <textarea class="form-control" name="details" id="textarea" rows="3">
                {{ isset($isEdit ?? '') ? $post->details : '' }}
            </textarea> --}}
            </div>
            </div>
            <button type="submit" id="submit-form" class="button block primary button-lg submit-form-btn">@if(isset($isEdit))Update @else Publish @endif Topic</button>
        </form>
@endsection
