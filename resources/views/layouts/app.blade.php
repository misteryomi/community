<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {!! SEO::generate() !!}

  <title>
    {{ env('APP_NAME') }} - The Nigerian Discussion Community
  </title>
  <link rel="alternate" type="application/atom+xml" title="News" href="/feed">
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

<script data-ad-client="ca-pub-3576547045661858" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-53641905-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-53641905-1');
</script>
<!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "0a139ea8-73c0-4d6e-8e77-7cda287b6239",
    });
  });
</script> -->

</head>

<body class="">
  <div id="wrapper" class="collapse-sidebar">
      @include('layouts.sections.sidebar')
      @include('layouts.sections.header')

      <div class="main_content">
        <div class="main_content_inner">
          @yield('content')
        </div>
      </div>
  </div>

@guest
<div id="modal-close-default" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        @include('auth.login-form')
    </div>
</div>    

@endguest


@include('layouts.scripts.darkmode')


<script src="{{ asset('assets/js/framework.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script> -->
<script src="{{ asset('assets/js/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<!-- <script> window._peq = window._peq || []; window._peq.push(["init"]); </script>
<script src="https://clientcdn.pushengage.com/core/b78d4cce-bb83-4338-ba11-e57810cc.js" async></script>
<script src="{{ asset('assets/js/service-worker.js') }}"></script> -->

@yield('scripts')
</body>

</html>
