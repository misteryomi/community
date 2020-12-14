@extends('layouts.app')

@section('content')
<h1>Admin Panel</h1>

<div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>

    <div>
        <div class="uk-card-default uk-card-body bg-danger uk-light">
            <h5> {{ $stats->topics }} </h5>
            <h5>Total Topics</h5>
        </div>
    </div>
    <div>
        <div class="uk-card-default uk-card-body bg-primary uk-light">
            <h5> {{ $stats->rants }} </h5>
            <h5> Total Rants </h5>
        </div>
    </div>
    <div>
        <div class="uk-card-default uk-card-body bg-info uk-light">
            <h5> {{ $stats->questions }} </h5>
            <h5> Total Questions </h5>
        </div>
    </div>
    <div>
        <div class="uk-card-default uk-card-body bg-dark uk-light">
            <h5> {{ $stats->jobs }} </h5>
            <h5> Total Jobs </h5>
        </div>
    </div>
</div>
@endsection
