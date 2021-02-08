<form class="mt-4 publish-form" action="{{ isset($isEdit) ? route('questions.edit.store', ['post' => $post->slug ]) : route('questions.new.store') }}" method="POST" id="form">
    @csrf
    <div class="uk-form-group">
        <div class="uk-position-relative">
            <input type="text" name="title" class="uk-input uk-form-large bg-secondary text-lg text-weight-bold text-dark" style="font-size: 24px;" autofocus="autofocus" placeholder="Add a Title"  id="title" value="{{ isset($isEdit) ? $post->title : '' }}" required>
        </div>
    </div>

        <div class="uk-form-group">
        <div class="uk-position-relative autosuggest">
            <select class=" uk-input uk-textarea uk-form-large" name="community_id" @if(isset($isEdit)) value="{{ $post->community_id }}" @endif id="community">
                <option value="" selected>Select a Category</option>
                @if(isset($isEdit))
                <option value="{{ $post->community_id }}" selected>{{ $post->community->name }}</option>
                @elseif(isset($community) && ($community->name != 'Questions'))
                <option value="{{ $community->id }}" selected>{{ $community->name }}</option>
                @endif
                @foreach(auth()->user()->followedCommunities()->ordered() as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
    <div class="uk-form-group mt-4">
        <div class="uk-position-relative editor-container">
        <div class="editor"></div>
        <textarea class="uk-textarea init-editor mt-4" placeholder="Details..."> @if(isset($isEdit)){{ html_entity_decode(strip_tags($post->details)) }} @endif</textarea>
        <input type="hidden" name="details" @if(isset($isEdit)) value="{{ $post->details }}" @endif />
        </div>
        </div>
        <button type="submit" id="submit-form" class="button block primary button-lg submit-form-btn">@if(isset($isEdit))Update @else Publish @endif</button>
    </form>