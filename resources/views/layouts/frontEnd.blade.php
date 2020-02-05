<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>Apis Cerana</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <!-- External CSS libraries -->
  <link type="text/css" rel="stylesheet" href="{{ asset('fn/css/bootstrap.min.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('fn/css/magnific-popup.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('fn/css/jquery.selectBox.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('fn/css/rangeslider.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('fn/css/animate.min.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('fn/css/jquery.mCustomScrollbar.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('fn/fonts/font-awesome/css/font-awesome.min.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('fn/fonts/flaticon/font/flaticon.css') }}">

  <!-- Favicon icon -->
  <link rel="shortcut icon" href="{{ asset('dist/img/ApisMelli.png') }}" type="image/x-icon">

  <!-- Google fonts -->
  <link rel="stylesheet" type="text/css"
        href="{{ url('https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700') }}">

  <!-- Custom Stylesheet -->
  <link type="text/css" rel="stylesheet" href="{{ asset('fn/css/style.css') }}">
  <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('fn/css/skins/yellow.css') }}">
  @yield('endCSS')
</head>

<body id="top">
<!-- End Google Tag Manager (noscript) -->
<div class="page_loader"></div>

<!-- main header start -->
<header class="main-header sticky-header" id="main-header-2">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light rounded">
          <a class="navbar-brand navbar-brand d-flex mr-auto" href="{{ url('/') }}">
            <img src="{{ asset('dist/img/ApisMelli.png') }}" style="width: 10%">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                  aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
          </button>
          <div class="navbar-collapse collapse w-100" id="navbar">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link"
                   href="{{ url('https://play.google.com/store/apps/details?id=co.multipayment') }}">
                  Aplikasi
                </a>
              </li>
              @if (Route::has('login'))
                <li class="nav-item dropdown active">
                  @auth
                    <a class="btn btn-sm btn-white-sm-outline btn-round signup-link" href="{{ url('/home') }}">
                      Home
                    </a>
                  @else
                    <a class="btn btn-sm btn-white-sm-outline btn-round signup-link" href="{{ route('login') }}">
                      Login
                    </a>
                    @if (Route::has('register'))
                      <a class="btn btn-sm btn-white-sm-outline btn-round signup-link" href="{{ route('register') }}">
                        Register
                      </a>
                    @endif
                  @endauth
                </li>
              @endif
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>
<!-- main header end -->

@yield('content')

<!-- External JS libraries -->
<script src="{{ asset('fn/js/jquery-2.2.0.min.js') }}"></script>
<script src="{{ asset('fn/js/popper.min.js') }}"></script>
<script src="{{ asset('fn/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('fn/js/jquery.selectBox.js') }}"></script>
<script src="{{ asset('fn/js/rangeslider.js') }}"></script>
<script src="{{ asset('fn/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('fn/js/jquery.filterizr.js') }}"></script>
<script src="{{ asset('fn/js/wow.min.js') }}"></script>
<script src="{{ asset('fn/js/backstretch.js') }}"></script>
<script src="{{ asset('fn/js/jquery.countdown.js') }}"></script>
<script src="{{ asset('fn/js/jquery.scrollUp.js') }}"></script>
<script src="{{ asset('fn/js/particles.min.js') }}"></script>
<script src="{{ asset('fn/js/typed.min.js') }}"></script>
<script src="{{ asset('fn/js/jquery.mb.YTPlayer.js') }}"></script>
<script src="{{ asset('fn/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ url('https://maps.googleapis.com/maps/api/js?key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE') }}"></script>
<script src="{{ asset('fn/js/ie-emulation-modes-warning.js') }}"></script>
<!-- Custom JS Script -->
<script src="{{ asset('fn/js/app.js') }}"></script>
@yield('endJS')
</body>
</html>