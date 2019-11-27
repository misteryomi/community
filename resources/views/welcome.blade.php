@extends('layouts.app')


@section('content')

<div class="pt-2 pb-4 mb-3" role="alert">
    <h1>Welcome to Yarnable.com!</h1>
    <small>The community forums is a place to discuss anything development/design related. Remember to be nice and have fun.</small>
</div>
<div class="row">
  <div class="col-xl-3 d-none d-md-block">
      <a href="#" class="btn btn-icon btn-default btn-block mb-4">
        <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
          Create New Topic</a>

      <ul class="navbar-nav sidebar-nav mt-3 mb-3">
          <li class="nav-item  class=">
          <a class="nav-link active " href=" ./index.html"> <strong>View All Topics</strong>
            </a>
          </li>
      </ul>

      <ul class="navbar-nav sidebar-nav">
          <li class="nav-item  class=">
          <a class=" nav-link active " href=" ./index.html"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/icons.html">
              <i class="ni ni-planet text-blue"></i> Icons
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/maps.html">
              <i class="ni ni-pin-3 text-orange"></i> Maps
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/profile.html">
              <i class="ni ni-single-02 text-yellow"></i> User profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/tables.html">
              <i class="ni ni-bullet-list-67 text-red"></i> Tables
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/login.html">
              <i class="ni ni-key-25 text-info"></i> Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/register.html">
              <i class="ni ni-circle-08 text-pink"></i> Register
            </a>
          </li>
        </ul>
  </div>
  <div class="col-xl-9 mb-xl-0">
      @include('templates.topics_list')
  </div>
</div>

@endsection
