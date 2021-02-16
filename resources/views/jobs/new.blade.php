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
            <input type="text" name="title" class="uk-input uk-form-large text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Job Title"  id="title" value="{{ isset($isEdit) ? $post->title : '' }}" required>
        </div>
    </div>

        <div class="uk-form-group">
            <label>Job Category</label>
            <select class="uk-select" name="category">
                <option value="">Select option</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="uk-form-group">
            <label>Job type</label>
            <select class="uk-select" name="type">
                <option value="">Select option</option>
                @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="uk-form-group">
            <label>Salary type <small>(optional)</small></label>
            <select class="uk-select" name="salary_type">
                <option value="">Select option</option>
                @foreach($salaries as $salaryType)
                <option value="{{ $salaryType->id }}">{{ $salaryType->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="uk-form-group">
            <label>Minimum Salary (NGN) <small>(optional)</small></label>
            <input type="number" min="0" name="min_salary" class="uk-input" placeholder=""  id="min_salary" value="{{ isset($isEdit) ? $post->meta->min_salary : '' }}">
        </div>
        <div class="uk-form-group">
            <label>Maximum Salary (NGN) <small>(optional)</small></label>
            <input type="number" min="0" name="max_salary" class="uk-input" placeholder=""  id="max_salary" value="{{ isset($isEdit) ? $post->meta->max_salary : '' }}">
        </div>
        
        <div class="uk-form-group">
            <label>Location</label>
            <input type="text" name="location" class="uk-input" placeholder="Lagos"  id="location" value="{{ isset($isEdit) ? $post->meta->locaton : '' }}" required>
        </div>
        <div class="uk-form-group">
            <label>Application URL <small>(optional)</small></label>
            <input type="url" name="url" class="uk-input" placeholder="http://"  id="url" value="{{ isset($isEdit) ? $post->meta->url : '' }}">
        </div>
        <div class="uk-form-group">
            <label>Application Deadline <small>(optional)</small></label>
            <input type="date" name="deadline" class="uk-input" placeholder="01/01/2021"  id="deadline" value="{{ isset($isEdit) ? $post->meta->dealine : '' }}">
        </div>
        <div class="uk-form-group">
            <label>Job Details</label>
            <div class="uk-position-relative editor-container">
                <div id="editor"></div>
                <textarea class="uk-textarea init-editor mt-4" placeholder="Details..."> @if(isset($isEdit)){{ html_entity_decode(strip_tags($post->details)) }} @endif</textarea>
                <input type="hidden" name="details" @if(isset($isEdit)) value="{{ $post->details }}" @endif />
            </div>
        </div>
        <button type="submit" id="submit-form" class="button block primary button-lg submit-form-btn">@if(isset($isEdit))Update @else Publish @endif</button>
    </form>
@endsection
