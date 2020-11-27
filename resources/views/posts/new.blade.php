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

                          @if(!isset($community) || $community == null)
                          <div class="uk-form-group">
                            <div class="uk-position-relative autosuggest">
                                <select class="select2 uk-input uk-textarea uk-form-large" name="community_id" @if($isEdit) value="{{ $post->community_id }}" @endif id="community">
                                    @if($isEdit)
                                    <option value="{{ $post->community_id }}">{{ $post->category->name }}</option>
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
                          @else
                            <input type="hidden" name="community_id" value="{{ $community->id }}">
                        @endif
                        <div class="uk-form-group">
                          <div class="uk-position-relative editor-container">
                            <div class="editor"></div>
                          <textarea class="uk-textarea init-editor mt-4" placeholder="Details..."> @if(isset($isEdit)){{ html_entity_decode(strip_tags($post->details)) }} @endif</textarea>
                          <input type="hidden" name="details" @if(isset($isEdit)) value="{{ $post->details }}" @endif />
                            {{-- <label class="form-control-label" for="details">Details</label>
                            <textarea class="form-control" name="details" id="textarea" rows="3">
                                {{ isset($isEdit) ? $post->details : '' }}
                            </textarea> --}}
                            </div>
                          </div>
                          <button type="submit" id="submit-form" class="button block primary button-lg submit-form-btn">@if(isset($isEdit))Update @else Publish @endif Topic</button>
                        </form>
                      </div>
                    </div>
                </div>
              </div>

    <div class="uk-width-expand uk-grid-margin uk-first-column">
    <div class="sidebar-filter uk-sticky" uk-sticky="offset:30 ; media : @s: bottom: true" style="">


    <div class="uk-card-default rounded mb-4">

        <ul class="uk-child-width-expand uk-tab" uk-switcher="animation: uk-animation-fade">
            <li class="uk-active"><a href="#" aria-expanded="true">Newest</a></li>
            <li><a href="#" aria-expanded="false">Popular</a></li>
        </ul>

        <ul class="uk-switcher" style="touch-action: pan-y pinch-zoom;">
            <!-- tab 1 -->
            <li class="uk-active">
                <div class="py-3 px-4">

                    <div class="uk-grid-small uk-grid" uk-grid="">
                        <div class="uk-width-expand uk-first-column">
                            <p> Overview of SQL Commands and PDO </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img1.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>
                    <div class="uk-grid-small uk-grid" uk-grid="">
                        <div class="uk-width-expand uk-first-column">
                            <p> Writing a Simple MVC App in Plain </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img2.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>
                    <div class="uk-grid-small uk-grid" uk-grid="">
                        <div class="uk-width-expand uk-first-column">
                            <p> How to Create and Use Bash Scripts </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img3.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>

                </div>
            </li>

            <!-- tab 2 -->
            <li>
                <div class="py-3 px-4">

                    <div class="uk-grid-small uk-grid uk-grid-stack" uk-grid="">
                        <div class="uk-width-expand">
                            <p> Overview of SQL Commands and PDO </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img1.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>
                    <div class="uk-grid-small uk-grid uk-grid-stack" uk-grid="">
                        <div class="uk-width-expand">
                            <p> Writing a Simple MVC App in Plain </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img2.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>
                    <div class="uk-grid-small uk-grid uk-grid-stack" uk-grid="">
                        <div class="uk-width-expand">
                            <p> How to Create and Use Bash Scripts </p>
                        </div>
                        <div class="uk-width-1-3">
                            <img src="assets/images/category/img3.jpg" alt="" class="rounded-sm">
                        </div>
                    </div>

                </div>
            </li>
        </ul>

        </div>

        <div class="uk-card-default rounded uk-overflow-hidden">
        <div class="p-4 text-center">

            <h4 class="uk-text-bold"> Subsicribe </h4>
            <p> Get the Latest Posts and Article for us On Your Email</p>

            <form class="mt-3">
                <input type="text" class="uk-input uk-form-small" placeholder="Enter your email address">
                <input type="submit" value="Subscirbe" class="button button-default block mt-3">
            </form>

        </div>
        </div>

        </div><div class="uk-sticky-placeholder" style="height: 540px; margin: 0px;" hidden=""></div>



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
