<div class="card">
    <div class="card-header">
    <h3 class="mb-0">Homepage Feed Settings</h3>
    </div>
    <div class="uk-width-2-3@m">
        <form class="uk-form-horizontal uk-margin-large" action="{{ route('profile.feed.settings.post') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="uk-margin">
                    <div class="uk-form-label">Homepage should display:</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio" name="feed_type" {{ auth()->user()->settings && auth()->user()->settings->feed_type == 'communities' ? 'checked' : '' }} value="communities"> Followed Communities
                            </label><br>
                        <label><input class="uk-radio" type="radio"  name="feed_type" {{ auth()->user()->settings && auth()->user()->settings->feed_type == 'featured' ? 'checked' : '' }}  value="featured"> Featured Topics
                            </label>
                    </div>
                </div>
            
                <button type="submit" class="button block primary">Update Feed Settings</button>
        </div>

    </form>
    </div>
</div>
