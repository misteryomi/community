<form class="mt-4 publish-form"  id="question-form" action="{{ isset($isEdit) ? route('questions.edit.store', ['post' => $post->slug ]) : route('questions.new.store') }}" method="POST">
    @csrf
    <div class="uk-form-group">
        <div class="uk-position-relative">
            <input type="text" name="title" class="uk-input uk-form-large text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Add a Title" value="{{ isset($isEdit) ? $post->title : '' }}" required>
        </div>
    </div>

    <div class="uk-form-group">
    <div class="uk-position-relative autosuggest">
        <select class="uk-select uk-form-large" name="category" @if(isset($isEdit)) value="{{ $post->category_id }}" @endif >
            <option value="" selected>Select a Category</option>
                @foreach(\App\QuestionCategory::ordered() as $c)
                <option value="{{ $c->id }}" @if(isset($isEdit) && ($post->meta->category_id == $c->id)) selected @endif>{{ $c->name }}</option>
                @endforeach

        </select>
    </div>
    <div class="uk-form-group mt-4">
        <div class="uk-position-relative editor-container">
        <div class="editor" id="editor_questions"></div>
        <textarea class="uk-textarea init-editor mt-4" placeholder="Details...">@if(isset($isEdit)){{ html_entity_decode(strip_tags($post->details)) }} @endif</textarea>
        <input type="hidden" name="details" @if(isset($isEdit)) value="{{ $post->details }}" @endif />
        </div>
        </div>
        <button type="submit" class="submit-form button block primary button-lg submit-form-btn">@if(isset($isEdit))Update @else Publish @endif</button>
    </form>

@section('form_script')
<script>
    $(document).ready(function () {
        prePopulateForm('#question-form');

        $('#question-form').submit(function(e) {
            e.preventDefault()
            console.log({e})
            // submitForm(e, 'editor_questions', '#question-form');
        });

    })
</script>
@endsection