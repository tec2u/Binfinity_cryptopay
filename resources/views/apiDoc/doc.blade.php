<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/png" sizes="400x400" href="assetsWelcomeNew/images/icon.png">
  <title>B Inifnity Bank - Crypto Pay</title>

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
      background-color: #00a281;
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
      color: #2896eb;
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
  </style>
</head>

<body>


  <nav id="navbar">
    <header>React Documentation</header>
    <ul>
      <li><a class="nav-link" href="#Getting_Started">Getting Started</a></li>
      <li><a class="nav-link" href="#Hello_World">Create Account</a></li>
      <li><a class="nav-link" href="#Introducing_JSX">Introducing JSX</a></li>
      <li><a class="nav-link" href="#Rendering_Elements">Rendering Elements</a></li>
      <li><a class="nav-link" href="#Components_and_Props">Components and Props</a></li>

    </ul>
  </nav>
  </div>
  <div class="row">
    <main id="main-doc">
      <section class="main-section" id="Getting_Started">
        <header>Getting Started</header>
        <article>
          <p class="first-p">This page is an overview of the API documentation and related resources.</p>
          <p><strong>React</strong> is a JavaScript library for building user interfaces. Learn what React is all about
            on
            our homepage or in the tutorial.</p>
          <h2>Try React</h2>
          <p>React has been designed from the start for gradual adoption, and you can use as little or as much React as
            you need. Whether you want to get a taste of React, add some interactivity to a simple HTML page, or start a
            complex React-powered app, the links in this section will help you get started.</p>
        </article>
      </section>

      <section class="main-section" id="Hello_World">
        <header>Hello World</header>
        <article>
          <p class="first-p">The smallest React example looks like this:</p>
          <pre><code>ReactDOM.render(
        &lt;h1&gt;Hello, world!&lt;/h1&gt;,
        document.getElementById('root')
  );
        </code></pre>
          <p>It displays a heading saying “Hello, world!” on the page.</p>
        </article>
      </section>

      <section class="main-section" id="Introducing_JSX">
        <header>Introducing JSX</header>
        <article>
          <p class="first-p">Consider this variable declaration:</p>
          <pre><code>const element = &lt;h1&gt;Hello, world!&lt;h1&gt;;</code></pre>
          <p>This funny tag syntax is neither a string nor HTML.</p>
          <p>It is called JSX, and it is a syntax extension to JavaScript. We recommend using it with React to describe
            what the UI should look like. JSX may remind you of a template language, but it comes with the full power of
            JavaScript.
          <p>
          <p>JSX produces React “elements”. We will explore rendering them to the DOM in the next section. Below, you
            can
            find the basics of JSX necessary to get you started.</p>
          <h2>Why JSX?</h2>
          <p>React embraces the fact that rendering logic is inherently coupled with other UI logic: how events are
            handled, how the state changes over time, and how the data is prepared for display.</p>
          <p>Instead of artificially separating technologies by putting markup and logic in separate files, React
            separates concerns with loosely coupled units called “components” that contain both. We will come back to
            components in a further section, but if you’re not yet comfortable putting markup in JS, this talk might
            convince you otherwise.</p>
          <p>React doesn’t require using JSX, but most people find it helpful as a visual aid when working with UI
            inside
            the JavaScript code. It also allows React to show more useful error and warning messages.</p>
          <p>With that out of the way, let’s get started!</p>
        </article>
      </section>

      <section class="main-section" id="Rendering_Elements">
        <header>Rendering Elements</header>
        <article>
          <p class="first-p">Elements are the smallest building blocks of React apps.</p>
          <p>An element describes what you want to see on the screen:</p>
          <pre><code>const element = &lt;h1&gt;Hello, world!&lt;h1&gt;;</code></pre>
          <p>Unlike browser DOM elements, React elements are plain objects, and are cheap to create. React DOM takes
            care
            of updating the DOM to match the React elements.</p>
          <blockquote cite="https://reactjs.org/docs/rendering-elements.html">
            <strong>Note:</strong>
            <p>One might confuse elements with a more widely known concept of “components”. We will introduce components
              in the next section. Elements are what components are “made of”, and we encourage you to read this section
              before jumping ahead.</p>
          </blockquote>
        </article>
      </section>

      <section class="main-section" id="Components_and_Props">
        <header>Components and Props</header>
        <article>
          <p class="first-p">Components let you split the UI into independent, reusable pieces, and think about each
            piece
            in isolation. This page provides an introduction to the idea of components. You can find a <a
              href="https://reactjs.org/docs/react-component.html">detailed component API reference here.</a></p>
          <p>Conceptually, components are like JavaScript functions. They accept arbitrary inputs (called “props”) and
            return React elements describing what should appear on the screen.</p>
          <h2>Function and Class Components</h2>
          <p>The simplest way to define a component is to write a JavaScript function:</p>
          <pre><code>function Welcome(props) {
              return &lt;h1&gt;Hello, {props.name}&lt;h1&gt;;
            }
        </code></pre>
          <p>This function is a valid React component because it accepts a single “props” (which stands for properties)
            object argument with data and returns a React element. We call such components “function components” because
            they are literally JavaScript functions.</p>
          <p>You can also use an <a
              href="https://developer.mozilla.org/en/docs/Web/JavaScript/Reference/Classes">ES6</a>
            class to define a component:</p>
          <pre><code>class Welcome extends React.Component {
                    render() {
                        return &lt;h1&gt;Hello, {this.props.name}&lt;h1&gt;;
                    }
                }
            </code></pre>
          <p>The above two components are equivalent from React’s point of view.</p>
          <p>Classes have some additional features that we will discuss in the next sections. Until then, we will use
            function components for their conciseness.</p>
        </article>
      </section>



      <footer>
        <p id="footer-content">All content sourced from <a href="https://reactjs.org/docs/">ReactJS</a></p>
      </footer>

    </main>

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
