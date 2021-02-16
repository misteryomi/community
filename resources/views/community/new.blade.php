@extends('layouts.app')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid>
<div class="uk-width-5-6@m m-auto">
     <!-- <div class="uk-width-3-4@m m-auto"> -->
        <div class="mt-lg-4" uk-grid>
            <div class="uk-width-3-3@m">
                    @if(isset($isEdit))
                        <h1>Edit Community</h1>
                    @else
                        <h1>Create a new Community</h1>
                    @endif
                    @include('layouts.partials.alert')

                        <form class="mt-4" id="publish-form" action="{{ isset($isEdit) ? route('community.edit', ['community' => $community->slug ]) : route('community.post.new') }}" method="POST" id="form">
                        @csrf
                        <div class="uk-form-group">
                          <div class="uk-position-relative">
                              <input type="text" name="name" required class="uk-input uk-form-large text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Name of Community"  id="title" value="{{ isset($isEdit) ? $community->title : '' }}" required>
                          </div>
                        </div>

                          <div class="uk-form-group">
                            <div class="uk-position-relative autosuggest">
                                <select class="select2 uk-input uk-textarea uk-form-large" required name="category" @if(isset($isEdit)) value="{{ $community->community_id }}" @endif id="category">
                                    <option value="">Select a Category</option>
                                    @if(isset($isEdit))
                                        <option value="{{ $community->category_id }}" selected>{{ $community->category->name }}</option>
                                    @endif
                                    @foreach($categories as $category)
                                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                          </div>
                          <div class="uk-form-group mt-2">
                              <label>About this Community (optional):</label>
                              <textarea class="uk-textarea" rows="7" name="about" placeholder=""></textarea>
                          </div>
                          <div class="uk-form-group">
                              <label>Community Rules (optional):</label>
                              <textarea class="uk-textarea"  rows="7"  name="rules" placeholder=""></textarea>
                          </div>
                          <div class="uk-form-group">
                              <label>Logo (optional):</label><br/>
                            <div uk-form-custom="target: true" class="uk-form-custom uk-first-column">
                                <input type="file" name="logo">
                                <!-- <button class="uk-button uk-button-default" type="button" tabindex="-1">Select File</button>                                 -->
                                <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled="">
                            </div>                          
                        </div>
                          <button type="submit" id="submit-form" class="button block primary button-lg submit-form-btn">@if(isset($isEdit))Update @else Create @endif Community</button>
                        </form>
                      </div>
                    </div>
                <!-- </div> -->
              </div>
        </div>
    
        @include('templates.sidebar')
</div>



@endsection

@section('scripts')
<script>
    var uploadURL = "{{ route('media.upload') }}"
</script>
@include('templates.scripts.tinymce')
@include('templates.scripts.select2')


@endsection
