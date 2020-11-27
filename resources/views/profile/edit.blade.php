<div class="card">
    <div class="card-header">
    <h3 class="mb-0">Update Profile</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('profile.settings.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <div class="col-md-4 offset-md-4">
                <div class="text-center">
                    <img src="{{ $user->avatar }}" class="avatar img-circle" alt="avatar">
                    <h6>Profile Picture</h6>
                    <div class="uk-margin" uk-margin="">
                        <div uk-form-custom="target: true" class="uk-form-custom uk-first-column">
                            <input type="file" name="avatar" id="profile-picture" >
                            <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled="">
                        </div>
                        <button class="uk-button uk-button-default">Upload</button>
                    </div>
                    
                  </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label class="uk-input-label" for="first_name">First Name</label>
                <input type="text" name="first_name" value="{{ $user->details->first_name }}" class="uk-input" id="firstname">
            </div>
            <div class="col-md-6">
                <label class="uk-input-label" for="last_name">Last Name</label>
                <input type="text" name="last_name" value="{{ $user->details->last_name }}" class="uk-input" id="lastname" >
            </div>
        </div>
        <div class="form-group">
            <label class="uk-input-label" for="bio">Tell us about yourself</label>
            <textarea name="bio" class="uk-input" id="bio" rows="6">{{ $user->details->bio }}</textarea>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label class="uk-input-label" for="instagram">Instagram username</label>
                <input type="text" name="instagram" value="{{ $user->details->instagram }}" class="uk-input" id="instagram">
            </div>
            <div class="col-md-4">
                <label class="uk-input-label" for="twitter">Twitter username</label>
                <input type="text" name="twitter" value="{{ $user->details->twitter }}" class="uk-input" id="twitter">
            </div>
            <div class="col-md-4">
                <label class="uk-input-label" for="facebook">Facebook URL</label>
                <input type="text" name="facebook" value="{{ $user->details->facebook }}" class="uk-input" id="facebook">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label class="uk-input-label" for="email">Your Website</label>
                <input type="text" name="website" value="{{ $user->details->website }}" class="uk-input">
            </div>
            <div class="col-md-6">
                <label class="uk-input-label" for="email">Your Location</label>
                <input type="text" name="location" value="{{ $user->details->location }}" class="uk-input" >
            </div>
        </div>
        <button type="submit" class="button block primary mt-3">Update Profile</button>
    </form>
    </div>
</div>
