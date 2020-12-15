@extends('layouts.posts.show')


@section('extra_info_after')
@if($best_answer)
<div class="uk-alert-primary p-4">
    <h3>Best Answer</h3>
    <div class="">
        <div class="text-dark">
            {!! $best_answer->comment !!}
        </div>

        <a href="#" class="user-details-card pt-0">
            <div class="user-details-card-avatar" style="max-width: 40px">
                <img src="{{ $best_answer->user->avatar }}" alt="">
            </div>
            <div class="user-details-card-name">
                {{ ucfirst($best_answer->user->username) }} <span> {{ $best_answer->user->level }} <span> {{ $post->date }} </span> </span>
            </div>
        </a>
        <!-- <div class="best_answer-by">{{ ucfirst($best_answer->user->username) }}<span>{{ $best_answer->date}}</span> -->
    </div>

</div>
@endif
@endsection
