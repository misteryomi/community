@extends('layouts.app')


@section('content')


<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
    @include('jobs.list_template')
  </div>

  <div class="uk-width-expand">

    <div class="sidebar-filter" uk-sticky="offset:30 ; media : @s: bottom: true">

        <div class="sidebar-filter-contents">


            <h3> Filter</h3>

            <ul class="sidebar-filter-list uk-accordion" uk-accordion="multiple: true">

                <li class="uk-open">
                    <a class="uk-accordion-title" href="#"> Field </a>
                    <div class="uk-accordion-content" aria-hidden="false">
                        <div class="uk-form-controls">
                            <label>
                                <input class="uk-radio" type="radio" name="radio1" checked>
                                <span class="test"> Beginner <span> (25) </span> </span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio1">
                                <span class="test"> Intermidate<span> (32) </span></span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio1">
                                <span class="test"> Expert <span> (12) </span></span>
                            </label>
                        </div>
                    </div>
                </li>

                <li class="uk-open">
                    <a class="uk-accordion-title" href="#"> Skill Levels </a>
                    <div class="uk-accordion-content" aria-hidden="false">
                        <div class="uk-form-controls">
                            <label>
                                <input class="uk-radio" type="radio" name="radio1" checked>
                                <span class="test"> Beginner <span> (25) </span> </span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio1">
                                <span class="test"> Intermidate<span> (32) </span></span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio1">
                                <span class="test"> Expert <span> (12) </span></span>
                            </label>
                        </div>
                    </div>
                </li>

                <li class="uk-open">
                    <a class="uk-accordion-title" href="#"> Job Type </a>
                    <div class="uk-accordion-content" aria-hidden="false">
                        <div class="uk-form-controls">
                            <label>
                                <input class="uk-radio" type="radio" name="radio2">
                                <span class="test"> Freelance (42) </span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio2" checked>
                                <span class="test"> Full Time </span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio2">
                                <span class="test"> Part Time </span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio2">
                                <span class="test"> Temporary </span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio2">
                                <span class="test"> Full Time </span>
                            </label>
                        </div>
                    </div>
                </li>

                <li class="uk-open">
                    <a class="uk-accordion-title" href="#"> Location </a>
                    <div class="uk-accordion-content" aria-hidden="false">
                        <div class="uk-form-controls">
                            <label>
                                <input class="uk-radio" type="radio" name="radio3" checked>
                                <span class="test"> +5 Hourse (23) </span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio3">
                                <span class="test"> +10 Hourse (12)</span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio3">
                                <span class="test"> +20 Hourse (5)</span>
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="radio3">
                                <span class="test"> +30 Hourse (2)</span>
                            </label>
                        </div>
                    </div>
                </li>


            </ul>



        </div>

    </div>


</div>

</div>

@endsection
