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

            <section id="rewards-title">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            </h6>Our referral programme gives you unlimited rewards, with money deposited directly into your
                            account when you refer friends and family and use Infinity ClubCards as your preferred daily card.
                            Our generous commission means that you can easily cover the cost of your membership fees and more.
                            </h6>
                        </div>
                    </div>
                </div>
            </section>


            <section id="refer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Refer your Family and Friends</h2>
                            <p>For each new member you refer, we will pay you 20% of their membership fee paid directly in to your account.
                                For example, for a VIP referral, you would receive $239.00 (USD) paid in cash in to your USD account.</p>
                            <p>It doesn’t stop there… If you make 3 referrals, we will automatically upgrade your membership level for free*.</p>
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Membership Type</th>
                                        <th scope="col" class="bdrdr">Your Commission Payment</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <th scope="row">Starter</th>
                                        <td>$25.80</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Premier</th>
                                        <td>$99.80</td>

                                    </tr>
                                    <tr>
                                        <th scope="row">VIP</th>
                                        <td>$239.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Chairman</th>
                                        <td class="bdrdbr">$499.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="button btn-ref">Get your Referral Link</a>
                        </div>
                        <div class=" col-lg-6 text-center">
                            <img src="../assetsWelcome/images/referral_01.png" alt="..." class="img-fluid" style="max-width:500px">
                        </div>
                    </div>
                </div>
            </section>


            <section id="instant">
                <div class="container">
                    <div class="row flex-sm-row-reverse">
                        <div class="col-lg-6">
                            <h2>Instant Rewards from all your favourite retailers</h2>
                            <h6><small>(coming soon)</small></h6>
                            <p>Infinity ClubCards membership gives you unrivalled rewards when you spend on your card online or in stores. We have negotiated with hundreds of retailers to give you real rewards and instant money in your account.</p>
                            <p>The Infinity ClubCards rewards programme allows you to:</p>
                            <ul>
                                <li>Up to 22% instant reward for your purchases **</li>
                                <li>Buy gift cards for friends or family Infinity ClubCards members and receive instant rewards directly into your account</li>
                                <li>Search by your favourite shops, restaurants and entertainment venues to take advantage of instant cash reward.</li>
                                <li>Search directly for the item or product you need</li>
                                <li>Keep track of your rewards earnings</li>
                                <li>Instantly download your voucher to use online or instore</li>
                                <li>Use at hundreds of retailers around the world</li>

                            </ul>
                            <a href="#" class="button btn-ref">Link</a>
                        </div>
                        <div class="col-lg-6  text-center">
                            <img src="../assetsWelcome/images/shopping_bags_01.png" alt="..." class="img-fluid" style="max-width:500px">
                        </div>
                    </div>
            </section>

            <section id="brands">
                <div class="container">
                    <div class="row flex-sm-row-reverse">
                        <div class="col-12 text-center m-auto">
                            <h2>Here are some of our partners</h2>
                            <img src="../assetsWelcome/images/brands.png" alt="..." class="img-fluid ">
                        </div>
                        <div class="col-12 text-center">
                            <a href="#" class="button btn-ref">Link</a>
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
                    <li><a href="#" class="button btn-pric">Register</a></li>
                    <li><a href="#" class="button btn2 btn-pric">Login</a></li>
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