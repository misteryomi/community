@extends('profile.settings_template')


@section('settings_page')

<div class="uk-card-default rounded">
            <div class="p-3">
                <h5 class="mb-0"> Homepage Feed Settings </h5>
            </div>
            <hr class="m-0">
            <form  action="{{ route('profile.feed.settings.post') }}" method="POST" class="uk-child-width-1-2@s uk-grid-small p-4" uk-grid>
              @csrf
                  <div style="width: 100%">
                    <div class="uk-form-label">What contents should your homepage feed display?</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio"  name="feed_type" {{ auth()->user()->settings && auth()->user()->settings->feed_type == 'communities' ? 'checked' : '' }} value="communities"> Community Topics</label><br>
                        <label><input class="uk-radio" type="radio" name="feed_type" {{ auth()->user()->settings && auth()->user()->settings->feed_type == 'featured' ? 'checked' : '' }}  value="featured"> Featured Topics</label>
                    </div>
                </div>

                  <div style="width: 100%">
                      <button type="submit" class="button block primary">Update Feed Settings</button>
                  </div>
            </form>

        </div>

@endsection