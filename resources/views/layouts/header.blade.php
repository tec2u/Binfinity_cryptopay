<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="font-family: Poppins, sans-serif;">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>BInfinity CryptoPay</title>
  <link rel="icon" type="image/png" sizes="400x400" href="assetsWelcomeNew/images/icon.png">

  <!-- Fonts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <!-- Icons -->
  <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.7/flipclock.css">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.7/flipclock.js"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;800&display=swap" rel="stylesheet">

  <style>
    nav,
    aside,
    ul,
    li,
    li a,
    h5,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Montserrat", sans-serif !important;
      font-weight: 200;
    }

    .sidebar,
    .nav-link span {
      text-transform: capitalize !important;
    }

    .up {
      text-transform: uppercase;
    }

    .font {
      font-family: "Montserrat", sans-serif !important;
      font-weight: 200;
    }
  </style>
</head>

<body>
  <!-- ======= Header ======= -->
  @include('sweetalert::alert')
  <header id="header" class="header font fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn" style="color: #ffffff;"></i>
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">

      <ul class="d-flex align-items-center">



        <li class="nav-item dropdown pe-3">
          <div class="btn-group">
            <button class="btn dropdown-toggle btn-lang " type="button" data-bs-toggle="dropdown"
              data-bs-auto-close="true" aria-expanded="false">
              @lang('header.language')
            </button>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="/setlocale/en"><img src="../assetsWelcome/images/flagunited-kingdom.png"
                    style="width: 18px;margin-right:10px" alt="...">@lang('header.english')</a>
              </li>
              <li>
                <a class="dropdown-item" href="/setlocale/es"><img src="../assetsWelcome/images/flagspain.png"
                    style="width: 18px;margin-right:10px" alt="...">@lang('header.spanish')</a>
              </li>
              <li>
                <a class="dropdown-item" href="/setlocale/de"><img src="../assetsWelcome/images/flaggermany.png"
                    style="width: 18px;margin-right:10px" alt="...">@lang('header.german')</a>
              </li>
              <li>
                <a class="dropdown-item" href="/setlocale/fr"><img src="../assetsWelcome/images/flagfrance.png"
                    style="width: 18px;margin-right:10px" alt="...">@lang('header.french')</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

            @if (!empty(auth()->user()->image_path))
              <img src="{{ asset('storage/' . auth()->user()->image_path) }}" alt="Profile" class="rounded-circle">
            @else
              <img src="{{ asset('assetsWelcomeNew/images/icon.png') }}" alt="Profile" class="rounded-circle">
            @endif

            <span class="d-none d-md-block dropdown-toggle ps-2"
              style="color: #ffffff;">{{ ucwords(auth()->user()->name) }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ ucwords(auth()->user()->name) }}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center alog" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right iconlog"></i>
                <span>@lang('header.sign_out')</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar font" style="background-color: #0071c1;">
    <a href="{{ route('home.home') }}">
      <img class="imagetest2" style="width: 250px" src="{{ asset('images/tigle_logo2.png') }}" alt="">
    </a>
    </br></br>

    <ul class="sidebar-nav" id="sidebar-nav">


      <li class="nav-item">
        <a class="nav-link " href="{{ route('home.home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link " href="{{ route('packages.index') }}">
          <i class="bi bi-circle"></i><span>New Invoice</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/packages/packagesprofit">
          <i class="bi bi-circle"></i><span>My Invoices</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('wallets.WithdrawWallet') }}">
          <i class="bi bi-clipboard2-minus"></i><span>WithDrawal Wallet</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('wallets.index') }}">
          <i class="bi bi-clipboard2-minus"></i><span>All My Allocated Wallets</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('wallets.transactions') }}">
          <i class="bi bi-clipboard2-minus"></i><span>Crypto Transactions</span>
        </a>
      </li>



      {{-- <!-- End Products Nav --> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#networks-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Referral Program</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="networks-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <!--<li>

                    <a href="{{ route('networks.mytree', ['parameter' => auth()->user()->id]) }}">
                        <i class="bi bi-circle"></i><span>@lang('header.my_tree')</span>
                    </a>
                </li>-->
          <li>
            <a href="{{ route('networks.associatesReport') }}">
              <i class="bi bi-circle"></i><span>My Team</span>
            </a>
          </li>
          <li>
            <a href="{{ route('withdraws.withdrawRequests') }}">
              <i class="bi bi-circle"></i><span>Withdraw Request</span>
            </a>
          </li>
          <li>
            <a href="{{ route('withdraws.withdrawLog') }}">
              <i class="bi bi-circle"></i><span>Withdraw Orders</span>
            </a>
          </li>
          <li>
            <a href="{{ route('reports.transactions') }}">
              <i class="bi bi-circle"></i><span>Commissions Transactions</span>
            </a>
          </li>
          <!--<li>
                    <a href="{{ route('networks.associatesReport') }}">
                        <i class="bi bi-circle"></i><span>@lang('header.associates')</span>
                    </a>
                </li>-->
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('supports.supporttickets') }}">
          <i class="bi bi-question-octagon"></i>
          <span>Support</span>
        </a>
      </li>



      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="report-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">



        </ul>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="settings-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('users.index') }}">
              <i class="bi bi-circle"></i><span>My Info</span>
            </a>
          </li>

          <li>
            <a href="{{ route('users.password') }}">
              <i class="bi bi-circle"></i><span>Password</span>
            </a>
          </li>
        </ul>
      </li>


      <li class="nav-item">

        <a class="nav-link collapsed" href="{{ route('logout') }}"
          onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-left"></i>
          <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
    </ul>
  </aside>

  <main id="main" class="main p-0">
    <!-- <section style="backdrop-filter: blur(0px);filter: brightness(120%) grayscale(0%) saturate(120%);" id="herosection">
            <div data-bss-scroll-zoom="true" data-bss-scroll-zoom-speed="0.5" style="width: 100%;height: 50vh;background: linear-gradient(rgba(0,0,0,0.83), rgba(0,0,0,0.78)), url(&quot;../assets/img/heroimg.png?h=19923c9d1c5b6e5752b86d1ffaf52718&quot;) center / cover no-repeat;">
                <div class="container h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-md-10 col-lg-10 col-xl-8 d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                            <div class="text-center" style="margin: 0 auto;">
                                <p data-aos="fade" data-aos-duration="1500" data-aos-delay="400" data-aos-once="true" class="phero">@lang('leadpage.home.txt')</p>
                                <h2 class="text-uppercase fw-bold mb-3 hhero hherosm" data-aos="fade-up" data-aos-duration="1400" data-aos-delay="800" data-aos-once="true">
                                    TIGER<br>INVESTMENT</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
  </main>
  @yield('content')

  {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
</body>

<script>
  (function() {
    "use strict";
    const select = (el, all = false) => {
      el = el.trim()
      if (all) {
        return [...document.querySelectorAll(el)]
      } else {
        return document.querySelector(el)
      }
    }
    const on = (type, el, listener, all = false) => {
      if (all) {
        select(el, all).forEach(e => e.addEventListener(type, listener))
      } else {
        select(el, all).addEventListener(type, listener)
      }
    }
    const onscroll = (el, listener) => {
      el.addEventListener('scroll', listener)
    }
    if (select('.toggle-sidebar-btn')) {
      on('click', '.toggle-sidebar-btn', function(e) {
        select('body').classList.toggle('toggle-sidebar')
      })
    }
  })();
</script>

</html>
