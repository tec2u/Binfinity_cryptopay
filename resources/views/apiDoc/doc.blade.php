<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/png" sizes="400x400" href="assetsWelcomeNew/images/icon.png">
  <title>B Inifnity Bank - Crypto Pay</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

  <!-- and it's easy to individually load additional languages -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>

  <script>
    hljs.highlightAll();
  </script>

  <style>
    @import url('https://fonts.googleapis.com/css?family=Lato:400,700');

    html,
    body {
      padding: 0;
      margin: 0;
    }

    body {
      font-family: 'Lato', sans-serif;
    }

    /* Nav Bar */

    nav {
      width: 100%;
      background-color: #8261ee;
      padding: 40px;
      box-sizing: border-box;
    }

    nav#navbar header {
      color: #fff;
    }

    nav#navbar h1 {
      font-size: 3rem;
      font-weight: 700;
      margin: 0;
    }

    nav#navbar p {
      color: #fff;
    }

    nav ul {
      list-style: none;
      padding: 0;
    }

    nav ul li {
      padding: 5px 0;
      margin-top: 5px;
      font-size: 1.2rem;
      margin-top: 1rem;
    }

    .active {
      font-weight: bold;
    }

    span.active-marker {
      width: 20px;
      height: 30px;
      margin-top: -6px;
      border-right: 6px solid #fff;
      position: absolute;
      left: 0;
    }

    /* Main, General Sections */

    main {
      padding: 40px;
      box-sizing: border-box;
    }

    header {
      color: #000;
    }

    section {
      margin-top: 60px;
    }

    section:first-child {
      margin-top: 0;
    }

    .main-section header {
      font-weight: 700;
      font-size: 1.4rem;
    }

    /* Code Blocks */

    code.code-block {
      font-size: 1.2rem;
      background-color: black;
      display: inline-block;
      padding: 20px;
      width: 100%;
      box-sizing: border-box;
      color: #fff;
    }

    code.code-block span.line {
      display: inline-block;
      width: 100%;
      word-wrap: break-word;
    }

    code.inline-highlight {
      color: #ff615b;
      background-color: rgba(182, 216, 205, 0.3);
    }

    .statement,
    .tag {
      color: #569cd6;
    }

    .function {
      color: #90dcfe;
    }

    .string,
    .attr {
      color: #ce8b55;
    }

    .num,
    .value,
    .boolean {
      color: #b5cea8;
    }

    .comment {
      color: #6a994c;
    }

    .indent-2 {
      margin-left: 18px;
    }

    .indent-4 {
      margin-left: 38px;
    }

    .indent-6 {
      margin-left: 56px;
    }

    /* Footer */

    footer {
      padding: 4px 0;
      background-color: #8261ee;
      color: #ffffff;
      font-size: 12px;
      text-align: center;
      margin-top: 60px;
    }

    /* Links */

    a:link,
    a:hover,
    a:visited,
    a:active {
      color: #ffffff;
      text-decoration: none;
    }

    ul#navlist a:link,
    a:visited,
    a:active {
      color: #e8e6e7;
    }

    ul#navlist a:hover {
      font-weight: 700;
    }

    @media only screen and (min-width: 760px) {
      nav {
        width: 250px;
        height: 100%;
        position: fixed;
        padding: 40px 0 0 40px;
        top: 0;
        left: 0;
      }

      main {
        height: 100%;
        box-sizing: border-box;
        padding: 40px 40px 40px 360px;
        background-color: white;
      }
    }

    code {
      background-color: rgba(255, 255, 255, 0.2);
    }

    pre code {
      display: block;
      /* margin-bottom: 40px; */
      background-color: rgb(30, 44, 52, 0.95);
      color: white;
      border-radius: 5px;
      padding: 5px;
      line-height: 2;
      font-size: 12px;
    }

    #navbar img {
      max-width: 80%;
    }
  </style>
</head>

<body>


  <nav id="navbar">
    <header>
      <img src="https://crypto.binfinitybank.com/assetsWelcomeNew/images/logo2.png" alt="" srcset="">
    </header>
    <ul>
      <li><a class="nav-link" href="#Getting_Started">Getting Started</a></li>
      <li><a class="nav-link" href="#Hello_World">Create Account</a></li>
      <li><a class="nav-link" href="#EndPoints">EndPoints</a></li>
      <li><a class="nav-link" href="#Notify">Notify</a></li>

    </ul>
  </nav>
  </div>
  <div class="row">
    <main id="main-doc">
      <section class="main-section" id="Getting_Started">
        <header>Getting Started</header>
        <article>
          <p class="first-p">This page is an overview of the API documentation and related resources.</p>

        </article>
      </section>

      <section class="main-section" id="Hello_World">
        <header>Create Account</header>
        <article>
          click <a style="color: #8261ee" href="/login">HERE</a> to create your account
          <p>After creating your account, access the menu and register your withdrawal wallet</p>
          <p>Then access your allocated wallets and generate the wallets of the desired currency</p>
        </article>
      </section>

      <section class="main-section" id="EndPoints">
        <header>EndPoints</header>
        <article>
          <p class="first-p">Create invoice:</p>
          {{-- <pre><code>const element = &lt;h1&gt;Hello, world!&lt;h1&gt;;</code></pre> --}}
          <pre><code>{{ route('notify.wallet') }}</code></pre>

          <p><strong>Request: (POST)</strong></p>

          <pre style=""><code id="" class="language-javascript">
            {
              "id_order": "1", // id of your order in your system
              "price": 100, // in USD
              "price_crypto": 100,
              "login": "your_email",
              "password": "your_password",
              "coin": "USTD_TRC20", 
              "notify_url": "Your_system_url_notify",
            }
            </code></pre>

          <p><strong>Response:</strong></p>

          <pre style=""><code id="" class="language-javascript">

            {
              "id": 1, 
              "merchant_id": "USDT_TRC20100",
              "wallet": "a1b2c3d4e5f6g7h8i9",
            }
            </code></pre>

        </article>
      </section>

      <section class="main-section" id="Notify">
        <header>Notify</header>
        <article>
          <p class="first-p">Notify structure:</p>
          <p>With this information, your system will process the information as needed.</p>
          <pre><code>Your system will receive</code></pre>
          <p><strong>Request: (POST)</strong></p>
          <pre style=""><code id="" class="language-javascript">
            {
                "id":628,
                "id_order":"5103",
                "status":"Paid",
                "price_crypto":158,
                "price_crypto_payed":158,
                "dif":0,
                "hash":"999999999999999999999999",
                "merchant_id":"USDT_TRC20628",
                "node":true
            }
            </code></pre>

        </article>
      </section>

      <a href="{{ route('.welcome') }}">
        <footer>
          <p id="footer-content">
            Return to Binfinity Bank
          </p>
        </footer>
      </a>

    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"
      integrity="sha512-D9gUyxqja7hBtkWpPWGt9wfbfaMGVt9gnyCvYa+jojwwPHLCzUm5i8rpk7vD7wNee9bA35eYIjobYPaQuKS1MQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $(function() {

        $('#navbar a').click(function() {

          $('#navbar .active').removeClass('active'); // remove the class from the currently selected
          $(this).addClass('active'); // add the class to the newly clicked link

        });

      });
    </script>
</body>

</html>
