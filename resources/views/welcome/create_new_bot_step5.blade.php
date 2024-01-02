<!DOCTYPE html>
<html lang="en" style="font-family: Poppins, sans-serif">

<head>
  <meta charset=" utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>AI Next Level</title>
  <link rel="icon" type="image/png" sizes="400x400" href="assetsWelcome/images/fivicon_tiger.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
  <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css">
  <link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="../../assetsWelcome/css/Navbar-Right-Links-icons.css">
  <link rel="stylesheet" href="../../assetsWelcome/css/Pricing-Centered-badges.css">
  <link rel="stylesheet" href="../../assetsWelcome/css/styles.css">
</head>

<body style="overflow-x: hidden;">
  <!-- Start: Navbar Right Links -->
  <nav class="navbar navbar-light navbar-expand-lg fixed-top shadow-sm navbarstyle">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}"><img
          src="/images/tigle_logo.png" width="230px" style="filter: brightness(9);"></a><button
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
            <a role="button" class="btn link-warning ms-md-2 btnnavlog"
              href="{{ route('admin.home') }}">@lang('leadpage.btn.dashboard')</a>
          @else
            <a role="button" class="btn link-warning ms-md-2 btnnavlog" href="{{ route('login') }}">@lang('leadpage.btn.login')</a>
          @endauth
        @endif
      </div>
    </div>
  </nav>
  <!-- End: Navbar Right Links -->
  <section id="herosection" style="backdrop-filter: blur(20px);filter: brightness(120%) grayscale(0%) saturate(120%); ">
    <div data-bss-scroll-zoom="true" data-bss-scroll-zoom-speed="0.5"
      style="width: 100%; height: 110vh;
                    background: linear-gradient( rgba(0, 0, 0, 0.83), rgba(0, 0, 0, 0.78)),
                        url('../../assetsWelcome/images/heroimg.png?h=19923c9d1c5b6e5752b86d1ffaf52718') center / cover no-repeat;">
      <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div
            class="col-12 d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
            <div class="text-center" style="margin: 0 auto;">
              <!-- texto com efeito fade <div class="mt-3">
                                <p class="pheroland" data-aos="fade" data-aos-duration="1500" data-aos-delay="400" data-aos-once="true">@lang('leadpage.home.landpagetxt')</p>
                                <h3 class=" hheroland fw-bold" data-aos="fade-up" data-aos-duration="1400" data-aos-delay="800" data-aos-once="true">@lang('leadpage.home.landpageh')</h3>
                            </div> -->
              <div class="mt-3">
                <p class="pheroland">EXPAND YOUR CRYPTO EASILY WITH AI NEXT LEVEL</p>
                <h3 class=" hheroland fw-bold">@lang('leadpage.home.landpageh')</h3>
              </div>

              <div class="my-5">
                <div class="w-100">
                  {{-- @include('flash::message') --}}
                  <div style="background: white; border-radius:5px; width: 400px; margin: 0 auto">
                    <div
                      style="background: #388A64; border-radius:5px; padding:1rem; display:flex; flex-direction: column; gap: 1rem; align-items:center;">
                      <img width="100px" src="https://cdn-icons-png.flaticon.com/512/148/148767.png" alt="">
                      <span style="color: white">Success</span>
                    </div>
                    <div>
                      <span>@include('flash::message')</span>
                    </div>
                  </div>
                </div>
                <a role="button" class="btn link-warning ms-md-2 btnnavlog"
                  href="{{ route('admin.home') }}">@lang('leadpage.btn.dashboard')</a>
              </div>

              <!-- @if (isset($login))
