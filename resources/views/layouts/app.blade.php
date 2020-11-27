<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {!! SEO::generate() !!}

  <title>
    {{ env('APP_NAME') }} - The Nigerian 411 Discussion Community
  </title>
  <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  @yield('styles')
  <!-- <link href="{{ asset('css/style.css') }}" rel="stylesheet" /> -->

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/night-mode.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/framework.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-53641905-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-53641905-1');
</script>


</head>

<body class="">
  <div id="wrapper">
      @include('layouts.sections.sidebar')
      @include('layouts.sections.header')

      <div class="main_content">
        <div class="main_content_inner">
          @yield('content')
        </div>
      </div>

  </div>
@include('layouts.scripts.darkmode')

<script src="{{ asset('assets/js/framework.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')
</body>

</html>
