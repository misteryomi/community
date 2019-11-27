@extends('layouts.app')

@section('content')

        <h1 class="mb-1"> {{ $post->title }}</h1>
        <button type="button" class="d-flex btn mb-2 btn-default btn-sm btn-icon">
            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
            <span class="btn-inner--text">Reply Topic</span>
        </button>
        <div class="card">
        <div class="list-group list-group-flush">
                <div class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                    <div class="d-flex w-100 justify-content-between">
                    <div>
                    <div class="d-flex w-50 align-items-center">
                    <img src="{{ $post->user->avatar }}" alt="{{ ucfirst($post->user->username) }}" class="avatar avatar-xs mr-2">
                    <h5 class="mb-1">{{ ucfirst($post->user->username) }}</h5>
                    </div>
                </div>
                <small>{{ $post->date }}</small>
                </div>
                <p class="text-sm my-4">{{ $post->content }}</p>

                    <div class="row align-items-center my-3">
                        <div class="col-sm-6">
                        <div class="icon-actions">
                            <a href="#" class="like active">
                            <i class="ni ni-like-2"></i>
                            <span class="text-muted">150</span>
                            </a>
                            <a href="#">
                            <i class="ni ni-chat-round"></i>
                            <span class="text-muted">36</span>
                            </a>
                            <a href="#">
                            <i class="ni ni-curved-next"></i>
                            <span class="text-muted">12</span>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>


      </div>
      @include('templates.comments')
      @include('templates.comment')
@endsection

@section('scripts')
<script src="{{ asset('assets/js/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>tinymce.init({
  selector:'#reply-topic',
  plugins: 'autoresize bbcode autolink code image anchor emoticons code media',
  toolbar: 'formatselect | bold italic underline strikethrough  | media alignleft aligncenter alignright alignjustify |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | emoticons | code',
  menubar: false,
  branding: false,
  height: 500
  });
</script>
@endsection
