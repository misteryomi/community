@extends('layouts.app')


@section('content')


<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
    @include('jobs.list_template')
  </div>
    
  <div class="uk-width-expand">

    <div class="sidebar-filter">

        <div class="sidebar-filter-contents">


            <h3> Filter</h3>
            <form action="?" method="get">
                <ul class="sidebar-filter-list uk-accordion" uk-accordion="multiple: true">

                    <li class="uk-open">
                        <a class="uk-accordion-title" href="#"> Salary Range </a>
                        <div class="uk-accordion-content" aria-hidden="false">
                            <div class="uk-margin">
                                <label><small>Minimum Salary (NGN)</small></label>
                                <input class="uk-input" name="min_salary" type="text" placeholder="1000">
                                <label><small>Maximum (NGN)</small></label>
                                <input class="uk-input" name="max_salary" type="text" placeholder="100,000">
                            </div>                    
                            <div class="uk-margin">
                            </div>                    
                        </div>
                    </li>

                    <li class="uk-open">
                        <a class="uk-accordion-title" href="#"> Job Category </a>
                        <div class="uk-accordion-content" aria-hidden="false">
                            <select class="uk-select" name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>

                    <li class="uk-open">
                        <a class="uk-accordion-title" href="#"> Job Type </a>
                        <div class="uk-accordion-content" aria-hidden="false">
                            <div class="uk-form-controls">
                                <label>
                                    <input class="uk-radio" type="radio" value="all" checked name="type">
                                    <span class="test"> All </span>
                                </label>
                                @foreach($types as $type)
                                <label>
                                    <input class="uk-radio" type="radio" value="{{ $type->id }}" name="type">
                                    <span class="test"> {{ $type->type}} </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li class="uk-open">
                        <a class="uk-accordion-title" href="#"> Location </a>
                        <div class="uk-accordion-content" aria-hidden="false">
                            <div class="uk-form-controls">
                                @foreach($locations as $location)
                                <label>
                                    <input class="uk-radio" type="radio" value="{{ $location->location }}" name="location" checked>
                                    <span class="test">{{ $location->location }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li>
                        <button class="button block primary">Filter Jobs</button>
                    </li>
                </ul>
            </form>

        </div>

    </div>


</div>

</div>

@endsection
