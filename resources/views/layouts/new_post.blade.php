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
                    @yield('form_title')
                    @include('layouts.partials.alert')
                    @yield('form_content')
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
    var uploadURL = "{{ route('media.upload') }}"
</script>
@include('templates.scripts.tinymce')
@include('templates.scripts.select2')
<script>
$(document).ready(function() {
    $('.select2').select2({
        ajax: {
          url: "{{ route('community.api.search').'?parent_id='.$community->id }}",
        }
    });
});
</script>

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

          let rant = editor.getData();

          $("input[name=details]").val(rant);


          if(!myForm[0].checkValidity()) {
            myForm[0].reportValidity();              
            
          } else {

            if(!rant) {
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
