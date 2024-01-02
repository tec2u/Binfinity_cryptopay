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
        </section>


        <!-- Main -->
        <main id="main">
            <section id="what-we-do" class="what-we-do">
                <div class="container">
                    <div class="section-title-2">
                        <p>@lang('leadpage.partners.services.title')</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-3  align-items-stretch ">
                            <div class="wp-container-5 text-center wp-block-group light-border h-100 zoom">
                                <div class="wp-block-group__inner-container">
                                    <div class="wp-block-image modal-trigger modal-1">
                                        <figure class="aligncenter size-full"><img loading="lazy" src="../assetsWelcome/images/rewards.png" alt="" class="wp-image-47" width="150" height="150"></figure>
                                    </div>
                                    <h4 class="text-center" style="font-size:24px"><strong>@lang('leadpage.partners.services.box1')</strong></h4>
                                    <p class="text-center" style="font-size:15px">@lang('leadpage.partners.services.box1tex')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 align-items-stretch mt-4 mt-md-0">
                            <div class="wp-container-8 text-center wp-block-column modal-trigger modal-2">
                                <div class="wp-container-7 wp-block-group light-border h-100 zoom">
                                    <div class="wp-block-group__inner-container">
                                        <div class="wp-block-image">
                                            <figure class="aligncenter size-full"><img loading="lazy" src="../assetsWelcome/images/concierge.png" alt="" class="wp-image-48" width="150" height="150"></figure>
                                        </div>
                                        <h4 class="text-center" style="font-size:24px"><strong>@lang('leadpage.partners.services.box2')</strong></h4>
                                        <p class="text-center">@lang('leadpage.partners.services.box2tex')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 align-items-stretch mt-4 mt-lg-0">
                            <div class="wp-container-9 text-center wp-block-group light-border h-100 zoom">
                                <div class="wp-block-group__inner-container">
                                    <div class="wp-block-image">
                                        <figure class="aligncenter size-full"><img loading="lazy" src="../assetsWelcome/images/APP.png" alt="" class="wp-image-50" width="150" height="150"></figure>
                                    </div>
                                    <h4 class="text-center" style="font-size:24px"><strong>@lang('leadpage.partners.services.box3')</strong></h4>
                                    <p class="text-center">@lang('leadpage.partners.services.box3tex')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 align-items-stretch mt-4 mt-lg-0">
                            <div class="wp-container-11 text-center wp-block-group light-border h-100 zoom">
                                <div class="wp-block-group__inner-container">
                                    <div class="wp-block-image">
                                        <figure class="aligncenter size-full"><img loading="lazy" src="../assetsWelcome/images/KYC.png" alt="" class="wp-image-52" width="150" height="150"></figure>
                                    </div>
                                    <h4 class="text-center" style="font-size:24px"><strong>@lang('leadpage.partners.services.box4')</strong></h4>
                                    <p class="text-center">@lang('leadpage.partners.services.box4tex')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 align-items-stretch m-auto">
                            <div class="wp-container-14 text-center wp-block-group light-border h-100 zoom">
                                <div class="wp-block-group__inner-container">
                                    <div class="wp-block-image">
                                        <figure class="aligncenter size-full"><img loading="lazy" src="../assetsWelcome/images/cards.png" alt="" class="wp-image-58" width="150" height="150"></figure>
                                    </div>
                                    <h4 class="text-center" style="font-size:24px"><strong>@lang('leadpage.partners.services.box5')</strong></h4>
                                    <p class="text-center">@lang('leadpage.partners.services.box5tex')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 align-items-stretch mt-4 mt-md-0">
                            <div class="wp-container-16 text-center wp-block-group light-border h-100 zoom">
                                <div class="wp-block-group__inner-container">
                                    <div class="wp-block-image">
                                        <figure class="aligncenter size-full"><img loading="lazy" src="../assetsWelcome/images/accounts.png" alt="" class="wp-image-60" width="150" height="150"></figure>
                                    </div>
                                    <h4 class="text-center" style="font-size:24px"><strong>@lang('leadpage.partners.services.box6')</strong></h4>
                                    <p class="text-center">@lang('leadpage.partners.services.box6tex')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 align-items-stretch mt-4 mt-lg-0">
                            <div class="wp-container-18 text-center wp-block-group light-border h-100 zoom">
                                <div class="wp-block-group__inner-container">
                                    <div class="wp-block-image">
                                        <figure class="aligncenter size-full"><img loading="lazy" src="../assetsWelcome/images/crypto.png" alt="" class="wp-image-62" width="150" height="150"></figure>
                                    </div>
                                    <h4 class="text-center" style="font-size:24px"><strong>@lang('leadpage.partners.services.box7')</strong></h4>
                                    <p class="text-center">@lang('leadpage.partners.services.box7tex')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 align-items-stretch mt-4 mt-lg-0">
                            <div class="wp-container-21 text-center wp-block-column modal-trigger modal-8">
                                <div class="wp-container-20 wp-block-group light-border h-100 zoom">
                                    <div class="wp-block-group__inner-container">
                                        <div class="wp-block-image">
                                            <figure class="aligncenter size-full"><img loading="lazy" src="../assetsWelcome/images/payments.png" alt="" class="wp-image-64" width="150" height="150"></figure>
                                        </div>
                                        <h4 class="text-center" style="font-size:24px"><strong>@lang('leadpage.partners.services.box8')</strong></h4>
                                        <p class="text-center">@lang('leadpage.partners.services.box8tex')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="about_section layout_padding">
                <div class="container ">
                    <div class="row text-center">
                        <h2>@lang('leadpage.partners.become')</h2>
                        <div id="botao">
                            <button class="jbutton mt-3 p-3">@lang('leadpage.btn.open')</button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="about_section layout_padding">
                <div class="container ">
                    <div class="row flex-md-row-reverse">

                        <div class="col-md-6 ">
                            <div class="img-box">
                                <img src="../assetsWelcome/images/accounts_phone.png" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-box type_text">
                                <div class="heading_container">
                                    <h2 class="tblue">@lang('leadpage.partners.cards.cards')</h2>
                                    <p class=" ">
                                        @lang('leadpage.partners.cards.cardscont')
                                    </p>
                                </div>
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
                                <img src="../assetsWelcome/images/accounts_laptop.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-box type_text">
                                <div class="heading_container">
                                    <h2 class="tblue">@lang('leadpage.partners.cards.accounts')</h2>
                                    <p class="">
                                        @lang('leadpage.partners.cards.accountscont')
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="about_section layout_padding">
                <div class="container">
                    <div class="section-title-2">
                        <p>@lang('leadpage.partners.section.title')</p>
                    </div>
                    <div class="row justify-content-evenly">
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                            <div class="wp-container-29 m-auto wp-block-column is-vertically-aligned-top">
                                <div class="wp-block-image image-border zoom">
                                    <figure class="aligncenter size-thumbnail is-resized"><img loading="lazy" src="../assetsWelcome/images/imgfintech.png" alt="" class="wp-image-77" sizes="(max-width: 113px) 100vw, 113px" width="113" height="113"></figure>
                                </div>
                                <h4 class="text-center has-medium-font-size"><strong>@lang('leadpage.partners.section.box1')</strong></h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                            <div class="wp-container-30 m-auto text-center wp-block-column">
                                <div class="wp-block-image image-border zoom">
                                    <figure class="aligncenter size-thumbnail is-resized"><img loading="lazy" src="../assetsWelcome/images/imgonlineplat.png" alt="" class="wp-image-78" width="113" height="113"></figure>
                                </div>
                                <h4 class="text-center has-medium-font-size"><strong>@lang('leadpage.partners.section.box2')</strong></h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                            <div class="wp-container-31 m-auto wp-block-column">
                                <div class="wp-block-image image-border zoom">
                                    <figure class="aligncenter size-thumbnail is-resized"><img loading="lazy" src="../assetsWelcome/images/imgstartup.png" alt="" class="wp-image-79" sizes="(max-width: 113px) 100vw, 113px" width="113" height="113"></figure>
                                </div>
                                <h4 class="text-center has-medium-font-size"><strong>@lang('leadpage.partners.section.box3')</strong></h4>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <p>
                        @lang('leadpage.partners.section.sub')
                    </p>
                    <div id="botao">
                        <button class="jbutton mt-3 p-3">@lang('leadpage.partners.section.btn')</button>
                    </div>
                </div>
            </section>

            <section class="about_section layout_padding color_faq">
                <div class="container ">
                    <div class="row">
                        <div class="wp-container-40 wp-block-group alignfull has-background">
                            <div class="wp-block-group__inner-container">
                                <div class="wp-container-39 wp-block-group">
                                    <div class="wp-block-group__inner-container">
                                        <h2 class="has-text-align-left corporate-member"><strong>@lang('leadpage.partners.section.text')</strong></h2>

                                        <div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>

                                        {{-- <div class="wp-container-38 wp-block-buttons is-content-justification-left">
                                            <div class="wp-block-button"><a class="button bg-white t" href="/contact" style="border-radius:12px;color:#ffa019">Contact us</a></div>
                                        </div> --}}
                                    </div>
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