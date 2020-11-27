@extends('layouts.app')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
     <div class="uk-width-5-5@m m-auto">
        <div class="mt-lg-4" uk-grid>
            <div class="uk-width-3-3@m">
                    @if(isset($isEdit))
                        <h1>Edit Topic</h1>
                    @else
                        <h1>Create a new Topic @if($community != null) in {{ $community->name }} @endif</h1>
                    @endif
                    @include('layouts.partials.alert')

                        <form class="mt-4" id="publish-form" action="{{ isset($isEdit) ? route('posts.post.edit', ['post' => $post->slug ]) : route('posts.post.new') }}" method="POST" id="form">
                        @csrf
                        <div class="uk-form-group">
                          <div class="uk-position-relative">
                              <input type="text" name="title" class="uk-input uk-form-large bg-secondary text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Title"  id="title" value="{{ isset($isEdit) ? $post->title : '' }}" required>
                          </div>
                        </div>

                          <div class="uk-form-group">
                            <div class="uk-position-relative autosuggest">
                                <select class="select2 uk-input uk-textarea uk-form-large" name="community_id" @if(isset($isEdit)) value="{{ $post->community_id }}" @endif id="community">
                                    @if(isset($isEdit))
                                    <option value="{{ $post->community_id }}" selected>{{ $post->category->name }}</option>
                                    @elseif(isset($community))
                                    <option value="{{ $community->id }}" selected>{{ $community->name }}</option>
                                    @endif
                                    @foreach($categories as $community)
                                    <option value="">{{ $community->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input class="uk-input uk-form-large" id="category" placeholder="Select Community" >
                                <input type="hidden" name="community_id">
                                    <div class="dropdown-list">
                                        <ul class="uk-list uk-list-divider p-3">
                                            @foreach($categories as $community)
                                            <li>
                                                <a href="#">Report </a>
                                            </li>
                                            @endforeach
                                        </ul>                                
                                    </div>                            
                                </div> -->
                          </div>
                        <div class="uk-form-group">
                          <div class="uk-position-relative editor-container">
                            <div class="editor"></div>
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
                      </div>
                    </div>
                </div>
              </div>
        </div>

    <div class="uk-width-expand uk-grid-margin uk-first-column">
            <div class="sidebar-filter uk-sticky" uk-sticky="offset:30 ; media : @s: bottom: true" style="">


            <div class="uk-card-default rounded mb-4">
                        <p>Sidebar</p>

            </div>

        </div>
        <div class="uk-sticky-placeholder" style="height: 540px; margin: 0px;" hidden=""></div>
    </div>

</div>



@endsection

@section('scripts')
<script>
    var uploadURL = "{{ route('posts.media.upload') }}"
</script>
@include('templates.scripts.tinymce')
@include('templates.scripts.select2')

<script>
    var data = `{!! isset($post) ? $post->details : '' !!}`;
    $(document).ready(function() {

        var isEdit = "{{ isset($isEdit) ? true : false }}";
        var myForm = $("#publish-form");
        var initialValue = $('.init-editor').val();

        $('.init-editor').hide();

        if(isEdit) {
            editor.setData(data)
        } else {
            editor.setData(data ? data : initialValue)
        }

        $('#submit-form').click(function(e) {
          e.preventDefault();

          let post = editor.getData();

          $("input[name=details]").val(post);


          if(!myForm[0].checkValidity()) {
            myForm[0].reportValidity();              
            
          } else {

            if(!post) {
                UIkit.notification("<span uk-icon='icon: check'></span> <strong>Sorry, Content cannot be empty</strong>", { status:'danger' });
                $('.editor-container').addClass('error-border')

            } else {
                
                $('.submit-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                $('.submit-form-btn').attr('disabled', true);

                myForm.submit();
            }
          }

          return false;
        })

        $('.autosuggest input').focus(function() {
            $('.autosuggest .dropdown-list').show();
        })

        $('.autosuggest input').blur(function() {
            $('.autosuggest .dropdown-list').hide();
        })


    })
</script>

@endsection
