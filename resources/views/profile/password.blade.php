<div class="card">
    <div class="card-header">
    <h3 class="mb-0">Update Password</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('store-password') }}" method="POST">
        @csrf

        <div class="form-group row">

            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label class="form-control-label" for="old_password">Old Password</label>
                    <input type="password" name="old_password" class="form-control" id="old_password">                
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="password">New Password</label>
                    <input type="password" name="password" class="form-control" id="password">                
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="c_password">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="c_password">                
                </div>

                <button type="submit" class="btn btn-block btn-default">Update Profile</button>
            </div>
        </div>
    </form>
    </div>
</div>
