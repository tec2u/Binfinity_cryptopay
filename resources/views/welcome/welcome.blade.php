<!DOCTYPE html>
<html lang="en" style="font-family: Poppins, sans-serif;">

<head>
  <meta charset=" utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>AI Next Level Club</title>
  <link rel="icon" type="image/png" sizes="400x400" href="assetsWelcome/images/fivicon_tiger.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
  <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css">
  <link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="assetsWelcome/css/Navbar-Right-Links-icons.css">
  <link rel="stylesheet" href="assetsWelcome/css/Pricing-Centered-badges.css">
  <link rel="stylesheet" href="assetsWelcome/css/styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

  <style>
    .video-fundo {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: Montserrat, sans-serif !important;
    }
  </style>
</head>

<body style="overflow-x: hidden !important">
  <video autoplay loop muted class="video-fundo" style="filter: brightness(0.8);">
    <source src="images/videohome.mp4" type="video/mp4">
  </video>
  <!-- Start: Navbar Right Links -->
  <nav class="navbar navbar-light navbar-expand-lg fixed-top shadow-sm navbarstyle" data-aos="fade-down"
    data-aos-duration="1600" data-aos-delay="1800" data-aos-once="true" style="display: block;position:initial;">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}"><img
          src="/images/tigle_logo.png" style="filter: brightness(9);" width="230px"></a><button
        data-bs-toggle="collapse" class="navbar-toggler fs-6 fw-light text-white text-bg-warning shadow-lg"
        data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span
          class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navcol-2">
        <ul class="navbar-nav navbar-nav-scroll ms-auto">
          <!-- <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/cards') }}">@lang('leadpage.btn.cards')</a></li>
                    <li class="nav-item"><a class="nav-link anavlink" href="{{ url('/accounts') }}">@lang('leadpage.btn.accounts')</a></li>
                    <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/concierge') }}">@lang('leadpage.btn.concierge')</a></li> -->
        </ul>
        @if (Route::has('login'))
          @auth
            <a role="button" class="btn btn-warning ms-md-2 btnnav"
              style="border: solid 2px #0071c1; color: #ffffff; background: transparent;"
              href="{{ route('admin.home') }}">@lang('leadpage.btn.dashboard')</a>
          @else
            <a role="button" class="btn btn-warning ms-md-2 btnnav"
              style="border: solid 2px #0071c1; color: #0071c1; background: transparent;"
              href="{{ route('login') }}">@lang('leadpage.btn.login')</a>
            @if (Route::has('register'))
              <!-- <a role="button" class="btn btn-warning ms-md-2 btnnav"
                                          style="border: solid 2px #0071c1; color: #ffffff; background: #0071c1;" href="{{ route('register') }}"
                                          data-aos="zoom-in-down" data-aos-duration="1600" data-aos-delay="2200"
                                          data-aos-once="true">@lang('leadpage.btn.join')</a>-->
            @endif
          @endauth
        @endif
      </div>
    </div>
  </nav>

  <!-- End: Navbar Right Links -->
  <section style=" display:block; position:initial;" id="herosection">
    <div data-bss-scroll-zoom="true" data-bss-scroll-zoom-speed="0.5"
      style="width: 100%;height: 100%;background: linear-gradient(rgba(0,0,0,0.83), rgba(0,0,0,0.78)) center / cover no-repeat;">
      <div class="container ">
        <div class="row justify-content-center align-items-center ">
          <div
            class="col-md-10 col-lg-10 col-xl-8 d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
            <div class="text-center" style="margin: 0 auto;">
              <p data-aos="fade" data-aos-duration="1500" data-aos-delay="400" data-aos-once="true" class="phero">
                @lang('leadpage.home.txt')</p>
              <h2 class="text-uppercase fw-bold hhero hherosm" data-aos="fade-up" data-aos-duration="1400"
                data-aos-delay="800" data-aos-once="true" style="font-size: 4rem">AI NEXT LEVEL CLUB<br></h2>
              <div style="display: inlin-block; width: 100%;">
                <center>
                  <video style="width: 80%; margin-top: 50px;" src="/images/AI NEXT LEVEL OPEN english.mp4"
                    controls="controls" autoplay="false"></video>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- <section class="espacoy bg-dark">
        <div>
            Start: 1 Row 2 Columns
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <h6 class="ceo text-uppercase">@lang('leadpage.home.your')&nbsp;@lang('leadpage.home.host')&nbsp;@lang('leadpage.home.today')</h6>
                        <img class="img-fluid border rounded-circle my-2" data-aos="fade-right" data-aos-duration="2000" data-aos-once="true" src="assetsWelcome/images/ThomasEnglert.png?h=0021aac5e890c670e83cb448aee14f22" loading="auto" width="200px">
                        <h4 class="teng fw-bold">SANTIAGO ESPARZA</h4>
                        <p class="ceo">CEO &amp; FOUNDER</p>
                    </div>
                    <div class="col chost" style="border-left: 1.5px solid rgba(33,37,41,0.5);">
                        <h1 class="text-uppercase teng fw-bold" data-aos="fade-left" data-aos-duration="1300" data-aos-delay="800" data-aos-once="true">"@lang('leadpage.home.one') <br>@lang('leadpage.home.leader')"</h1>
                        <p class="phost mt-4">@lang('leadpage.home.thomas')</p>
                        <ul class="mt-4 p-0">
                            <li class="list-group-item teng mt-0"><i class="la la-chevron-circle-right"></i> @lang('leadpage.home.thomasli1')</li>
                            <li class="list-group-item teng mt-0"><i class="la la-chevron-circle-right"></i> @lang('leadpage.home.thomasli2')</li>
                            <li class="list-group-item teng mt-0"><i class="la la-chevron-circle-right"></i> @lang('leadpage.home.thomasli3')</li>
                            <li class="list-group-item teng mt-0"><i class="la la-chevron-circle-right"></i> @lang('leadpage.home.thomasli4')</li>
                            <li class="list-group-item teng mt-0"><i class="la la-chevron-circle-right"></i> @lang('leadpage.home.thomasli5')</li>
                            <li class="list-group-item teng mt-0"><i class="la la-chevron-circle-right"></i> @lang('leadpage.home.thomasli6')</li>
                        </ul>
                    </div>
                </div>
            </div><!-- End: 1 Row 2 Columns -->
  </div>
  </section>
  <!-- Start: Phone Section -->
  <!-- <section id="phone">
        <div class="special pb-5">
            <div class="container">
                <div class="col-md-12">
                    <div class="row phonemt">
                        <div class="col-md-5 col-sm-0">
                        </div>
                        <ul class="col-md-7 col-sm-12 nav nav-tabs d-flex justify-content-around" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link prof active fw-semibold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                    @lang('leadpage.home.cryptocurrency')
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link prof fw-semibold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                    @lang('leadpage.home.traditional currency')
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link prof fw-semibold" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                                    @lang('leadpage.home.concierge')
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content mt-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="row">
                                <div class="col-sm-10 col-md-5 " style="padding-top: 0px; text-align: center; vertical-align: middle;">
                                    <img src="../assetsWelcome/images/cryptocurrency_mockup_01.png" alt="..." class="img-fluid max-img">
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
                                    <img src="../assetsWelcome/images/traditional_currencies_01.png" alt="..." class="img-fluid max-img">
                                </div>
                                <div class=" col-md-7 col-sm-12">
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
                                    <img src="../assetsWelcome/images/concierge_mockup_01.png" alt="..." class="img-fluid max-img">
                                </div>
                                <div class=" col-md-7 col-sm-12">
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
    </section> -->
  <!-- End: Phone Section -->
  <!-- <section class="espacoy bg-dark">
         Start: 1 Row 2 Columns
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-center text-white-50">THE INFINITY CLUB CARD</h6>
                    <h1 class="text-center text-white fw-bold" style="margin-bottom: 32px; ">@lang('leadpage.home.onecard') <br>@lang('leadpage.home.pay')</h1>
                    <div class="d-flex align-items-center align-items-md-start align-items-xl-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center me-4 d-inline-block bs-icon xl" style="background: rgba(13,110,253,0);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" viewBox="0 0 16 16" class="bi bi-arrow-right-circle text-dark" data-aos="fade" data-aos-duration="2000" data-aos-once="true" style="color: rgb(188,188,188);">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                            </svg></div>
                        <div>
                            <h4 class="text-white" class="text-center text-white">@lang('leadpage.home.card')</h4>
                            <p class="text-white-50">@lang('leadpage.home.cardtxt') <br>@lang('leadpage.home.cardtxt2')</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center align-items-md-start align-items-xl-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary text-dark d-flex flex-shrink-0 justify-content-center align-items-center me-4 d-inline-block bs-icon xl" style="background: rgba(13,110,253,0);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" viewBox="0 0 16 16" class="bi bi-arrow-right-circle text-dark" data-aos="fade" data-aos-duration="2300" data-aos-delay="400" data-aos-once="true" style="color: rgb(188,188,188);">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                            </svg></div>
                        <div>
                            <h4 class="text-white">@lang('leadpage.home.features')</h4>
                            <p class="text-white-50">@lang('leadpage.home.featurestxt') </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center align-items-md-start align-items-xl-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center me-4 d-inline-block bs-icon xl" style="background: rgba(13,110,253,0);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" viewBox="0 0 16 16" class="bi bi-arrow-right-circle text-dark" data-aos="fade" data-aos-duration="3000" data-aos-delay="800" data-aos-once="true" style="color: rgb(188,188,188);">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                            </svg></div>
                        <div>
                            <h4 class="text-white">@lang('leadpage.home.success')</h4>
                            <p class="text-white-50">@lang('leadpage.home.successtxt') <br>@lang('leadpage.home.successtxt2')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <div class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000" data-bs-keyboard="false" id="carousel-1">
                            <div class="carousel-inner">
                                <div class="carousel-item active"><img class="w-100 d-block" src="assetsWelcome/images/carddiamondngold.png?h=12b29874753f1b481ae1d8096dcd8409" alt="Slide Image"></div>
                                <div class="carousel-item"><img class="w-100 d-block" src="assetsWelcome/images/cardclassicmember.png?h=12b29874753f1b481ae1d8096dcd8409" alt="Slide Image"></div>
                                <div class="carousel-item"><img class="w-100 d-block" src="assetsWelcome/images/cardplatinumbemer.png?h=7eb2b3bbff64205c2f47993625933a9d" alt="Slide Image"></div>
                                <div class="carousel-item"><img class="w-100 d-block" src="assetsWelcome/images/cardplatinumelitemember.png?h=2265dd8de7d13a29d921c59d102bcb06" alt="Slide Image"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
  <!-- End: 1 Row 2 Columns -->
  <!-- Start: 1 Row 2 Columns -->
  <!-- <section class="bg-dark">
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col" style="text-align: center;min-height: 400px;">
                        <div class="d-flex align-items-center divimg"><img data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" src="assetsWelcome/images/Infinityclubcardwhite.png?h=2c2da8ab6a11694abaf61a424b9cad5e" width="240px" style="margin: auto;"></div>
                    </div>
                    <div class="col-md-6" style="background: #eaeaea;padding-top: 40px;padding-bottom: 40px;">
                        <div class="row mb-5">
                            <div class="col-md-8 col-xl-6 text-center mx-auto">
                                <h6 class="text-black-50">@lang('leadpage.home.aboutcard')</h6>
                                <h2>@lang('leadpage.home.basic')</h2>
                                <p class="text-black-50 w-lg-50">@lang('leadpage.home.basictxt')</p>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                                <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #eaeaea;">
                                    <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);">
                                        <i class="la la-check text-dark iconv" data-aos="fade" data-aos-duration="1000" data-aos-delay="1000" data-aos-once="true"></i>
                                    </div>
                                    <div class="px-3">
                                        <h4>@lang('leadpage.home.debitcard')</h4>
                                        <p class="text-black-50">@lang('leadpage.home.load')<br>@lang('leadpage.home.load1')</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                                <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #eaeaea;">
                                    <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);">
                                        <i class="la la-check text-dark iconv" data-aos="fade" data-aos-duration="1000" data-aos-delay="1400" data-aos-once="true"></i>
                                    </div>
                                    <div class="px-3">
                                        <h4>@lang('leadpage.home.currencies')</h4>
                                        <p class="text-black-50">@lang('leadpage.home.currenciestxt')<br>@lang('leadpage.home.currenciestxt1')</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                                <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #eaeaea;">
                                    <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);">
                                        <i class="la la-check text-dark iconv" data-aos="fade" data-aos-duration="1000" data-aos-delay="1800" data-aos-once="true"></i>
                                    </div>
                                    <div class="px-3">
                                        <h4>ATM</h4>
                                        <p class="text-black-50">@lang('leadpage.home.atmtxt') <br>@lang('leadpage.home.atmtxt1')</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-6 text-center mx-auto">
                                <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #eaeaea;">
                                    <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);">
                                        <i class="la la-check text-dark iconv" data-aos="fade" data-aos-duration="1000" data-aos-delay="2200" data-aos-once="true"></i>
                                    </div>
                                    <div class="px-3">
                                        <h4>@lang('leadpage.home.levels')</h4>
                                        <p class="text-black-50">@lang('leadpage.home.levelstxt') <br>@lang('leadpage.home.levelstxt1')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
  <!-- End: 1 Row 2 Columns -->
  <!-- <section class="espacoy">
        Start: 2 Rows 1+3 Columns
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h6 class="text-black-50">@lang('leadpage.home.write')</h6>
                    <h1 class="fw-bold">@lang('leadpage.home.club')</h1>
                    <p class="text-black-50">@lang('leadpage.home.clubtxt')<br>@lang('leadpage.home.clubtxt1')</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="text-center d-flex flex-column align-items-center align-items-xl-center mb-4">
                        <div class="bs-icon-xl bs-icon-rounded d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="la la-compass text-dark iconv" style="color: rgb(204,204,204);"></i></div>
                        <div class="px-3">
                            <h4>@lang('leadpage.home.travelling')</h4>
                            <p class="text-black-50">@lang('leadpage.home.travellingtxt') <br>@lang('leadpage.home.travellingtxt1')</p>
                        </div>
                    </div>
                    <div class="text-center d-flex flex-column align-items-center align-items-xl-center mb-4">
                        <div class="bs-icon-xl bs-icon-rounded d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="la la-credit-card text-dark iconv" style="color: #adadad;"></i></div>
                        <div class="px-3">
                            <h4>@lang('leadpage.home.business')</h4>
                            <p class="text-black-50">@lang('leadpage.home.businesstxt')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="overflow: hidden;">
                    <div style="overflow: hidden;"><img class="img-fluid" src="assetsWelcome/images/cardplatinumelitemember.png?h=2265dd8de7d13a29d921c59d102bcb06"></div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="text-center d-flex flex-column align-items-center align-items-xl-center mb-4">
                        <div class="bs-icon-xl d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="la la-diamond text-dark iconv" style="color: #adadad;"></i></div>
                        <div class="px-3">
                            <h4>@lang('leadpage.home.shopping')</h4>
                            <p class="text-black-50">@lang('leadpage.home.shoppingtxt') <br>@lang('leadpage.home.shoppingtxt1')</p>
                        </div>
                    </div>
                    <div class="text-center d-flex flex-column align-items-center align-items-xl-center mb-4">
                        <div class="bs-icon-xl d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="la la-bitcoin text-dark iconv" style="color: #adadad;"></i></div>
                        <div class="px-3">
                            <h4>@lang('leadpage.home.investment')</h4>
                            <p class="text-black-50">@lang('leadpage.home.investmenttxt')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> End: 2 Rows 1+3 Columns
    </section> -->
  <!-- <section style="background: var(--bs-black);">
        Start: 1 Row 2 Columns
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto col-md-6" style="padding-right: 0;padding-left: 0;background: #25292F;">
                    <div style="width: 100%;overflow: hidden;"></div><img class="marginminus" src="assetsWelcome/images/imgcrypyowallet.png?h=925c358a8c09f4b3a689ca1cd6266cdd" width="1000px">
                </div>
                <div class="col-md-6" style="background: #eaeaea;padding-top: 40px;padding-bottom: 40px;">
                    <div class="row mb-5">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <h6 class="text-black-50">@lang('leadpage.home.aboutcard')</h6>
                            <h2 class="fw-bold">@lang('leadpage.home.basic')</h2>
                            <p class=" text-black-50 w-lg-50">@lang('leadpage.home.basictxt')</p>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-6 col-md-6 col-xl-6 text-center mx-auto" style="background: #eaeaea;">
                            <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #eaeaea;">
                                <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3"><i class="la la-check text-dark iconv" data-aos="fade" data-aos-duration="1000" data-aos-delay="1000" data-aos-once="true"></i></div>
                                <div class="px-3">
                                    <h4>@lang('leadpage.home.debitcard')</h4>
                                    <p class="text-black-50">@lang('leadpage.home.load')<br>@lang('leadpage.home.load1')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-xl-6 text-center mx-auto" style="background: #eaeaea;">
                            <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #eaeaea;">
                                <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check text-dark iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="1400" data-aos-once="true"></i></div>
                                <div class="px-3">
                                    <h4>@lang('leadpage.home.currencies')</h4>
                                    <p class="text-black-50">@lang('leadpage.home.currenciestxt')<br>@lang('leadpage.home.currenciestxt1')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-xl-6 text-center mx-auto" style="background: #eaeaea;">
                            <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #eaeaea;">
                                <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check text-dark iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="1800" data-aos-once="true"></i></div>
                                <div class="px-3">
                                    <h4>ATM</h4>
                                    <p class="text-black-50">@lang('leadpage.home.atmtxt') <br>@lang('leadpage.home.atmtxt1')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-xl-6 text-center mx-auto" style="background: #eaeaea;">
                            <div class="text-center d-flex flex-column align-items-center align-items-xl-center" style="background: #eaeaea;">
                                <div class="d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3" style="color: rgb(139,139,139);"><i class="la la-check text-dark iconv" data-aos="fade" data-aos-duration="600" data-aos-delay="2200" data-aos-once="true"></i></div>
                                <div class="px-3">
                                    <h4>@lang('leadpage.home.levels')</h4>
                                    <p class="text-black-50">@lang('leadpage.home.levelstxt') <br>@lang('leadpage.home.levelstxt1')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> End: 1 Row 2 Columns
    </section> -->
  <!-- <section>
        Start: Pricing Clean
        <div class="container py-4 py-xl-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold">@lang('leadpage.home.pricingtable')</h2>
                </div>
            </div>
            <div class=" row gx-3 gy-3 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
                @forelse ($packages as $package)
