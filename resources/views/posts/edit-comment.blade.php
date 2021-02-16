@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="  mb-4">
                <!-- Card header -->
                <!-- Card body -->
                <div class="">
                        <h1>Edit Comment</h1>
                    @include('layouts.partials.alert')

                        <form class="mt-5" id="publish-form" action="{{ route('posts.comment.edit.post', ['comment' => $comment->id, 'post' => $comment->post->slug ]) }}" method="POST" id="form">
                        @csrf
                          <div class="form-group">
                              <div id="editor"></div>
                              <input type="hidden" name="comment" value="{{ $comment->comment }}">
                          </div>
                          <button type="submit" id="submit-form" class="button block mt-2 primary">Update Comment</button>
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
<script>
    var uploadURL = "{{ route('media.upload') }}"
</script>
@include('templates.scripts.tinymce')
@include('templates.scripts.select2')

<script>
    $(document).ready(function() {

    
        var editor = editors.editor;

        editor.setData('{!! $comment->comment !!}')

        $('#submit-form').click(function(e) {
          e.preventDefault();

          let post = editor.getData();

          $("input[name=comment]").val(post);

          $('#publish-form').submit();

          return false;
        })
    })
</script>

@endsection