<a href="https://register.infinityclubcards.com/{{ $login }}"><button class="btn btn-warning ms-md-2 btnnav">@lang('leadpage.btn.join')</button></a>
@else
<a href="{{ route('register') }}"><button class="btn btn-warning ms-md-2 btnnav">@lang('leadpage.btn.join')</button></a>
@endif -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div>
      <!-- Start: Banner Clean -->
      <section class="bg-dark">
        <div class="container">
          <div class="text-center p-4 p-lg-5">
            <h1 class="fw-bold text-light mb-4">@lang('leadpage.footer.ready')</h1>
            <!-- <a role="button" class="btn fs-5 link-light me-4 py-2 px-4 btnregist" href="{{ route('login') }}">@lang('leadpage.btn.login')</a> -->
            <!--botao join com efeito fade <a role="button" class="btn btn-primary fs-5 text-bg-light py-2 px-4" href="{{ route('register') }}" data-aos="fade" data-aos-duration="1500" data-aos-delay="600" data-aos-once="true">@lang('leadpage.btn.join')</a> -->
            @if (isset($login))
              <a role="button" class="btn btn-primary fs-5 text-bg-light py-2 px-4"
                href="https://register.infinityclubcards.com/{{ $login }}">@lang('leadpage.btn.join')</a>
            @else
              <a role="button" class="btn btn-primary fs-5 text-bg-light py-2 px-4"
                href="{{ route('register') }}">@lang('leadpage.btn.join')</a>
            @endif

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
  <footer class="text-center bg-dark">
    <div class="espacoy">
      <!-- Start: 1 Row 1 Column -->
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="text-center text-white"></p>
            <h5 class="text-start text-white mb-3">@lang('leadpage.footer.product')</h5>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#modal-1"
                data-bs-target="#modal-1" data-bs-toggle="modal">@lang('leadpage.footer.productbtn.txt_footer2')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#modal-2"
                data-bs-target="#modal-2" data-bs-toggle="modal">@lang('leadpage.footer.productbtn.txt_footer1')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink"
                href=" {{ url('/accounts') }}" data-bs-target="" data-bs-toggle="">@lang('leadpage.footer.productbtn.txt_footer3')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#modal-4"
                data-bs-target="#modal-4" data-bs-toggle="modal">@lang('leadpage.footer.productbtn.txt_footer4')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="{{ url('/fees') }}"
                data-bs-target="" data-bs-toggle="">@lang('leadpage.footer.productbtn.txt_footer6')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink"
                href="{{ url('/concierge') }}" data-bs-target="" data-bs-toggle="">@lang('leadpage.footer.productbtn.txt_footer5')</a></div>
          </div>
          <div class="col-md-3 ">
            <p class="text-center text-white"></p>
            <h5 class="text-start text-white mb-3">@lang('leadpage.btn.language')</h5>
            <div class="d-flex align-items-lg-center mb-2"><img class="me-2"
                src="../../assetsWelcome/images/flaguk.png?h=0c7390cbfbfc9edfeaa340414b8fcccf" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/en">@lang('leadpage.btn.english')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><img class="me-2"
                src="../../assetsWelcome/images/flagspa.png?h=82b1ec4cf037271f6fac3cb3a83072e5" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/es">@lang('leadpage.btn.spanish')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><img class="me-2"
                src="../../assetsWelcome/images/flagger.png?h=4e906449aca319bcf7fed73fb806e14f" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/de">@lang('leadpage.btn.german')</a></div>
            <div class="d-flex align-items-lg-center"><img class="me-2"
                src="../../assetsWelcome/images/flagfr.png?h=af5123cb6532b4278a2cdb445e0a130f" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/fr">@lang('leadpage.btn.french')</a></div>
            <h5 class="text-start text-white"></h5>
            <h5 class="text-start text-white"></h5>
          </div>
          <div class=" col-md-3 text-center d-flex justify-content-center align-items-center">
            <ul class="list-inline d-lg-flex align-items-lg-end margintopsm">
              <li class="list-inline-item me-4"><a href="https://t.me/+drM85fbPywtkNDQ0" class="footerlink"><i
                    class="lab la-telegram iconwid"></i></a></li>
              <li class="list-inline-item me-4"><a href="https://www.instagram.com/Infinityclubcards_official/"
                  class="footerlink"><i class="la la-instagram iconwid"></i></a></li>
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
            <p class="text-muted mt-5 mb-0">@lang('leadpage.footer.copyright') AI NEXT LEVEL</p>
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
                  Buy Crypto
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
                <h2 class="mb-3">@lang('leadpage.accounts.cryptocurrencies')<br /></h2>
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
      <div class="modal fade" role="dialog" tabindex="-1" id="modal-2">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
          <div class="modal-content">
            <div class="modal-header text-white-50 bg-dark">
              <h3 class="modal-title">
                <span style="color: rgb(150, 150, 150);">
                  Crypto to Cash
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
                  href="{{ route('register') }}">@lang('leadpage.card.cards.btn')</a>
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
  <script>
    $(window).load(function() {
      $('#flash-overlay-modal').modal('show');
    });
  </script>
  <script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  </script>
</body>

</html>
