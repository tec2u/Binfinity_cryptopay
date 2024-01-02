<!DOCTYPE HTML>
<html>

<head>
    <title>Infinity ClubCards</title>
    <link rel="icon" type="image/png" href="../assetsWelcome/images/favicon.png" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="assetsWelcome/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <noscript>
        <link rel="stylesheet" href="assetsWelcome/css/noscript.css" />
    </noscript>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body class="index is-preload">
    <div id="page-wrapper">
        <!-- ======= Header ======= -->

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
        </header>
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex flex-column justify-content-center">
            <div class="">

                <video autoplay muted loop class=" d-block w-100" alt="...">
                    <source src="../videos/welcomevideo.mp4" type="video/mp4">
                </video>

            </div>
        </section><!-- End Hero -->


        <!-- Main -->
        <main id="main">
            <section id="what-we-do" class="what-we-do">
                <div class="container">

                    <div class="section-title-1">
                        <p>@lang('leadpage.card.msg')</p>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 colplastic-md-6 d-flex align-items-stretch">
                            <div class="icon-box">
                                <div class="icon"><img src="../assetsWelcome/images/cartao1.png" style="max-width:330px;" alt=""></div>
                                <h5><a>@lang('leadpage.card.cards.standardtitle')</a></h5>
                                <p class="text-center">@lang('leadpage.card.cards.standardsub')</p>
                                <button class="jbutton mt-3 p-3">@lang('leadpage.card.cards.btn')</button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                            <div class="icon-box">
                                <div class="icon"><img src="../assetsWelcome/images/cartao3.png" style="max-width:330px;" alt=""></div>
                                <h5><a>@lang('leadpage.card.cards.stainlesstitle')</a></h5>
                                <p class="text-center">@lang('leadpage.card.cards.stainlesssub')</p>
                                <button class="jbutton mt-3 p-3">@lang('leadpage.card.cards.btn')</button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                            <div class="icon-box">
                                <div class="icon"><img src="../assetsWelcome/images/cartao2.png" style="max-width:330px;" alt=""></div>
                                <h5><a>@lang('leadpage.card.cards.limitedtitle')</a></h5>
                                <p class="text-center">@lang('leadpage.card.cards.limitedsub')</p>
                                <button class="jbutton mt-3 p-3">@lang('leadpage.card.cards.btn')</button>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section class="about_section layout_padding">
                <div class="container ">

                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="img-box">
                                <img src="../assetsWelcome/images/woman_cafe.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="detail-box type_text">
                                <div class="heading_container">
                                    <h2>
                                        @lang('leadpage.card.flexible')
                                    </h2>
                                </div>
                                <ul>
                                    @lang('leadpage.card.flexiblecont')
                                </ul>
                                <div class="text-center">
                                    <button class="jbutton mt-3 p-3">@lang('leadpage.card.cards.btn')</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="about_section layout_padding">

                <div class="container ">
                    <div class="row flex-md-row-reverse">


                        <div class="col-md-6 ">
                            <div class="img-box">
                                <img src="../assetsWelcome/images/contactless_payment.png" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-box type_text">
                                <div class="heading_container">
                                    <h2>
                                        @lang('leadpage.card.payment')
                                    </h2>
                                </div>
                                <ul class="">
                                    @lang('leadpage.card.paymentcont')
                                </ul>


                            </div>

                            <div class="text-center">
                                <button class="jbutton mt-3 p-3">@lang('leadpage.card.cards.btn')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="about_section layout_padding color_faq">
                <div class="container ">

                    <h3 class="text-center title_faq"> @lang('leadpage.card.faq.title')</h3>

                    {{-- <div class="faq-drawer">
                        <input class="faq-drawer__trigger" id="faq-drawer" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer">@lang('leadpage.card.faq.question1')</label>
                        <div class="faq-drawer__content-wrapper">
                            <div class="faq-drawer__content">
                                <p>
                                    @lang('leadpage.card.faq.resp1')
                                </p>
                            </div>
                        </div>
                    </div> --}}

                    <div class="faq-drawer">
                        <input class="faq-drawer__trigger" id="faq-drawer-2" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-2">@lang('leadpage.card.faq.question2')</label>
                        <div class="faq-drawer__content-wrapper">
                            <div class="faq-drawer__content">
                                <p>
                                    @lang('leadpage.card.faq.resp2')
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-drawer">
                        <input class="faq-drawer__trigger" id="faq-drawer-3" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-3">@lang('leadpage.card.faq.question3')</label>
                        <div class="faq-drawer__content-wrapper">
                            <div class="faq-drawer__content">
                                <p>
                                    @lang('leadpage.card.faq.resp3')
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-drawer">
                        <input class="faq-drawer__trigger" id="faq-drawer-4" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-4">@lang('leadpage.card.faq.question4')</label>
                        <div class="faq-drawer__content-wrapper">
                            <div class="faq-drawer__content">
                                <p>
                                    @lang('leadpage.card.faq.resp4')
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-drawer">
                        <input class="faq-drawer__trigger" id="faq-drawer-5" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-5">@lang('leadpage.card.faq.question5')</label>
                        <div class="faq-drawer__content-wrapper">
                            <div class="faq-drawer__content">
                                <p>
                                    @lang('leadpage.card.faq.resp5')
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- CTA -->
        <section id="cta" class="bg-luxury">
            <header>
                <h2>@lang('leadpage.footer.ready')</h2>
                {{-- <p>@lang('leadpage.footer.readysub')</p> --}}
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
    </div>

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