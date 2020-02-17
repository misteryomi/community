<div class="card">
    <div class="card-header">
    <h3 class="mb-0">Homepage Feed Settings</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('profile.feed.settings.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">

            <div class="col-md-6 offset-md-3">
                <p>Homepage should display:</p>
                <div class="form-group">
                    <input type="radio" name="feed_type" {{ auth()->user()->settings && auth()->user()->settings->feed_type == 'communities' ? 'checked' : '' }} value="communities" class="mr-2"> Followed Communities               
                </div>
                <div class="form-group">
                    <input type="radio" name="feed_type" {{ auth()->user()->settings && auth()->user()->settings->feed_type == 'featured' ? 'checked' : '' }}  value="featured" class="mr-2"> Featured Topics               
                </div>
                <button type="submit" class="btn btn-block btn-default">Update Feed Settings</button>
            </div>
        </div>

    </form>
    </div>
</div>
