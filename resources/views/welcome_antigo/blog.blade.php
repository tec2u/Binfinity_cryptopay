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
                    <li><a class="hbutton" href="{{ url('/cards') }}">Cards</a></li>
                    <li><a class="hbutton" href="{{ url('/accounts') }}">Accounts</a></li>
                    <li><a class="hbutton" href="{{ url('/concierge') }}">Concierge</a></li>
                    {{-- <li><a class="hbutton" href="{{ url('/partners') }}">Partners</a></li> --}}
                    {{-- <li><a class="hbutton" href="{{ url('/rewards') }}">Rewards</a>
                    <li><a class="hbutton" href="{{ url('/blog') }}">Blog</a></li> --}}
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ route('admin.home') }}"><button class="jbutton">Dashboard</button></a>
                    @else
                    <a href="{{ route('login') }}"><button class="jbutton">Login</button></a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"><button class="jbutton">Join Now!</button></a>
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
            <section id="blog-search">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="btn-group-blog">
                                <a type="button" class="btn-blog">Cryptocurrencies</a>
                                <a type="button" class="btn-blog">Tradition Currency</a>
                                <a type="button" class="btn-blog">Lifestyle</a>
                                <a type="button" class="btn-blog">Travel</a>
                                <a type="button" class="btn-blog">Infinity ClubCards News</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <a type="button" class="btn-blog-search" type="submit">Search</a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>


            <section id="blog-cards">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="card m-auto" style="width: 22rem;">
                                <img src="../assetsWelcome/images/blog1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Downsides of The Sharing Economy</h5>
                                    <p class="card-text"><small class="text-muted">by infinityclubcards | Oct 6, 2022 | Cryptocurrencies</small></p>
                                    <p class="card-text">You’ve probably heard about the disruption happening in the retail, transport, and hospitality, among other industries. It goes by various names, including collaborative consumption, access over ownership, on-demand or peer-to-peer economy, and more commonly, the...</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card m-auto" style="width: 22rem;">
                                <img src="../assetsWelcome/images/blog3.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Downsides of The Sharing Economy</h5>
                                    <p class="card-text"><small class="text-muted">by infinityclubcards | Oct 6, 2022 | Infinity ClubCards News, Cryptocurrencies</small></p>
                                    <p class="card-text">Who are Bitcoin whales? If you closely follow the Bitcoin price trends and market news, you will likely encounter mentions of Bitcoin whales. As the value of other digital assets created on the blockchain, in particular altcoins and non-fungible tokens (NFTs), has...</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card m-auto" style="width: 22rem;">
                                <img src="../assetsWelcome/images/blog2.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Downsides of The Sharing Economy</h5>
                                    <p class="card-text"><small class="text-muted">by infinityclubcards | Oct 6, 2022 | Infinity ClubCards News, Cryptocurrencies</small></p>
                                    <p class="card-text">An on-ramp is any platform that facilitates users to acquire crypto assets or enter their markets. On the other hand, an off-ramp is a platform that facilitates a user to dispose of crypto assets or exit their markets. Some platforms perform both of these two...</p>
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
                <h2>Ready to do <strong>something</strong>?</h2>
                <p>Proin a ullamcorper elit, et sagittis turpis integer ut fermentum.</p>
            </header>
            <footer>
                <ul class="buttons">
                    <li><a href="#" class="button primary">Register</a></li>
                    <li><a href="#" class="button btn2">Login</a></li>
                </ul>
            </footer>

        </section>

        <!-- Footer -->
        <footer id="footer" class="bg-luxury">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 rodape">
                        <p class="txt_footer">
                            PRODUCT FEATURES
                        </p>
                        <ul class="txt_ajuste">
                            <li><a href="#" class="txt_footer1">Crypto to Cash</a></li>
                            <li class="txt_li"><a href="#" class="txt_footer1">Buy Crypto</a></li>
                            <li class="txt_li"><a href="#" class="txt_footer1">Crypto to Crypto</a></li>
                            <li class="txt_li"><a href="#" class="txt_footer1">Spend Crypto</a></li>
                            <li class="txt_li"><a href="#" class="txt_footer1">24/7 Conceirge Services</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 rodape">
                        <div class="list-group">
                            <p class="txt_footer mb-4">
                                LANGUAGES
                            </p>
                            <a class="langlink" href="#"><img src="../assetsWelcome/images/flagunited-kingdom.png" class="langimg" alt="...">English</a></li>
                            <a class="langlink" href="#"><img src="../assetsWelcome/images/flagspain.png" class="langimg" alt="...">Spanish</a>
                            <a class="langlink" href="#"><img src="../assetsWelcome/images/flaggermany.png" class="langimg" alt="...">German</a>
                            <a class="langlink" href="#"><img src="../assetsWelcome/images/flagfrance.png" class="langimg" alt="...">French</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="col-12 rodape">
                    <p>
                        E-money issuance, payments, and card services are solely provided by Nvayo Limited (No. 06035209),
                        authorised by the Financial Conduct Authority under the Electronic Money Regulations 2017 for the issuing of electronic
                        fiat money and payment instruments (Reference number 900005) with registered address: 1 King William Street EC4N 7AF, London,
                        United Kingdom. Your Infinity ClubCards Prepaid Card will be issued by Nvayo Limited. Please note the Infinity ClubCards card is a regulated
                        electronic money product but it is not covered by the Financial Services Compensation Scheme. We ensure that any funds received
                        by you are held in a segregated account so that in the unlikely event that Nvayo Limited becomes insolvent your funds will be
                        protected against claims made by creditors.
                    </p>

                    <p>
                        Cryptocurrency services are not regulated by the Financial Conduct Authority (FCA).
                        You understand that the price or value of cryptocurrencies can rapidly increase or decrease at any time.
                        The risk of loss in buying, selling or holding cryptocurrencies can be substantial. Cryptocurrencies received by us will
                        not be safeguarded under the UK Electronic Money Regulations 2011 or covered by the Financial Services Compensation Scheme.
                        We do not make any representation regarding the advisability of transacting in cryptocurrencies. We cannot guarantee the
                        timeliness, accurateness, or completeness of any data or information used in connection with you holding any exposure to
                        cryptocurrencies. The information provided on this website is included for reference only and we do not make any representation
                        regarding the accuracy of such data.
                    </p>
                </div>
            </div>

            <ul class="copyright">
                <li>&copy; Untitled</li>
                <li>Design: <a href="http://html5up.net">Tecnologia 2U</a></li>
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