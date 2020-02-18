@extends('layouts.app')


@section('content')

<div class="row">
    @foreach($communities as $community)
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3><a href="{{ route('community.list', ['community' => $community->slug]) }}">{{ $community->name }}</a></h3>
                <p><small>{{ $community->posts->count() }} Topics &nbsp; | &nbsp; {{ $community->followers->count() }} Followers</small></p>
                <p>{{ $community->excerpt }}</p>


                @if($community->userFollows(auth()->user()))
                <a href="{{ route('community.unfollow', ['community' => $community->slug])  }}" class="btn btn-icon btn-block btn-outline-dark mb-1">
                          Unfollow</a>
                @else
                <a href="{{ route('community.follow', ['community' => $community->slug]) }}" class="btn btn-icon btn-block btn-outline-primary mb-1">
                          Follow</a>
                @endif

            </div>
        </div>
    </div>
        
    @endforeach
</div>

@endsection
