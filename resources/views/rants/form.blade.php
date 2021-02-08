
<form class="mt-4 publish-form"  id="rants-form" action="{{ isset($isEdit) ? route('rants.edit.store', ['post' => $post->slug ]) : route('rants.store') }}" method="POST">
    @csrf
    <div class="uk-form-group">
        <div class="uk-position-relative">
            <input type="text" name="title" class="uk-input uk-form-large text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Add a Title" value="{{ isset($isEdit) ? $post->title : '' }}" required>
        </div>
    </div>

        <div class="uk-form-group">
        <div class="uk-position-relative autosuggest">
            <select class=" uk-select uk-form-large" name="category" @if(isset($isEdit)) value="{{ $post->meta->category_id }}" @endif >
                <option value="" selected>Select a Category</option>
                @foreach(\App\RantCategory::ordered() as $c)
                <option value="{{ $c->id }}" @if(isset($isEdit) && ($post->meta->category_id == $c->id)) selected @endif>{{ $c->name }}</option>
               @endforeach
            </select>
        </div>
    <div class="uk-form-group mt-4">
        <div class="uk-position-relative editor-container">
        <div class="editor" id="editor_rants"></div>
        <textarea class="uk-textarea init-editor mt-4" placeholder="Details..."> @if(isset($isEdit)){{ html_entity_decode(strip_tags($post->details)) }} @endif</textarea>
        <input type="hidden" name="details" @if(isset($isEdit)) value="{{ $post->details }}" @endif />
        </div>
        </div>
        
        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input class="uk-checkbox" type="checkbox" name="is_anonymous" value="0"> Keep me anonymous</label>
            <label><input class="uk-checkbox" type="checkbox" checked="" name="is_public" value="1"> Everyone can see this</label>
        </div>
        <button type="submit" class="submit-form button block primary button-lg submit-form-btn">@if(isset($isEdit))Update @else Publish @endif</button>
    </form>

@section('form_script')
<script>
    $(document).ready(function () {
        prePopulateForm('#rants-form');

        $('#rant-form').submit(function(e) {
            submitForm(e, 'editor_rants', '#rant-form');
        });

    })
</script>
@endsection