<div class="col-md-6 col-lg-3">
                    <div class="card  shad" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div>
                                <h5 class="text-uppercase text-muted">{{ $package->name }}</h5>
                                <h6 class="fw-bold">@lang('leadpage.home.fee')</h6>
                                <h1 class="display-5 fw-bold">${{ number_format($package->price, 0) }}</h1>
                                <hr>
                                {!! $package->long_description !!}
                                 <ul class="list-unstyled">
                                    <li class="d-flex mb-2"><span> <i class="la la-chevron-circle-right"></i>&nbsp; Fiat Multi-Currency Account&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Crypto Multi-Currency Account&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; USD, EUR, GBP, CNY, JPY Accounts<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; BTC, ETH, USDT Accounts&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Classic Membership Card<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Quick wallet-to-wallet transfers&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; $12 for monthly membership&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; $3.000 Daily card load limit<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; $3.000 Daily Spent limit<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Not Possible ATM withdrawal limit&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; $100.000 Bank account load limit&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; 24/7 Concierge Team<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Free transfers to other club members<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Up to 40% off Travel&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Dedicated phone hotline support<br></span></li>
                                </ul>
                            </div><a class="btn btn-dark d-block w-100" role="button" href="{{ route('register') }}">GET {{ $package->name }}</a>
                        </div>
                    </div>
                </div>
