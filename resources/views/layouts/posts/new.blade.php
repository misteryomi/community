@extends('layouts.app')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="uk-grid-large uk-grid uk-grid-stack" uk-grid="">
  <div class="uk-width-3-4@m uk-first-column">
     <div class="uk-width-5-5@m m-auto">
        <div class="mt-lg-4" uk-grid>
            <div class="uk-width-3-3@m">
                    @yield('form_title')
                    @include('layouts.partials.alert')
                    @yield('form_content')
                      </div>
                    </div>
                </div>
              </div>
        </div>

    @include('templates.sidebar')
</div>



@endsection

@section('scripts')
    @include('layouts.posts.script')
@endsection