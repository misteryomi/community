<script>
    var uploadURL = "{{ route('media.upload') }}"
</script>
@include('templates.scripts.tinymce')
@include('templates.scripts.select2')
<script>
$(document).ready(function() {
    // $('.select2').select2({
    //     ajax: {
    //       url: "{{ !isset($useChildCategories) ? route('community.api.search') : route('community.api.search').'?parent_id='.$community->id }}",
    //     }
    // });

    prePopulateForm('#topic-form');

    $('#topic-form').submit(function(e) {
        submitForm(e, 'editor_topics', '#topic-form');
    });

    prePopulateForm('#rants-form');

    $('#rant-form').submit(function(e) {
        submitForm(e, 'editor_rants', '#rant-form');
    });

    prePopulateForm('#question-form');

    $('#question-form').submit(function(e) {
        e.preventDefault()
        submitForm(e, 'editor_questions', '#question-form');
    });


});
</script>

<script>

var data = `{!! isset($post) ? $post->details : '' !!}`;


function submitForm(e, editorClass, submitFormEl) {
    e.preventDefault();

    let editor = editors[editorClass];
    let formEl = $(submitFormEl)[0]

    var text = editor.getData();


    $(submitFormEl).find("input[name=details]").val(text);


    if(!formEl.checkValidity()) {
        formEl.reportValidity();              
        
    } else {

        // console.log({rant: $(this).html()})
        // if(!text) {
        //     UIkit.notification("<span uk-icon='icon: check'></span> <strong>Sorry, Content cannot be empty</strong>", { status:'danger' });
        //     $(submitFormEl).find('.editor-container').addClass('error-border')

        // } else {
            
            $('.submit-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
            $('.submit-form-btn').attr('disabled', true);

           formEl.submit();
        // }
    }

    return false;

}

function prePopulateForm(editorClass) {
        var isEdit = "{{ isset($isEdit) ? true : false }}";
        var initialValue = $('.init-editor').val();
        var editor = editors[editorClass];

        $('.init-editor').hide();

        if(editor) {
            if(isEdit) {
                editor.setData(data)
            } else {
                editor.setData(data ? data : initialValue)
            }

        }

}
</script>