@empty
@endforelse
            </div>
        </div>End: Pricing Clean
    </section> -->
  <!-- <section>
        <div class="espacoy" style="background: var(--bs-black);">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h1 class="text-white fw-bold">@lang('leadpage.home.cryptocurrency')</h1>
                </div>
            </div> Start: 1 Row 3 Columns
            <div class="container">
                <div class="row g-0 align-items-center">
                    <div class="col-12 col-md-4 text-center cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assetsWelcome/images/imgbitcoin.png"></div>
                        <h4 class="cryptotitle">BITCOIN</h4>
                        <h5 class="cryptotitle2">BTC</h5>
                    </div>
                    <div class="col text-center mdborder2 cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assetsWelcome/images/imgethereum.png?h=f5f1f9f7965df8c4e4e57c348a382f7c"></div>
                        <h4 class="cryptotitle">ETHEREUM</h4>
                        <h5 class="cryptotitle2">ETH</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assetsWelcome/images/imglitecoin.png?h=b89842538357e06a717bea218bdf2ba4"></div>
                        <h4 class="cryptotitle">LITECOIN</h4>
                        <h5 class="cryptotitle2">LTC</h5>
                        <hr>
                    </div>
                    <div class="col-6 col-md-4 text-center mdborder cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assetsWelcome/images/imgbitcoincash.png?h=c0a0cec49764fb3ec72f631c43b9c00f"></div>
                        <h4 class="cryptotitle">BITCOIN CASH</h4>
                        <h5 class="cryptotitle2">BCH</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center mdborder2 mdborder cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assetsWelcome/images/imgtether.png?h=ba8664190b4e52a44443d0ae0757eb98"></div>
                        <h4 class="cryptotitle">TETHER</h4>
                        <h5 class="cryptotitle2">USDT</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center mdborder cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assetsWelcome/images/imgbat.png?h=3aaaf9284912391267dacca774fbef77"></div>
                        <h4 class="cryptotitle">BAT</h4>
                        <h5 class="cryptotitle2">BAT</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assetsWelcome/images/imgpaxos.png?h=ba8664190b4e52a44443d0ae0757eb98" width="100px"></div>
                        <h4 class="cryptotitle">PAXOS</h4>
                        <h5 class="cryptotitle2">PAX</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center mdborder2 cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assetsWelcome/images/imgusdcoin.png?h=5aec0b0085d2a5ace36a76d94ec981a5" width="100px"></div>
                        <h4 class="cryptotitle">USD COIN</h4>
                        <h5 class="cryptotitle2">USDC</h5>
                    </div>
                    <div class="col-6 col-md-4 text-center cryptocolfix smcryptocolfix">
                        <div class="cryptoicondiv"><img src="assetsWelcome/images/imgeos.png?h=0f74948ab93b7f6ceb0368ac9f809ebe"></div>
                        <h4 class="cryptotitle">EOS</h4>
                        <h5 class="cryptotitle2">EOS</h5>
                    </div>
                </div>
            </div> End: 1 Row 3 Columns
        </div>
    </section>  -->
  <!-- <section>
        <div class="espacoy" style="background: var(--bs-black)">
             Start: 1 Row 3 Columns
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h1 class="text-white fw-bold">@lang('leadpage.home.fiatcurrency')</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-4 text-center cryptocolfix smcryptocolfix"><img src="assetsWelcome/images/dolar.png?h=8051cf1a6d4865f517fba7d774233d4c" width="80px">
                        <h4 class="cryptotitle mt-3">US Dollar</h4>
                        <h5 class="cryptotitle2">USD</h5>
                    </div>
                    <div class="col-6 col-sm-6 col-md-4 text-center mdborder2 cryptocolfix smcryptocolfix"><img src="assetsWelcome/images/euro.png?h=1a5b568743c08ff130a7ada682035523" width="80px">
                        <h4 class="cryptotitle mt-3">EURO</h4>
                        <h5 class="cryptotitle2">EUR</h5>
                        <h1></h1>
                    </div>
                    <div class="col-6 col-sm-6 col-md-4 text-center cryptocolfix smcryptocolfix"><img src="assetsWelcome/images/libra.png?h=1a5b568743c08ff130a7ada682035523" width="80px">
                        <h4 class="cryptotitle mt-3">BRITISH POUND</h4>
                        <h5 class="cryptotitle2">GBP</h5>
                    </div>
                    <div class="col-6 col-sm-6 col-md-4 text-center cryptocolfix mdborder3 smcryptocolfix"><img src="assetsWelcome/images/yen.png?h=9b8e7291c162da2f39bd953409408561" width="80px">
                        <h4 class="cryptotitle mt-3">YEN</h4>
                        <h5 class="cryptotitle2">JPY</h5>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-center mdborder2 cryptocolfix mdborder3 smcryptocolfix"><img src="assetsWelcome/images/yuan.png?h=9b8e7291c162da2f39bd953409408561" width="80px">
                        <h4 class="cryptotitle mt-3">YUAN</h4>
                        <h5 class="cryptotitle2">CNY</h5>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 text-center mt-sm-auto cryptocolfix mdborder3">
                        <h6 class="cryptotitle3">✓ @lang('leadpage.home.fca')</h6>
                        <h6 class="cryptotitle3">✓ @lang('leadpage.home.live')</h6>
                        <h6 class="cryptotitle3">✓ @lang('leadpage.home.nearly')</h6>
                        <h6 class="cryptotitle3">✓ @lang('leadpage.home.rates')</h6>
                        <h6 class="cryptotitle3">✓ @lang('leadpage.home.fund')</h6>
                        <h6 class="cryptotitle3">✓ @lang('leadpage.home.customer')</h6>
                    </div>
                </div>
            </div> End: 1 Row 3 Columns
        </div>
    </section> -->
  <!-- <section>
        <div>
             Start: Features Small Icons Color
            <div class="container border rounded border-0 p-4 p-lg-5 py-4 py-xl-5">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h2 class="fw-bold">@lang('leadpage.home.reasons')</h2>
                    </div>
                </div>
                <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-briefcase text-dark iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">@lang('leadpage.home.quick')<br></h4>
                                <p class="text-black-50">@lang('leadpage.home.quicktxt')<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-list-alt text-dark iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">@lang('leadpage.home.transparent')<br></h4>
                                <p class="text-black-50">@lang('leadpage.home.transparenttxt')<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-bar-chart text-dark iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">@lang('leadpage.home.better')&nbsp;<br></h4>
                                <p class="text-black-50">@lang('leadpage.home.bettertxt')<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg bs-icon-semi-white d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-binoculars text-dark iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">@lang('leadpage.home.discounts')&nbsp;<br></h4>
                                <p class="text-black-50">@lang('leadpage.home.discountstxt')<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-sun-o text-dark iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">@lang('leadpage.home.earn')&nbsp;<br></h4>
                                <p class="text-black-50">@lang('leadpage.home.earntxt')<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="bs-icon-lg d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="la la-calendar text-dark iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i></div>
                            <div class="px-3">
                                <h4 class="text-dark">@lang('leadpage.home.spend')<br></h4>
                                <p class="text-black-50">@lang('leadpage.home.spendtxt')<br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> End: Features Small Icons Color
        </div>
    </section> -->
  <section style="display: none;">
    <div>
      <!-- Start: Banner Clean -->
      <section class="bg-dark">
        <div class="container spacey">
          <div class="text-center p-4 p-lg-5">
            <h1 class="fw-bold text-light mb-2">@lang('leadpage.footer.ready')</h1>
            <!-- <a role="button" class="btn fs-5 link-light me-4 py-2 px-4 btnregist" href="{{ route('login') }}">@lang('leadpage.btn.login')</a>
                        <a role="button" class="btn btn-primary fs-5 text-bg-light py-2 px-4" href="{{ route('register') }}" data-aos="fade" data-aos-duration="1500" data-aos-delay="600" data-aos-once="true">@lang('leadpage.btn.join')</a> -->
            <!--
                        <button class="btn fs-5 link-light me-4 py-2 px-4 btnregist" type="button">REGISTER</button>
                        <button class="btn btn-primary fs-5 text-bg-light py-2 px-4" type="submit" style="border-style: none;">JOIN NOW!</button>
                        -->
          </div>
        </div>
      </section><!-- End: Banner Clean -->
    </div>
  </section>
  <!-- Start: Footer Dark -->
  <footer class="text-center bg-dark" style="display: none;">
    <div class="espacoy">
      <!-- Start: 1 Row 1 Column -->
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="text-center text-white"></p>
            <h5 class="text-start text-white mb-3">@lang('leadpage.footer.product')</h5>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#modal-1"
                data-bs-target="#modal-1" data-bs-toggle="modal">Coming Soon</a></div>
            <!-- <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#modal-2" data-bs-target="#modal-2" data-bs-toggle="modal">Coming Soon</a></div> -->
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#"
                data-bs-target="" data-bs-toggle="">Coming Soon</a></div>
            <!-- <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#modal-4" data-bs-target="#modal-4" data-bs-toggle="modal">@lang('leadpage.footer.productbtn.txt_footer4')</a></div> -->
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#"
                data-bs-target="" data-bs-toggle="">Coming Soon</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#"
                data-bs-target="" data-bs-toggle="">Coming Soon</a></div>
          </div>
          <div class="col-md-3 ">
            <p class="text-center text-white"></p>
            <h5 class="text-start text-white mb-3">@lang('leadpage.btn.language')</h5>
            <div class="d-flex align-items-lg-center mb-2"><img class="me-2"
                src="assetsWelcome/images/flaguk.png?h=0c7390cbfbfc9edfeaa340414b8fcccf" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/en">@lang('leadpage.btn.english')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><img class="me-2"
                src="assetsWelcome/images/flagspa.png?h=82b1ec4cf037271f6fac3cb3a83072e5" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/es">@lang('leadpage.btn.spanish')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><img class="me-2"
                src="assetsWelcome/images/flagger.png?h=4e906449aca319bcf7fed73fb806e14f" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/de">@lang('leadpage.btn.german')</a></div>
            <div class="d-flex align-items-lg-center"><img class="me-2"
                src="assetsWelcome/images/flagfr.png?h=af5123cb6532b4278a2cdb445e0a130f" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/fr">@lang('leadpage.btn.french')</a></div>
            <h5 class="text-start text-white"></h5>
            <h5 class="text-start text-white"></h5>
          </div>
          <div class=" col-md-3 text-center d-flex justify-content-center align-items-center">
            <ul class="list-inline d-lg-flex align-items-lg-end margintopsm">
              <li class="list-inline-item me-4"><a href="#" class="footerlink"><i
                    class="lab la-telegram iconwid"></i></a></li>
              <li class="list-inline-item me-4"><a href="#" class="footerlink"><i
                    class="la la-instagram iconwid"></i></a></li>
              <li class="list-inline-item me-4"><a href="#" class="footerlink"><i
                    class="la la-facebook iconwid"></i></a></li>
              <li class="list-inline-item me-4"><a href="#" class="footerlink"><i
                    class="la la-twitter iconwid"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="row pt-4 mt-5">
          <div class="col">
            <p class="text-center text-white-50 mb-0">@lang('leadpage.footer.please')</p>
            <h1 class="text-white mb-3 fw-bold">@lang('leadpage.footer.disclaimer')</h1>
            <p style="text-align: justify;" class="pfooter">@lang('leadpage.footer.footertxt')<br></p>
            <p class="text-muted mt-5 mb-0">@lang('leadpage.footer.copyright') TIGER INVESTMENTS</p>
          </div>
        </div>
      </div>
      <!-- End: 1 Row 1 Column -->
    </div>
  </footer>
  <!-- End: Footer Dark -->
  <!-- Start: Modais -->
  <section>
    <div style="overflow-x: hidden !important">
      <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
          <div class="modal-content">
            <div class="modal-header text-white-50 bg-dark">
              <h3 class="modal-title">
                <span style="color: rgb(150, 150, 150);">
                  Coming Soon
                </span>
              </h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bgmodal">
              <div class="col-md-12 text-center mb-5">
                <!-- <h1>@lang('leadpage.accounts.freedom.title')</h1>
                                <p class="text-black-50 plimit mb-4">
                                    @lang('leadpage.accounts.freedom.text')<br />
                                </p> -->
              </div>
              <div class="col-md-12 text-center">
                <!-- <h2 class="mb-3">@lang('leadpage.accounts.cryptocurrencies')<br /></h2>
                                <ul class="list-unstyled text-start px-5 my-5">
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies1')<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies2')&nbsp;<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies3')&nbsp;<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies4')&nbsp;<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies5')<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies6')<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies7')<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies8')&nbsp;<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies9')<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies10')&nbsp;<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies11')&nbsp;<br />
                                    </li>
                                    <li class="text-black-50 mb-1">
                                        <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies12')<br />
                                    </li>
                                </ul>
                                <a class="btn btn-dark d-block orderbtn mt-5" role="button" href="{{ route('register') }}">@lang('leadpage.accounts.freedom.btn')</a>
                            </div> -->
              </div>
              <div class="modal-footer text-white-50 bg-dark">
                <button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-2">
          <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
            <div class="modal-content">
              <div class="modal-header text-white-50 bg-dark">
                <h3 class="modal-title">
                  <span style="color: rgb(150, 150, 150);">
                    Coming Soon
                  </span>
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body bgmodal">
                <div class="col-md-12 text-center mb-5">
                  <h1>@lang('leadpage.accounts.freedom.title')</h1>
                  <p class="text-black-50 plimit mb-4">
                    @lang('leadpage.accounts.freedom.text')<br />
                  </p>
                </div>
                <div class="col-md-12 text-center">
                  <h2 class="mb-3">@lang('leadpage.accounts.traditional')<br /></h2>
                  <ul class="list-unstyled text-start px-5 my-5">
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional1')<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional2')<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional3')<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional4')<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional5')<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional6')&nbsp;<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional7')&nbsp;<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional8')<br />
                    </li>
                    <li class="fs-6 text-black-50 mb-1 mt-4">
                      @lang('leadpage.accounts.traditional9')<br />
                    </li>
                  </ul>
                  <a class="btn btn-dark d-block orderbtn mt-5" role="button"
                    href="{{ route('register') }}">@lang('leadpage.accounts.freedom.btn')</a>
                </div>
              </div>
              <div class="modal-footer text-white-50 bg-dark">
                <button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="modal fade" role="dialog" tabindex="-1" id="modal-3">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white-50 bg-dark">
                            <h4 class="modal-title">Crypto to Crypto</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Aguardando conteudo</p>
                        </div>
                        <div class="modal-footer text-white-50 bg-dark"><button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div> -->
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-4">
          <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
            <div class="modal-content">
              <div class="modal-header text-white-50 bg-dark">
                <h4 class="modal-title">Spend Crypto</h4><button type="button" class="btn-close"
                  data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body bgmodal">
                <div class="col-md-12 text-center mb-5">
                  <h1>PAY YOUR WAY, IN STYLE</h1>
                  <p class="text-black-50 plimit mb-4">
                    A card that allows you to spend digital and traditional currencies seamlessly anywhere in the world.
                    Spend 150+ currencies at millions of retailers and service providers, in store or online.<br />
                  </p>
                </div>
                <div class="col-md-12 text-center">
                  <h2 class=""> @lang('leadpage.card.flexible')<br /><br /></h2>
                  <ul class="list-unstyled text-start px-5 mb-5">
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible1')<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible2')&nbsp;<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible3')<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible4')&nbsp;<br />
                    </li>
                  </ul>
                  <!-- <a class="btn btn-dark d-block orderbtn mt-5" role="button" href="#">@lang('leadpage.card.cards.btn')</a> -->
                </div>
                <div class="col-md-12 text-center">
                  <h2 class="mb-3"> @lang('leadpage.card.payment')<br /></h2>
                  <ul class="list-unstyled text-start px-5 my-5">
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment1')<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment2')&nbsp;<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment3')<br />
                    </li>
                    <li class="text-black-50 mb-1">
                      <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment4')<br />
                    </li>
                  </ul>
                  <a class="btn btn-dark d-block orderbtn mt-5" role="button"
                    href="{{ route('register') }}">@lang('leadpage.accounts.freedom.btn')</a>
                </div>
              </div>
              <div class="modal-footer text-white-50 bg-dark"><button class="btn btn-warning w-25" type="button"
                  data-bs-dismiss="modal">Close</button></div>
            </div>
          </div>
        </div>
        <!-- <div class="modal fade" role="dialog" tabindex="-1" id="modal-5">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white-50 bg-dark">
                            <h4 class="modal-title">FEES</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Aguardando conteudo</p>
                        </div>
                        <div class="modal-footer text-white-50 bg-dark"><button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" role="dialog" tabindex="-1" id="modal-6">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white-50 bg-dark">
                            <h4 class="modal-title">24/7 Concierge Services</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Aguardando conteudo</p>
                        </div>
                        <div class="modal-footer text-white-50 bg-dark"><button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div> -->
      </div>
  </section>
  <!-- End: Modais -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/bs-init.js?h=db5f9301c4983e5b4f628e197406cbdd"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</body>

</html>
