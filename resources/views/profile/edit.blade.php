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
                    <input type="file" name="avatar" id="profile-picture" class="form-control">
                  </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label class="form-control-label" for="first_name">First Name</label>
                <input type="text" name="first_name" value="{{ $user->details->first_name }}" class="form-control" id="firstname">
            </div>
            <div class="col-md-6">
                <label class="form-control-label" for="last_name">Last Name</label>
                <input type="text" name="last_name" value="{{ $user->details->last_name }}" class="form-control" id="lastname" >
            </div>
        </div>
        <div class="form-group">
            <label class="form-control-label" for="bio">Tell us about yourself</label>
            <textarea name="bio" class="form-control" id="bio" rows="6">{{ $user->details->bio }}</textarea>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label class="form-control-label" for="instagram">Instagram username</label>
                <input type="text" name="instagram" value="{{ $user->details->instagram }}" class="form-control" id="instagram">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="twitter">Twitter username</label>
                <input type="text" name="twitter" value="{{ $user->details->twitter }}" class="form-control" id="twitter">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="facebook">Facebook URL</label>
                <input type="text" name="facebook" value="{{ $user->details->facebook }}" class="form-control" id="facebook">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label class="form-control-label" for="email">Your Website</label>
                <input type="text" name="website" value="{{ $user->details->website }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-control-label" for="email">Your Location</label>
                <input type="text" name="location" value="{{ $user->details->location }}" class="form-control" >
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-default">Update Profile</button>
    </form>
    </div>
</div>
