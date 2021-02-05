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

                        <form class="mt-4" id="publish-form" action="{{ isset($isEdit) ? route('community.edit', ['community' => $community->slug ]) : route('community.new') }}" method="POST" id="form">
                        @csrf
                        <div class="uk-form-group">
                          <div class="uk-position-relative">
                              <input type="text" name="title" class="uk-input uk-form-large text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Name of Community"  id="title" value="{{ isset($isEdit) ? $community->title : '' }}" required>
                          </div>
                        </div>

                          <div class="uk-form-group">
                            <div class="uk-position-relative autosuggest">
                                <select class="select2 uk-input uk-textarea uk-form-large" name="community_id" @if(isset($isEdit)) value="{{ $community->community_id }}" @endif id="community">
                                    <option value="">Select a Category</option>
                                    @if(isset($isEdit))
                                    <option value="{{ $community->community_id }}" selected>{{ $community->category->name }}</option>
                                    @elseif(isset($community))
                                    <option value="{{ $community->id }}" selected>{{ $community->name }}</option>
                                    @endif
                                    @foreach($communities as $community)
                                    <option value="">{{ $community->name }}</option>
                                    @endforeach
                                </select>
                          </div>
                          <div class="uk-form-group">
                              <label>What is this community about?</label>
                              <textarea class="uk-textarea" placeholder=""></textarea>
                          </div>
                          <div class="uk-form-group">
                              <label>Community Rules:</label>
                              <textarea class="uk-textarea" placeholder=""></textarea>
                          </div>
                          <div class="uk-form-group">
                              <label>Set Cover Picture:</label><br/>
                            <div uk-form-custom="target: true" class="uk-form-custom uk-first-column">
                                <input type="file">
                                <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled="">
                            </div>                          </div>
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
<script>
$(document).ready(function() {
    $('.select2').select2({
        ajax: {
          url: "{{ route('community.api.search') }}",
        }
    });
});
</script>

<script>
    var data = `{!! isset($community) ? $community->details : '' !!}`;
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

          let community = editor.getData();

          $("input[name=details]").val(community);


          if(!myForm[0].checkValidity()) {
            myForm[0].reportValidity();              
            
          } else {

            if(!community) {
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
