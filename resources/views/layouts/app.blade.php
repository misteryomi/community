<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {!! SEO::generate() !!}

  <title>
    {{ env('APP_NAME') }} - The Nigerian 411 Discussion Community
  </title>
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  @yield('styles')
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

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

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="px-2 d-md-none">
        <ul class="d-inline-block">
            <li class="mb-2">
                <a href="{{ route('topics') }}" class="nav-link"><i class="fa fa-newspaper-o mr-2"></i> Latest</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('topics') }}" class="nav-link"><i class="fa fa-fire mr-2"></i> Trending</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('community.all') }}" class="nav-link"><i class="fa fa-object-group mr-2"></i> Communities</a>
            </li>
          </ul>
          <hr class="mt-2"/>
          <a href="{{ route('posts.new') }}" class="btn btn-default btn-block mb-4">
            <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
              Create New Topic</a>
                  
            @php $communities = \App\Community::where('is_parent', 1)->get() @endphp

            @include('templates.categories_list_only')
        </div>
    </div>
  <div class="main-content">

    <nav class="navbar navbar-expand border-bottom bg-white {{ isset($isHomepage) ? ' navbar-light' : ' navbar-light border-bottom' }}" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-uppercase" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.png') }}" height="40px" />
            {{-- <img src="{{ asset('assets/img/logo_.png') }}" height="40px" class="d-md-none"/> --}}
        </a>
        <form action="{{ route('topics') }}" method="get" class="navbar-search d-none d-md-flex  ml-4 ">
          <div class="input-group">
            <input type="text" class="form-control px-2" placeholder="Search Topics..." name="q">
            <div class="input-group-append">
              <button type="submit" class="input-group-text" type="button"><i class="fa fa-search"></i></button>
            </div>
          </div>

        </form>
        <ul class="navbar-nav align-items-center ml-md-auto">
              <li class="nav-item d-lg-none">
                  <a href="#" class="nav-link" onclick="openNav()">
                      <span class="navbar-toggler-icon"></span>
                  </a>
              </li>
                <li class="nav-item d-none d-md-inline">
                    <a href="{{ route('topics') }}" class="nav-link"><i class="fa fa-newspaper-o"></i> Latest</a>
                </li>
                <li class="nav-item d-none d-md-inline">
                    <a href="{{ route('topics') }}" class="nav-link"><i class="fa fa-fire"></i> Trending</a>
                </li>
                <li class="nav-item d-none d-md-inline">
                    <a href="{{ route('community.all') }}" class="nav-link"><i class="fa fa-object-group"></i> Communities</a>
                </li>
            @guest
                <li class="nav-item">
                  <a class="nav-link btn btn-primary text-white mr-2" href="{{ route('login') }}"><strong>Login</strong></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link btn btn-danger text-white" href="{{ route('register') }}">
                    <span class="d-none d-md-block">Create an Account</span>
                    <span class="d-md-none">Sign Up</span>
                  </a>
                </li>
        @else
            <li class="nav-item">
                <a href="{{ route('posts.new') }}" class="nav-link ml-3 btn btn-icon btn-default text-white">
                    <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                      <span class="d-none d-md-inline">Create New Topic</span></a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                  <img alt="" src="{{ auth()->user()->avatar }}" class="avatar avatar-sm img-circle">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ ucfirst(auth()->user()->username) }}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                <a href="{{ route('profile.show', ['user' => auth()->user()->username]) }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
                <a href="{{ route('profile.settings') }}" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="{{ route('topics.saved') }}" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Saved Posts</span>
              </a>
              {{-- <a href="{{ route('topics.liked') }}" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Liked Posts</span>
              </a> --}}
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>

        </ul>
        @endguest
        </ul>
      </div>
    </nav>
    @yield('wide-content')

    <div class="container mt-3 mt-md-6">

        @yield('content')

        <footer class="footer text-center">
                <div class="copyright text-center text-muted">
                <p>&copy; {{ date('Y') }} <a href="#top" class="font-weight-bold ml-1">{{ env('APP_NAME') }}</a>. All rights reserved.</p>
                <p><small>Disclaimer: All posts or comments on this website do not represent the views of the <a href="{{ route('home') }}">{{ env('APP_NAME') }}</a> Team. Individuals are responsible for their own posts.</small></p>
                </div>
        </footer>

    </div>



<div class="modal fade" id="auth-modal" tabindex="-1" role="dialog" aria-labelledby="auth-modal" aria-hidden="true">
<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
  <div class="modal-content">

      <div class="modal-body py-5">
          <div class="mb-2 text-center">
              <h2 class="mb-3 text-default">You are not logged in</h2>
              <p class="">You must be logged in to perform that action</p>
              <hr/>
              <a class=" " href="{{ route('register') }}?utm_redirect={{ request()->fullUrl() }}">New here? Create an account</a>
                      
          </div>

          @include('auth.login-form')
          <p class="text-center mt-2">
            <a href="{{ route('forgot-password') }}">Forgot your password? Reset Password</a><br/>
          </p>
      </div>

  </div>
</div>

  </div>
  <script src="{{ asset('js/script.js') }}"></script>
  @yield('scripts')
</body>

</html>
