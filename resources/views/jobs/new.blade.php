@php $useChildCategories = true @endphp

@extends('layouts.posts.new')

@section('form_title')
    @if(isset($isEdit))
        <h1>Edit Job</h1>
    @else
        <h1>Post a Job</h1>
    @endif
@endsection
@section('form_content')

    <div class="uk-alert-primary uk-alert" uk-alert="">
        <a class="uk-alert-close uk-icon uk-close" uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></a>
        <p>Please note: Job postings would be reviewed for approval before posting them live.
        </p>
    </div>

    <form class="mt-4" id="publish-form" action="{{ isset($isEdit) ? route('jobs.edit.store', ['post' => $post->slug ]) : route('jobs.new.store') }}" method="POST" id="form">
    @csrf
    <div class="uk-form-group">
        <div class="uk-position-relative">
            <input type="text" name="title" class="uk-input uk-form-large bg-secondary text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Job Title"  id="title" value="{{ isset($isEdit) ? $post->title : '' }}" required>
        </div>
    </div>

        <div class="uk-form-group">
        <div class="uk-position-relative autosuggest">
            <select class="select2 uk-input uk-textarea uk-form-large" name="community_id" @if(isset($isEdit)) value="{{ $post->community_id }}" @endif id="community">
                <option value="" selected>Select a Category</option>
                @if(isset($isEdit))
                <option value="{{ $post->community_id }}" selected>{{ $post->community->name }}</option>
                @elseif(isset($community) && ($community->name != 'Jobs'))
                <option value="{{ $community->id }}" selected>{{ $community->name }}</option>
                @endif
                @foreach($communities as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="uk-form-group">
            <label>Job Description</label>
            <div class="uk-position-relative editor-container">
                <div class="editor"></div>
                <textarea class="uk-textarea init-editor mt-4" placeholder="Details..."> @if(isset($isEdit)){{ html_entity_decode(strip_tags($post->details)) }} @endif</textarea>
                <input type="hidden" name="details" @if(isset($isEdit)) value="{{ $post->details }}" @endif />
            </div>
        </div>
        <div class="uk-form-group">
            <label>Application Link</label>
            <input type="url" name="link" class="uk-input" placeholder="Link"  id="link" value="{{ isset($isEdit) ? $post->meta->link : '' }}" required>
        </div>
        <div class="uk-form-group">
            <label>Deadline</label>
            <input type="date" name="deadline" class="uk-input" placeholder="Deadline"  id="link" value="{{ isset($isEdit) ? $post->meta->dealine : '' }}" required>
        </div>
        <button type="submit" id="submit-form" class="button block primary button-lg submit-form-btn">@if(isset($isEdit))Update @else Publish @endif</button>
    </form>
@endsection
