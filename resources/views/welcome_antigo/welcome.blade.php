<!DOCTYPE html>
<html lang="en" style="font-family: Poppins, sans-serif;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tiger Investor</title>
    <link rel="icon" type="image/png" href="../assetsWelcome/images/favicon.png" />
    <link rel="stylesheet" href="assetsWelcome/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assetsWelcome/css/Poppins.css" />
    <link rel="stylesheet" href="assetsWelcome/fonts/line-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assetsWelcome/css/Navbar-Right-Links-icons.css" />
    <link rel="stylesheet" href="assetsWelcome/css/Pricing-Centered-badges.css" />
    <link rel="stylesheet" href="assetsWelcome/css/styles.css" />
</head>

<body style="overflow-x: hidden;font-family: Poppins, sans-serif;">
    <!-- Start: Navbar Right Links -->
    <nav class="navbar navbar-light navbar-expand-lg fixed-top shadow-sm navbarstyle" data-aos="fade-down" data-aos-duration="1200" data-aos-delay="2000" data-aos-once="true">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}"><img src="./assetsWelcome/images/nolimitslogo.png" width="56px"></a><button data-bs-toggle="collapse" class="navbar-toggler fs-6 fw-light text-white text-bg-warning shadow-lg" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav navbar-nav-scroll ms-auto">
                    <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/cards') }}">@lang('leadpage.btn.cards')</a></li>
                    <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/accounts') }}">@lang('leadpage.btn.accounts')</a></li>
                    <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/concierge') }}">@lang('leadpage.btn.concierge')</a></li>
                </ul>
                @if (Route::has('login'))
                @auth
                <a href="{{ route('admin.home') }}" role="button" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-delay="2600" data-aos-once="true"><button class="btn btn-warning ms-md-2 btnnav">@lang('leadpage.btn.dashboard')</button></a>
                @else
                <a class="btn link-warning ms-md-2 btnnavlog" role="button" href="{{ route('login') }}">@lang('leadpage.btn.login')</a>
                @if (Route::has('register'))
                <a class="btn btn-warning ms-md-2 btnnav" role="button" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-delay="2600" data-aos-once="true" href="{{ route('register') }}">@lang('leadpage.btn.join')</a>
                @endif
                @endauth
                @endif
            </div>
        </div>
    </nav><!-- End: Navbar Right Links -->
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
    <section class="espacoy bg-dark">
        <div>
            <!-- Start: 1 Row 2 Columns -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center"><img class="img-fluid border rounded-circle" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="400" data-aos-once="true" src="assets/img/ThomasEnglert.png" loading="auto" width="200px">
                        <h4 class="teng">THOMAS ENGLERT</h4>
                        <p class="ceo">CEO &amp; FOUNDER</p>
                    </div>
                    <div class="col chost" style="border-left: 1.5px solid rgba(33,37,41,0.5);">
                        <h6 class="ceo">YOUR&nbsp;HOST&nbsp;TODAY</h6>
                        <h1 class="text-uppercase teng my-4" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="400" data-aos-once="true">"ONE OF THE MOST <br>successful LEADERS"</h1>
                        <p class="phost">A company is an association or collection of individuals, whether natural persons, legal persons, or a mixture of both. Company members share a common purpose and unite in order to focus their various talents and organize their collectively available skills or resources to achieve specific, declared goals. A company or association of persons can be created at law as legal person so that the company in itself can accept Limited liability for civil responsibility and taxation incurred as members perform</p>
                    </div>
                </div>
            </div><!-- End: 1 Row 2 Columns -->
        </div>
    </section>
    <section class="espacoy">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-center">THE INFINITY CLUB CARD</h6>
                    <h1 class="text-center" style="margin-bottom: 32px;">ONE CARD. <br>BEYOND PAYMEND.</h1>
                    <div class="d-flex align-items-center align-items-md-start align-items-xl-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center me-4 d-inline-block bs-icon xl" style="background: rgba(13,110,253,0);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle" data-aos="fade" data-aos-duration="1200" data-aos-delay="1000" data-aos-once="true" style="color: rgb(188,188,188);">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                            </svg></div>
                        <div>
                            <h4>The Card</h4>
                            <p class="text-black-50">A company is an association or collection of individuals, <br>whether natural persons, A company is an association or</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center align-items-md-start align-items-xl-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center me-4 d-inline-block bs-icon xl" style="background: rgba(13,110,253,0);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle" data-aos="fade" data-aos-duration="1200" data-aos-delay="1400" data-aos-once="true" style="color: rgb(188,188,188);">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                            </svg></div>
                        <div>
                            <h4>The Features</h4>
                            <p class="text-black-50">All about the features that make </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center align-items-md-start align-items-xl-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center me-4 d-inline-block bs-icon xl" style="background: rgba(13,110,253,0);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle" data-aos="fade" data-aos-duration="1200" data-aos-delay="1800" data-aos-once="true" style="color: rgb(188,188,188);">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                            </svg></div>
                        <div>
                            <h4>Your Success</h4>
                            <p class="text-black-50">Learn how to join the Infinity Club and grow rich <br>using our outstanding Affiliate System</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div><img src="assets/img/PLATINUM%20ELITE%20MEMEBR.png" class="onecardimg" width="100%"></div>
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section>
    <section class="bg-dark">
        <div>
            <!-- Start: 1 Row 2 Columns -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col" style="text-align: center;min-height: 400px;">
                        <div class="d-flex align-items-center divimg"><img data-aos="fade-right" data-aos-duration="1800" data-aos-once="true" src="assets/img/Infinityclubcardwhite.png" width="240px" style="margin: auto;"></div>
                    </div>
                    <div class="col-md-6" style="background: #ffffff;padding-top: 40px;padding-bottom: 40px;">
                        <div class="row mb-5">
                            <div class="col-md-8 col-xl-6 text-center mx-auto">
                                <h6 class="text-black-50">ABOUT THE CARD</h6>
                                <h2>THE BASICS</h2>
                                <p class="text-black-50 w-lg-50">A few things about there very Basics of our Infinity Club Cards.</p>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                                <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                                    <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="400" data-aos-once="true"></i></div>
                                    <div class="px-3">
                                        <h4>DEBIT CARD</h4>
                                        <p class="text-black-50">Load with Crypto and<br>currencies</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                                <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                                    <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="600" data-aos-once="true"></i></div>
                                    <div class="px-3">
                                        <h4>150 CURRENCIES</h4>
                                        <p class="text-black-50">Almost every currency<br>supported</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                                <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                                    <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="800" data-aos-once="true"></i></div>
                                    <div class="px-3">
                                        <h4>ATM</h4>
                                        <p class="text-black-50">Withdraw up to $5000 <br>dailyon ATM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                                <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                                    <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="1000" data-aos-once="true"></i></div>
                                    <div class="px-3">
                                        <h4>8 LEVELS</h4>
                                        <p class="text-black-50">Entrepreneurial activities differ <br>substantially</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End: 1 Row 2 Columns -->
        </div>
    </section>
    <section class="espacoy">
        <!-- Start: 2 Rows 1+3 Columns -->
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h6 class="text-black-50">YOU CAN WRITE HERE</h6>
                    <h1>YOUR CLUB CARD</h1>
                    <p class="text-black-50">Our credit cards include features for everyone that go far beyond payment.<br>It is the best option for…</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                        <div class="bs-icon-xl bs-icon-rounded d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="la la-compass iconv" style="color: rgb(204,204,204);"></i></div>
                        <div class="px-3">
                            <h4>TRAVELLING</h4>
                            <p class="text-black-50">With our cards you will pay <br>in almost any currency</p>
                        </div>
                    </div>
                    <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                        <div class="bs-icon-xl bs-icon-rounded d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="la la-credit-card iconv" style="color: #adadad;"></i></div>
                        <div class="px-3">
                            <h4>BUSINESS</h4>
                            <p class="text-black-50">A company is an association or collection of individuals</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="overflow: hidden;"><img class="img-fluid" src="assets/img/cardplatinumelitemember.png" width="296" height="194" style="position: relative;width: 500px;"></div>
                <div class="col-12 col-md-4">
                    <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                        <div class="bs-icon-xl d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="la la-diamond iconv" style="color: #adadad;"></i></div>
                        <div class="px-3">
                            <h4>SHOPPING</h4>
                            <p class="text-black-50">Huge transaction limits that <br>will satisfy every woman</p>
                        </div>
                    </div>
                    <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                        <div class="bs-icon-xl d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="la la-bitcoin iconv" style="color: #adadad;"></i></div>
                        <div class="px-3">
                            <h4>INVESTMENT</h4>
                            <p class="text-black-50">A company is an association or collection of individuals</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End: 2 Rows 1+3 Columns -->
    </section>
    <section style="background: var(--bs-black);">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto col-md-6" style="padding-right: 0;padding-left: 0;background: #25292F;">
                    <div style="width: 100%;overflow: hidden;"></div><img src="assets/img/imgcrypyowallet.png" width="1000px" style="margin-left: -160px;">
                </div>
                <div class="col-md-6" style="background: #ffffff;padding-top: 40px;padding-bottom: 40px;">
                    <div class="row mb-5">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <h6 class="text-black-50">ABOUT THE CARD</h6>
                            <h2>THE BASICS</h2>
                            <p class="text-black-50 w-lg-50">A few things about there very Basics of our Infinity Club Cards.</p>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                            <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                                <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3"><i class="la la-check iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="600" data-aos-once="true"></i></div>
                                <div class="px-3">
                                    <h4>DEBIT CARD</h4>
                                    <p class="text-black-50">Load with Crypto and<br>currencies</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                            <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                                <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="800" data-aos-once="true"></i></div>
                                <div class="px-3">
                                    <h4>150 CURRENCIES</h4>
                                    <p class="text-black-50">Almost every currency<br>supported</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                            <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                                <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="1000" data-aos-once="true"></i></div>
                                <div class="px-3">
                                    <h4>ATM</h4>
                                    <p class="text-black-50">Withdraw up to $5000 <br>dailyon ATM</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                            <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #ffffff;">
                                <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="1200" data-aos-once="true"></i></div>
                                <div class="px-3">
                                    <h4>8 LEVELS</h4>
                                    <p class="text-black-50">Entrepreneurial activities differ <br>substantially</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section>
    <section>
        <!-- Start: Pricing Clean -->
        <div class="container py-4 py-xl-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>PRICING TABLE</h2>
                </div>
            </div>
            <div class="row gx-3 gy-3 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
                @forelse ($packages as $package)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 shad" data-aos="flip-right" data-aos-duration="600" data-aos-delay="400" data-aos-once="true">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div>
                                <h5 class="text-uppercase text-muted">{{$package->name}}</h5>
                                <h6 class="fw-bold">Joining Fee</h6>
                                <h4 class="display-6 fw-bold">${{number_format($package->price,2, ',', '.')}} </h4>
                                <!-- <h6 class="text-uppercase text-muted">monthly subscription $35</h6>
                                <h5 class="fw-bold text-warning mt-2">First Month Free</h5> -->
                                <hr>
                                {!!$package->long_description!!}
                                <!-- <ul class="list-unstyled">
                                    <li class="d-flex mb-2"><span>Fiat Multi-Currency Account&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span>Crypto Multi-Currency Account&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span>USD, EUR, GBP, CNY, JPY Accounts<br></span></li>
                                    <li class="d-flex mb-2"><span>BTC, ETH, USDT Accounts&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span>Classic Membership Card<br></span></li>
                                    <li class="d-flex mb-2"><span>Quick wallet-to-wallet transfers&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span>$12 for monthly membership&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span>$3.000 Daily card load limit<br></span></li>
                                    <li class="d-flex mb-2"><span>$3.000 Daily Spent limit<br></span></li>
                                    <li class="d-flex mb-2"><span>Not Possible ATM withdrawal limit&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span>$100.000 Bank account load limit&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span>24/7 Concierge Team<br></span></li>
                                    <li class="d-flex mb-2"><span>Free transfers to other club members<br></span></li>
                                    <li class="d-flex mb-2"><span>Up to 40% off Travel&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span>Dedicated phone hotline support<br></span></li>
                                </ul> -->
                            </div><a class="btn btn-warning d-block w-100" role="button" href="#">GET {{$package->name}}</a>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div><!-- End: Pricing Clean -->
    </section>
    <section>
        <div class="espacoy" style="background: var(--bs-black);">
            <!-- Start: 1 Row 3 Columns -->
            <div class="container">
                <div class="row g-0 align-items-center">
                    <div class="col-12 col-md-4 text-center cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assets/img/imgbitcoin.png"></div>
                        <h4 class="cryptotitle">BITCOIN</h4>
                        <h5 class="cryptotitle2">BTC</h5>
                    </div>
                    <div class="col text-center mdborder2 cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assets/img/imgethereum.png"></div>
                        <h4 class="cryptotitle">ETHEREUM</h4>
                        <h5 class="cryptotitle2">ETH</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assets/img/imglitecoin.png"></div>
                        <h4 class="cryptotitle">LITECOIN</h4>
                        <h5 class="cryptotitle2">LTC</h5>
                        <hr>
                    </div>
                    <div class="col-6 col-md-4 text-center mdborder cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assets/img/imgbitcoincash.png"></div>
                        <h4 class="cryptotitle">BITCOIN CASH</h4>
                        <h5 class="cryptotitle2">BCH</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center mdborder2 mdborder cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assets/img/imgtether.png"></div>
                        <h4 class="cryptotitle">TETHER</h4>
                        <h5 class="cryptotitle2">USDT</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center mdborder cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assets/img/imgbat.png"></div>
                        <h4 class="cryptotitle">BAT</h4>
                        <h5 class="cryptotitle2">BAT</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assets/img/imgpaxos.png" width="100px"></div>
                        <h4 class="cryptotitle">PAXOS</h4>
                        <h5 class="cryptotitle2">PAX</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center mdborder2 cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assets/img/imgusdcoin.png" width="100px"></div>
                        <h4 class="cryptotitle">USD COIN</h4>
                        <h5 class="cryptotitle2">USDC</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assets/img/imgeos.png"></div>
                        <h4 class="cryptotitle">EOS</h4>
                        <h5 class="cryptotitle2">EOS</h5>
                    </div>
                </div>
            </div><!-- End: 1 Row 3 Columns -->
        </div>
    </section>
    <section>
        <div class="espacoy" style="background: var(--bs-black)">
            <!-- Start: 1 Row 3 Columns -->
            <div class="container">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-4 text-center cryptocolfix smcryptocolfix"><img src="assets/img/dolar.png" width="80px">
                        <h4 class="cryptotitle">US Dollar</h4>
                        <h5 class="cryptotitle2">USD</h5>
                    </div>
                    <div class="col-6 col-sm-6 col-md-4 text-center mdborder2 cryptocolfix smcryptocolfix"><img src="assets/img/euro.png" width="80px">
                        <h4 class="cryptotitle">EURO</h4>
                        <h5 class="cryptotitle2">EUR</h5>
                        <h1></h1>
                    </div>
                    <div class="col-6 col-sm-6 col-md-4 text-center cryptocolfix smcryptocolfix"><img src="assets/img/libra.png" width="80px">
                        <h4 class="cryptotitle">BRITISH POUND</h4>
                        <h5 class="cryptotitle2">BP</h5>
                    </div>
                    <div class="col-6 col-sm-6 col-md-4 text-center cryptocolfix mdborder3 smcryptocolfix"><img src="assets/img/yen.png" width="80px">
                        <h4 class="cryptotitle">Heading</h4>
                        <h5 class="cryptotitle2">USD</h5>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-center mdborder2 cryptocolfix mdborder3 smcryptocolfix"><img src="assets/img/yen.png" width="80px">
                        <h4 class="cryptotitle">Heading</h4>
                        <h5 class="cryptotitle2">USD</h5>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 text-center mt-sm-auto cryptocolfix mdborder3">
                        <h6 class="cryptotitle3">✓ FCA regulated</h6>
                        <h6 class="cryptotitle3">✓ Live exchange</h6>
                        <h6 class="cryptotitle3">✓ Nearly no limits*</h6>
                        <h6 class="cryptotitle3">✓ Rates 4-8% cheaper</h6>
                        <h6 class="cryptotitle3">✓ Fund via bank transfer</h6>
                        <h6 class="cryptotitle3">✓ 24/7 Customer support</h6>
                    </div>
                </div>
            </div><!-- End: 1 Row 3 Columns -->
        </div>
    </section>
    <section>
        <div>
            <!-- Start: Features Small Icons Color -->
            <div class="container border rounded border-0 p-4 p-lg-5 py-4 py-xl-5">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h2>REASONS TO JOIN</h2>
                    </div>
                </div>
                <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-briefcase text-warning iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">Quick crypto liquidation<br></h4>
                                <p class="text-black-50">Sell your crypto for traditional currencies and spend it via Infinity ClubCards card.<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-list-alt text-warning iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">100% transparent<br></h4>
                                <p class="text-black-50">No hidden margin added to our rates. One simple low rate for buy and sell.<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-bar-chart text-warning iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">4-8% better rates than banks&nbsp;<br></h4>
                                <p class="text-black-50">Traditional currency exchange rates typically 4-8% cheaper than the high street banks.<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg bs-icon-semi-white d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-binoculars text-warning iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">Discounts on travel&nbsp;<br></h4>
                                <p class="text-black-50">Save precious time and money. Use your Infinity ClubCards virtual assistant for your travel needs.<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-sun-o text-warning iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">Earn real money rewards&nbsp;<br></h4>
                                <p class="text-black-50">Refer-a-friend and earn rewards paid in real money directly into your account.<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-calendar text-warning iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">Spend 150+ currencies<br></h4>
                                <p class="text-black-50">Spend your crypto and traditional currencies anywhere with the Infinity ClubCards card**.<br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End: Features Small Icons Color -->
        </div>
    </section>
    <section>
        <div>
            <!-- Start: Banner Clean -->
            <section class="py-4 py-xl-5 bg-dark">
                <div class="container">
                    <div class="text-center p-4 p-lg-5">
                        <h1 class="fw-bold text-light mb-4">Ready to Join?!</h1>
                        <a class="btn fs-5 link-warning me-4 py-2 px-4 btnregist" type="button" href="{{ route('register') }}">Register</a>
                        <a class="btn btn-primary fs-5 text-bg-warning py-2 px-4" type="submit" style="border-style: none;" href="{{ route('login') }}">Join Now!</a>
                    </div>
                </div>
            </section><!-- End: Banner Clean -->
        </div>
    </section><!-- Start: Footer Dark -->
    <footer class="text-center bg-dark">
        <div class="espacoy">
            <!-- Start: 1 Row 1 Column -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="text-center text-white"></p>
                        <h5 class="text-start text-white mb-3">Product Features</h5>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">Buy Crypto</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">Crypto to Cash</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">Crypto to Crypto</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">Spend Crypto</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">FEES</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">24/7 Concierge Services</a></div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <p class="text-center text-white"></p>
                        <h5 class="text-start text-white mb-3">Language</h5>
                        <div class="d-flex align-items-lg-center mb-2"><img class="me-2" src="assets/img/flaguk.png" width="20px" height="20px"><a class="d-block footerlink" href="#">English</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><img class="me-2" src="assets/img/flagspa.png" width="20px" height="20px"><a class="d-block footerlink" href="#">Spanish</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><img class="me-2" src="assets/img/flagger.png" width="20px" height="20px"><a class="d-block footerlink" href="#">German</a></div>
                        <div class="d-flex align-items-lg-center"><img class="me-2" src="assets/img/flagfr.png" width="20px" height="20px"><a class="d-block footerlink" href="#">French</a></div>
                        <h5 class="text-start text-white"></h5>
                        <h5 class="text-start text-white"></h5>
                    </div>
                </div>
                <div class="row py-4 mt-5">
                    <div class="col">
                        <p class="text-center text-white-50 mb-0">Please Note</p>
                        <h1 class="text-white mb-3">DISCLAIMER</h1>
                        <p style="text-align: justify;" class="pfooter">A company is an association or collection of individuals, whether natural persons, legal persons, or a mixture of both. Company members share a common purpose and unite in order to focus their various talents and organize their collectively available skills or resources to achieve specific, declared goals. A company or association of persons can be created at law as legal person so that the company in itself can accept Limited liability for civil responsibility and taxation incurred as members perform (or fail) to discharge their duty within the publicly declared "birth certificate" or published policy. Because companies are legal persons, they also may associate and register themselves as companies – often known as a corporate group. When the company closes it may need a "death certificate" to avoid further legal&nbsp;obligations.<br><br>A company or association of persons can be created at law as legal person so that the company in itself can accept Limited liability for civil responsibility and taxation incurred as members perform (or fail) to discharge their duty within the publicly declared "birth certificate" or published policy. A company or association of persons can be created at law as legal person so that <br>the company in itself can accept Limited liability for civil responsibility and taxation incurred as members perform (or fail) to discharge their duty within the publicly declared "birth certificate" or published policy. A company or association of persons can be created at law as legal person so that the company in itself can accept Limited liability for civil responsibility and taxation incurred as members perform (or fail) to discharge their duty within the publicly declared "birth certificate" or published policy.<br></p>
                        <p class="text-muted mt-5 mb-0">Copyright © 2023 INFINITY CLUBCARDS</p>
                        <p class="text-muted">Designed by : <a href="#"><span style="color: rgb(108, 117, 125);">Tecnologia2U</span></a></p>
                    </div>
                </div>
            </div><!-- End: 1 Row 1 Column -->
        </div>
    </footer><!-- End: Footer Dark -->
    <script src="assetsWelcome/js/bootstrap.min.js"></script>
    <script src="assetsWelcome/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</body>

</html>