<script>
    var uploadURL = "{{ route('media.upload') }}"
</script>
@include('templates.scripts.tinymce')
@include('templates.scripts.select2')
<script>
$(document).ready(function() {
    $('.select2').select2({
        ajax: {
          url: "{{ !isset($useChildCategories) ? route('community.api.search') : route('community.api.search').'?parent_id='.$community->id }}",
        }
    });
});
</script>

<script>
    var data = `{!! isset($post) ? $post->details : '' !!}`;
    
    $(document).ready(function() {

        var isEdit = "{{ isset($isEdit) ? true : false }}";
        var myForm = $(".publish-form");
        var initialValue = $('.init-editor').val();

        $('.init-editor').hide();

        if(isEdit) {
            editor.setData(data)
        } else {
            editor.setData(data ? data : initialValue)
            console.log({editor});
        }

        $('.submit-form').click(function(e) {
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
