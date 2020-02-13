@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="  mb-4">
                <!-- Card header -->
                <!-- Card body -->
                <div class="">
                    @if(isset($isEdit))
                        <h1>Edit Topic</h1>
                    @else
                        <h1>Create a new Topic @if($community != null) in {{ $community->name }} @endif</h1>
                    @endif
                    @include('layouts.partials.alert')

                        <form class="mt-4" id="publish-form" action="{{ isset($isEdit) ? route('posts.post.edit', ['post' => $post->slug ]) : route('posts.post.new') }}" method="POST" id="form">
                        @csrf
                          <div class="form-group">
                            {{-- <label class="form-control-label" for="title"></label> --}}
                              <input type="text" name="title" class="form-control borderless text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Title"  id="title" value="{{ isset($isEdit) ? $post->title : '' }}" required>
                          </div>

                          @if(!isset($community) || $community == null)
                          <div class="form-group">
                            {{-- <label class="form-control-label" for="category">Community</label> --}}
                            <select class="form-control select2" name="community_id" id="category" required>
                            <option value="">Select Community</option>
                              @foreach($categories as $community)
                                <option {{ isset($isEdit) && $post->category->id == $community->id ? 'selected' : '' }} value="{{ $community->id }}">{{ $community->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          @else
                            <input type="hidden" name="community_id" value="{{ $community->id }}">
                        @endif
                          <div class="form-group">
                              <div class="editor"></div>
                          <input type="hidden" name="details" @if(isset($isEdit)) value="{{ $post->details }}" @endif>
                            {{-- <label class="form-control-label" for="details">Details</label>
                            <textarea class="form-control" name="details" id="textarea" rows="3">
                                {{ isset($isEdit) ? $post->details : '' }}
                            </textarea> --}}
                          </div>
                          <button type="submit" id="submit-form" class="btn btn-block btn-default">@if(isset($isEdit))Update @else Publish @endif Topic</button>
                        </form>
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

<script>
    $(document).ready(function() {
        var isEdit = "{{ isset($isEdit) ? true : false }}"

        if(isEdit) {
            editor.setData('{!! isset($post) ? $post->details : '' !!}')
        }

        $('#submit-form').click(function(e) {
          e.preventDefault();

          let post = editor.getData();

          $("input[name=details]").val(post);

          $('#publish-form').submit();

          return false;
        })
    })
</script>

@endsection
