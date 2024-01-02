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

<style>
  #hidden_div1 {
    display: none;
  }

  #hidden_div2 {
    display: none;
  }

  #hidden_div3 {
    display: none;
  }
</style>

<body style="overflow-x: hidden;">
  <!-- Start: Navbar Right Links -->
  <nav class="navbar navbar-light navbar-expand-lg fixed-top shadow-sm navbarstyle">
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
            <a role="button" class="btn link-warning ms-md-2 btnnavlog"
              href="{{ route('admin.home') }}">@lang('leadpage.btn.dashboard')</a>
          @else
            <a role="button" class="btn link-warning ms-md-2 btnnavlog" href="{{ route('login') }}">@lang('leadpage.btn.login')</a>
            @if (Route::has('register'))
              @if (isset($login))
                <a role="button" class="btn btn-warning ms-md-2 btnnav"
                  href="https://register.infinityclubcards.com/{{ $login }}">@lang('leadpage.btn.join')</a>
              @else
                <a role="button" class="btn btn-warning ms-md-2 btnnav"
                  href="{{ route('register') }}">@lang('leadpage.btn.join')</a>
              @endif

              <!-- botao join com efeito fade <a role="button" class="btn btn-warning ms-md-2 btnnav" href="{{ route('register') }}" data-aos="zoom-in-down" data-aos-duration="1600" data-aos-delay="1800" data-aos-once="true">@lang('leadpage.btn.join')</a> -->
            @endif
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
            <div class="text-center" style="margin: 0 auto;margin-top: 151px;">
              <!-- texto com efeito fade <div class="mt-3">
                                <p class="pheroland" data-aos="fade" data-aos-duration="1500" data-aos-delay="400" data-aos-once="true">@lang('leadpage.home.landpagetxt')</p>
                                <h3 class=" hheroland fw-bold" data-aos="fade-up" data-aos-duration="1400" data-aos-delay="800" data-aos-once="true">@lang('leadpage.home.landpageh')</h3>
                            </div> -->
              <div class="mt-3">
                <p class="pheroland">THIS TUTORIAL IS TO HELP YOU SET UP YOUR FIRST BOT</p>
                <h3 class=" hheroland fw-bold">STEP 4 - EXCHANGE ACCOUNT FUNDING</h3>
                <p class=" pheroland ">FUNDING </h3>
                  </br></br></br>
                <form action="{{ route('step.post.5') }}" method="post">
                  @csrf
                  <input type="hidden" name="id_package" value="{{ $data['id_package'] }}">
                  <button class="btn btn-warning ms-md-2 btnnav" type="submit">STEP 5</button>
                </form>
                <br><br>
                <select id="test" name="form_select" onchange="showDiv('hidden_div', this)">
                  <option value="0">Select</option>
                  <option value="1">Blueberry Markets</option>
                  <option value="2">Vantage Markets</option>
                  <option value="3">Exness Markets</option>
                </select>

              </div>

              <div class="my-5" id="hidden_div1">
                <div class="w-100">
                  <iframe class="video" src=https://www.youtube.com/embed/TebbLzfSUaY frameborder="0"
                    allow="accelerometer; encrypted-media; gyroscope;" allowfullscreen
                    style='max-width:600px'></iframe>
                </div>
                <a href="/"><button class="btn btn-warning ms-md-2 btnnav">DOWNLOAD/VIEW PDF VERSION OF STEP BY
                    STEP</button></a>
              </div>
              <div class="my-5" id="hidden_div2">
                <div class="w-100">
                  <iframe class="video" src=https://www.youtube.com/embed/PkhhVq83y9U frameborder="0"
                    allow="accelerometer; encrypted-media; gyroscope;" allowfullscreen
                    style='max-width:600px'></iframe>
                </div>
                <a href="/"><button class="btn btn-warning ms-md-2 btnnav">DOWNLOAD/VIEW PDF VERSION OF STEP BY
                    STEP</button></a>
              </div>
              <div class="my-5" id="hidden_div3">
                <div class="w-100">
                  <iframe class="video" src=https://www.youtube.com/embed/vAG3onoLe2U frameborder="0"
                    allow="accelerometer; encrypted-media; gyroscope;" allowfullscreen
                    style='max-width:600px'></iframe>
                </div>
                <a href="/"><button class="btn btn-warning ms-md-2 btnnav">DOWNLOAD/VIEW PDF VERSION OF STEP BY
                    STEP</button></a>
              </div>

              </br></br></br></br></br></br>

              {{-- <a href="/create_new_bot_step3"><button class="btn btn-warning ms-md-2 btnnav">STEP 3</button></a> --}}

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

  <!-- End: Modais -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/bs-init.js?h=db5f9301c4983e5b4f628e197406cbdd"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    function showDiv(divId, element) {
      if (element.value == 0) {
        document.getElementById('hidden_div1').style.display = 'none';
        document.getElementById('hidden_div2').style.display = 'none';
        document.getElementById('hidden_div3').style.display = 'none';
      }
      if (element.value == 1) {
        document.getElementById('hidden_div1').style.display = 'block';
        document.getElementById('hidden_div2').style.display = 'none';
        document.getElementById('hidden_div3').style.display = 'none';
      }
      if (element.value == 2) {
        document.getElementById('hidden_div1').style.display = 'none';
        document.getElementById('hidden_div2').style.display = 'block';
        document.getElementById('hidden_div3').style.display = 'none';
      }
      if (element.value == 3) {
        document.getElementById('hidden_div1').style.display = 'none';
        document.getElementById('hidden_div2').style.display = 'none';
        document.getElementById('hidden_div3').style.display = 'block';
      }
    }
  </script>
</body>

</html>
