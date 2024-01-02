<!DOCTYPE HTML>
<html>

<head>
    <title>Tiger Investor</title>
    <link rel="icon" type="image/png" href="../assetsWelcome/images/favicon.png" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="assetsWelcome/css/main.css" />
    <link rel="stylesheet" href="assetsWelcome/css/Poppins.css" />
    <link rel="stylesheet" href="assetsWelcome/css/styles.css" />
    <link rel="stylesheet" href="assetsWelcome/css/Navbar-Right-Links-icons.css" />
    <link rel="stylesheet" href="assetsWelcome/css/Pricing-Centered-badges.css" />
    <link rel="stylesheet" href="assetsWelcome/fonts/line-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <noscript>
        <link rel="stylesheet" href="assetsWelcome/css/noscript.css" />
    </noscript>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body style="overflow-x: hidden;font-family: Poppins, sans-serif;">
    <!-- Start: Navbar Right Links -->

    <header id="header" class="alt">
        <h1 id="logo">
            <a href="{{ url('/') }}"><img src="../assetsWelcome/images/nolimitslogo.png" style="width: 120px;" alt="..."></a>
        </h1>
        <nav id="nav">
            <ul>
                <li><a class="hbutton" href="{{ url('/cards') }}"> @lang('leadpage.btn.cards')</a></li>
                <li><a class="hbutton" href="{{ url('/accounts') }}">@lang('leadpage.btn.accounts')</a></li>
                <li><a class="hbutton" href="{{ url('/concierge') }}">@lang('leadpage.btn.concierge')</a></li>
                {{-- <li><a class="hbutton" href="{{ url('/partners') }}">@lang('leadpage.btn.partners')</a></li> --}}
                {{-- <li><a class="hbutton" href="{{ url('/rewards') }}">Rewards</a>
                <li><a class="hbutton" href="{{ url('/blog') }}">Blog</a></li> --}}
                @if (Route::has('login'))
                @auth
                <a href="{{ route('admin.home') }}"><button class="jbutton">@lang('leadpage.btn.dashboard')</button></a>
                @else
                <a href="{{ route('login') }}"><button class="jbutton">@lang('leadpage.btn.login')</button></a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}"><button class="jbutton">@lang('leadpage.btn.join')</button></a>
                @endif
                @endauth
                @endif
            </ul>
        </nav>
    </header><!-- End: Navbar Right Links -->
    <section style="backdrop-filter: blur(0px);filter: brightness(120%) grayscale(0%) saturate(120%);" id="herosection">
        <div data-bss-scroll-zoom="true" data-bss-scroll-zoom-speed="0.5" style="width: 100%;height: 100vh;background: linear-gradient(rgba(0,0,0,0.83), rgba(0,0,0,0.78)), url(&quot;../assetsWelcome/images/heroimg.png&quot;) center / cover no-repeat;">
            <div class="container h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-md-10 col-lg-10 col-xl-8 d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div class="text-center" style="margin: 0 auto;">
                            <p data-aos="fade" data-aos-duration="1500" data-aos-delay="400" data-aos-once="true" class="phero">WELCOME TO THE WORLD OF</p>
                            <h2 class="text-uppercase fw-bold mb-3 hhero hherosm" data-aos="fade-up" data-aos-duration="1400" data-aos-delay="800" data-aos-once="true">INFINITY<br>CLUB CARDS</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main -->
    <main id="main">
        <section id="what-we-do" class="what-we-do">
            <div class="container">
                <div class="section-title">
                    <p>@lang('leadpage.home.msg')</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 d-flex align-items-stretch">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-solid fa-coins"></i></div>
                            <h4><a>@lang('leadpage.home.cryptocurrency')</a></h4>
                            <p>@lang('leadpage.home.cryptocurrency txt')</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-sharp fa-solid fa-money-bills"></i></div>
                            <h4><a>@lang('leadpage.home.traditional currency')</a></h4>
                            <p>@lang('leadpage.home.traditional currency txt')</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 d-flex align-items-stretch mt-4 mt-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-sharp fa-solid fa-universal-access"></i></div>
                            <h4><a>@lang('leadpage.home.concierge')</a></h4>
                            <p>@lang('leadpage.home.concierge txt')</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section id="phone">
            <div class="special">
                <div class="container">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5 col-sm-0">
                            </div>
                            <ul class="col-md-7 col-sm-12 nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item col-md-4" role="presentation">
                                    <button class="nav-link prof active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                        @lang('leadpage.home.cryptocurrency')
                                    </button>
                                </li>
                                <li class="nav-item col-md-4" role="presentation">
                                    <button class="nav-link prof" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                        @lang('leadpage.home.traditional currency')
                                    </button>
                                </li>
                                <li class="nav-item col-md-4" role="presentation">
                                    <button class="nav-link prof" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                                        @lang('leadpage.home.concierge')
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">


                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12" style="padding-top: 0px; text-align: center; vertical-align: middle;">
                                        <img src="../assetsWelcome/images/cryptocurrency_mockup_01.png" alt="..." style="width:400px">
                                    </div>
                                    <div class="col-md-7 col-sm-12">
                                        <div class="em_tab em_tab_0 clearfix em_active_content em-active-slide">


                                            <div class="em_tab_content">
                                                @lang('leadpage.home.cryptocurrency tab')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12" style="padding-top: 0px;text-align: center; vertical-align: middle;">
                                        <img src="../assetsWelcome/images/traditional_currencies_01.png" alt="..." style="width:400px">
                                    </div>
                                    <div class="col-md-7 col-sm-12">
                                        <div class="em_tab em_tab_1 clearfix em-active-slide" style="z-index: 1; display: block; opacity: 1;">

                                            <div class="em_tab_content">
                                                @lang('leadpage.home.traditional currency tab')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12" style="padding-top: 0px;text-align: center; vertical-align: middle;">
                                        <img src="../assetsWelcome/images/concierge_mockup_01.png" alt="..." style="width:400px">
                                    </div>
                                    <div class="col-md-7 col-sm-12">
                                        <div class="em_tab em_tab_2 clearfix em-active-slide" style="z-index: 1; display: block; opacity: 1;">

                                            <div class="em_tab_content">
                                                @lang('leadpage.home.concierge tab')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pricing-table">
            <div class="container">
                <div class="row">
                    <div class="title">
                        <h2>@lang('leadpage.home.princing')</h2>
                        <p>@lang('leadpage.home.princingsub')</p>
                    </div>

                    @forelse ($packages as $package)
                    <div class="col-md-3 col-sm-12">
                        <div class="card shadow-sm m-auto d-flex ">
                            <div class="card-body">
                                <h5 class="card-title mb-3">{{$package->name}}</h5>
                                <h2>${{number_format($package->price,2, ',', '.')}} <small>Joining Fee</small></h2>
                            </div>
                            {!!$package->long_description!!}
                            <div class="card-footer text-center">
                                <a href="#" class="button btn-pric">Get {{$package->name}}</a>
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse




                </div>
            </div>
        </section>

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>@lang('leadpage.home.reasons.title')</h2>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-box">
                            <i class="bi bi-briefcase"></i>
                            <h4>@lang('leadpage.home.reasons.liquidation')</a></h4>
                            <p>@lang('leadpage.home.reasons.liquidationtext')</p>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4 mt-lg-0">
                        <div class="icon-box">
                            <i class="bi bi-card-checklist"></i>
                            <h4>@lang('leadpage.home.reasons.transparent')</a></h4>
                            <p>@lang('leadpage.home.reasons.transparenttext')</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="icon-box">
                            <i class="bi bi-bar-chart"></i>
                            <h4>@lang('leadpage.home.reasons.banks')</a></h4>
                            <p>@lang('leadpage.home.reasons.bankstext')</p>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="icon-box">
                            <i class="bi bi-binoculars"></i>
                            <h4>@lang('leadpage.home.reasons.travel')</a></h4>
                            <p>@lang('leadpage.home.reasons.traveltext')</p>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="icon-box">
                            <i class="bi bi-brightness-high"></i>
                            <h4>@lang('leadpage.home.reasons.rewards')</a></h4>
                            <p>@lang('leadpage.home.reasons.rewardstext')</p>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="icon-box">
                            <i class="bi bi-calendar4-week"></i>
                            <h4>@lang('leadpage.home.reasons.currencies')</a></h4>
                            <p>@lang('leadpage.home.reasons.currenciestext')</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @lang('leadpage.home.reasons.row')

                </div>
            </div>
        </section>
        <!-- End Services Section -->

    </main>

    <!-- CTA -->
    <section id="cta" class="bg-luxury">

        <header>
            <h2>@lang('leadpage.footer.ready')</h2>
        </header>
        <footer>
            <ul class="buttons">
                <li><a href="{{ route('register') }}" class="button btn-pric">@lang('leadpage.btn.register')</a></li>
                <li><a href="{{ route('login') }}" class="button btn2 btn-pric">@lang('leadpage.btn.login')</a></li>
            </ul>
        </footer>

    </section>

    <!-- Footer -->
    <footer id="footer" class="bg-luxury">
        <div class="container">
            <div class="row">
                <div class="col-md-6 rodape">
                    <p class="txt_footer">
                        @lang('leadpage.footer.product')
                    </p>
                    <ul class="txt_ajuste">
                        <li><a href="#" class="txt_footer1">@lang('leadpage.footer.productbtn.txt_footer1')</a></li>
                        <li class="txt_li"><a href="#" class="txt_footer1">@lang('leadpage.footer.productbtn.txt_footer2')</a></li>
                        <li class="txt_li"><a href="#" class="txt_footer1">@lang('leadpage.footer.productbtn.txt_footer3')</a></li>
                        <li class="txt_li"><a href="#" class="txt_footer1">@lang('leadpage.footer.productbtn.txt_footer4')</a></li>
                        <li class="txt_li"><a href="#" class="txt_footer1">@lang('leadpage.footer.productbtn.txt_footer5')</a></li>
                        <li class="txt_li"><a href="#" class="txt_footer1">@lang('leadpage.footer.productbtn.txt_footer6')</a></li>
                    </ul>
                </div>
                <div class="col-md-6 rodape">
                    <div class="list-group">
                        <p class="txt_footer mb-4">
                            @lang('leadpage.btn.language')
                        </p>
                        <a class="langlink" href="/setlocale/en"><img src="../assetsWelcome/images/flagunited-kingdom.png" class="langimg" alt="...">@lang('leadpage.btn.english')</a></li>
                        <a class="langlink" href="/setlocale/es"><img src="../assetsWelcome/images/flagspain.png" class="langimg" alt="...">@lang('leadpage.btn.spanish')</a>
                        <a class="langlink" href="/setlocale/de"><img src="../assetsWelcome/images/flaggermany.png" class="langimg" alt="...">@lang('leadpage.btn.german')</a>
                        <a class="langlink" href="/setlocale/fr"><img src="../assetsWelcome/images/flagfrance.png" class="langimg" alt="...">@lang('leadpage.btn.french')</a>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="col-12 rodape">
                    @lang('leadpage.footer.logtext')

                </div>
            </div>

            <ul class="copyright">
                @lang('leadpage.footer.copyright')
            </ul>

    </footer>
</body>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="assetsWelcome/js/jquery.min.js"></script>
<script src="assetsWelcome/js/jquery.dropotron.min.js"></script>
<script src="assetsWelcome/js/jquery.scrolly.min.js"></script>
<script src="assetsWelcome/js/jquery.scrollex.min.js"></script>
<script src="assetsWelcome/js/browser.min.js"></script>
<script src="assetsWelcome/js/breakpoints.min.js"></script>
<script src="assetsWelcome/js/util.js"></script>
<script src="assetsWelcome/js/main.js"></script>


<script>
    const faders = document.querySelectorAll('.fade-in');
    const sliders = document.querySelectorAll('.slide-in')

    const appearOptions = {
        threshold: 0,
        rootMargin: "0px 0px -250px -200px"
    };

    const appearOnScroll = new IntersectionObserver(function(entries, appearOnScroll) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            } else {
                entry.target.classList.add('appear');
                appearOnScroll.unobserve(entry.target);
            }
        })
    }, appearOptions);

    faders.forEach(fader => {
        appearOnScroll.observe(fader);

    })

    sliders.forEache(slider => {
        appearOnScroll.observe(slider);
    })
</script>


</body>

</html>