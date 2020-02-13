<div class="card-body text-center">

    <a href="#" class="avatar avatar-xl rounded-circle">
        <img alt="" src="{{ $user->avatar }}">
    </a>

    <h3 class="mb-0">
        {{ $user->fullname }}
    </h3>
    <p> {{ $user->username }}</p>
    <p class="text-sm text-muted mb-0">{{ $user->details->bio }}</p>
    <small>Member since:<br/>{{ $user->date_joined }}</small>

    <hr />
    <div class="row mt-1">
            <div class="col">
                <h3>{{ $user->posts->count() }}</h3>
                <small class="text-gray">Topics</small>
            </div>
            <div class="col">
                    <h3>{{ $user->comments->count() }}</h3>
                    <small class="text-gray">Comments</small>
            </div>
    </div>
</div>
