@extends('layouts.header')
@section('content')
  <style>
    @import url('https://fonts.googleapis.com/css?family=Muli&display=swap');

    :root {
      --line-border-fill: #3498db;
      --line-border-empty: #e0e0e0;
    }

    /* body {
                                                                                                                                                                                                                                                                                                                                                                                                                            } */

    .container-form {
      text-align: center;
      background-color: #f9f9f9;
      font-family: 'Muli', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      overflow: hidden;
      margin: 0;
    }

    .progress-container {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin-bottom: 30px;
      max-width: 100%;
      width: 90%;
    }

    .progress-container::before {
      content: '';
      /* must be added when using the ::before pseudoselector */
      background-color: var(--line-border-empty);
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      height: 4px;
      width: 100%;
      z-index: -1;
    }


    .progress {
      background-color: var(--line-border-fill);
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      /* centers the line vertically along the y-axis */
      height: 4px;
      width: 0%;
      z-index: -1;
      transition: .4s ease;
    }

    .circle {
      background-color: #fff;
      color: #999;
      border-radius: 50%;
      height: 30px;
      width: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 3px solid var(--line-border-empty);
      transition: .4s ease;
    }

    .circle.active {
      border-color: var(--line-border-fill);
    }

    .btn {
      background-color: var(--line-border-fill);
      color: #fff;
      border: 0;
      border-radius: 6px;
      cursor: pointer;
      font-family: inherit;
      padding: 8px 30px;
      margin: 5px;
      font-size: 14px;
    }

    .btn:active {
      transform: scale(.98);
    }

    .btn:focus {
      outline: 0;
    }

    .btn:disabled {
      background-color: var(--line-border-empty);
      cursor: not-allowed;
    }

    .formProcess {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .controls {
      width: 100%;
      display: flex;
      justify-content: space-between;
    }

    .formulario-compra {
      width: 85%;
      height: fit-content;
    }

    .step {
      padding: 2rem;
      border: 1px solid #0266AC;
      position: relative;
      /* Inicia fora da tela à esquerda */
      animation: slideRight 2s forwards;
    }

    .step1 {
      width: 100%;
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      flex-direction: column
    }

    .step1>div {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
    }

    .step1 img {
      width: 250px;
    }

    .step1 .cards>div {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .step2 {
      width: 100%;
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      flex-direction: column
    }

    .step2 .item {
      display: flex;
      width: 80%;
      /* justify-content: space-around; */
      gap: 2rem;
      align-items: center;
    }

    .step2 .item img {
      width: 150px;
    }

    .step3 {
      width: 100%;
    }

    .step3>div {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .step3 .top {
      display: flex;
      width: 100%;
      align-items: center;
    }

    .step3 .main>div {
      display: flex;
      width: 100%;
      justify-content: space-between;
    }

    .step3 .main>div iframe {
      width: 60%;
    }

    .step3 .main>div>div {
      width: 30%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .step4 {
      width: 100%;
      text-align: left !important;
      display: flex;
    }

    .step4 .form-4 {
      display: flex;
      justify-content: space-between;
      padding: 2rem;
      border: 1px solid #0266AC;
    }

    .image-input {
      text-align: center;
    }

    .image-input input {
      display: none;
    }

    .image-input label {
      display: block;
      color: #FFF;
      background: #0266AC;
      padding: .2rem .4rem;
      font-size: 100%;
      cursor: pointer;
    }

    .image-input label i {
      font-size: 100%;
      margin-right: .3rem;
    }

    .image-input label:hover i {
      animation: shake .35s;
    }

    .image-input img {
      max-width: 175px;
      display: none;
    }

    .image-input span {
      display: none;
      text-align: center;
      cursor: pointer;
    }

    @keyframes shake {
      0% {
        transform: rotate(0deg);
      }

      25% {
        transform: rotate(10deg);
      }

      50% {
        transform: rotate(0deg);
      }

      75% {
        transform: rotate(-10deg);
      }

      100% {
        transform: rotate(0deg);
      }
    }

    @keyframes slideRight {
      0% {
        opacity: 1;
        /* Inicia fora da tela à esquerda */
      }

      50% {
        opacity: 1;
        /* Inicia fora da tela à esquerda */
      }

      100% {
        opacity: 1;
        /* Termina na posição inicial */
      }
    }
  </style>

  <main id="main" class="main">
    @php
      $user_id = ucwords(auth()->user()->id);
      $packages = Illuminate\Support\Facades\DB::select('SELECT *  FROM packages where activated=1;');
    @endphp
    @include('flash::message')
    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif
    <section style="background: #fff;padding:2rem;overflow:hidden;">
      <div class="fade font" style="font-weight: 800">
        <div class="">
          <div class="">
            <div class="formProcess">
              <div class="progress-container">
                <div class="progress" id="progress"></div>
                <div class="circle active">
                  1
                </div>
                <div class="circle">
                  2
                </div>
                <div class="circle">
                  3
                </div>
                <div class="circle">
                  4
                </div>
              </div>
              <form action="{{ route('packages.processBuyingCreate') }}" method="POST" class="formulario-compra"
                enctype="multipart/form-data">
                @csrf
                <div class="step step1 font" id="step1">
                  <p class="up">Choose the bot you want trade for you</p>
                  <div class="cards">
                    @if (Count($packages) > 0)
                      @foreach ($packages as $item)
                        <div class="form-check">
                          @if ($item->id == 18)
                            <img for="flexRadioDefault{{ $item->id }}" src="{{ asset('/images/bot1.jpg') }}">
                          @else
                            <img for="flexRadioDefault{{ $item->id }}" src="{{ asset('/images/bot2.jpg') }}">
                          @endif
                          <div>
                            <input class="form-check-input" value="{{ $item->id }}" type="radio" name="package_id"
                              id="flexRadioDefault{{ $item->id }}" class="input-package" required>
                            <label class="form-check-label" for="flexRadioDefault{{ $item->id }}">
                              {{ $item->name }}
                            </label>
                          </div>
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                <div class="step step2" id="step2" style="display: none;">
                  <p class="up">Choose the trader you want to open your account on</p>
                  <div class="item">
                    <input class="form-check-input-video" name="account" type="radio" id="flexRadioDefaultaccount1"
                      value="blueberry">
                    <img class="form-check-label" for="flexRadioDefaultaccount1"
                      src="{{ asset('/images/blueberry_logo.png') }}">
                    <a target="_blank" href="https://www.blueberrymarkets.com">https://www.blueberrymarkets.com</a>
                  </div>

                  <div class="item">
                    <input class="form-check-input-video" name="account" type="radio" id="flexRadioDefaultaccount1"
                      value="ic">
                    <img class="form-check-label" for="flexRadioDefaultaccount1"
                      src="{{ asset('/images/ic-markets-logo.png') }}">
                    <a target="_blank" href="https://www.icmarkets.com/">https://www.icmarkets.com/</a>
                  </div>

                  <div class="item">
                    <input class="form-check-input-video" name="account" type="radio" id="flexRadioDefaultaccount1"
                      value="exness">
                    <img class="form-check-label" for="flexRadioDefaultaccount1"
                      src="{{ asset('/images/Exness-Logo.png') }}">
                    <a target="_blank" href="https://www.exness.com">https://www.exness.com</a>
                  </div>

                  <div class="item">
                    <input class="form-check-input-video" name="account" type="radio" id="flexRadioDefaultaccount1"
                      value="vantage">
                    <img class="form-check-label" for="flexRadioDefaultaccount1"
                      src="{{ asset('/images/vantage_logo.webp') }}">
                    <a target="_blank" href="https://www.vantagemarkets.com">https://www.vantagemarkets.com</a>
                  </div>
                </div>
                <div class="step step3" id="step3" style="display: none;">
                  <div>
                    <div class="top">
                      <p class="up">How to create, and active your broker account on </p>
                      <img src="{{ asset('images/Exness-Logo.png') }}" width="100px" alt="" class="logo-video">
                    </div>
                    <div class="main">
                      <div>
                        <video class="video" id="video" src=https://www.youtube.com/embed/TebbLzfSUaY frameborder="0"
                          controls allow="accelerometer; encrypted-media; gyroscope;autoplay; muted;" allowfullscreen
                          style='max-width:600px;width:400px'></video>
                        <div>
                          <a id="link-pdf" href="#" target="_blank">
                            <img src="{{ asset('images/pdf-icon.png') }}" alt="" width="200px">
                          </a>
                          <img src="{{ asset('images/Exness-Logo.png') }}" alt="" width="100px"
                            class="logo-video">
                        </div>
                      </div>
                      <p>After you have actived your broker account and finalized your KYC process, go to
                        "Settings" in
                        your menu to upload your "account credentials" with to hace received in your email.</p>
                    </div>
                  </div>
                </div>
                <div class="step step4" id="step4" style="display: none;border:none;">
                  <div>
                    <h4 class="up">Settings</h4>
                    <h6>Broker Account Credentials</h6>
                    <p>Once you have funded your broker account, its time that the bot is going to be connected to your
                      Broker Account.
                    </p>
                    <p>For connecting to your trading account we need the credentials, login number, login password and
                      the name of the server of your broker.
                    </p>
                    <p>The bot can only <strong>trade</strong> with your account. İt can not withdraw your money.
                    </p>
                    <p>You must received an email from your broker after you have deposit your Money.
                      Check also your spam.
                    </p>
                    <p>Please fill up the next form and upload a screenshot of the credentials
                      you have received in your email.
                    </p>
                    <div class="form-4">
                      <div>
                        <div class="input-group input-group-sm mb-3">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Login Number</span>
                          <input type="text" class="form-control" aria-label="Sizing example input"
                            name="login_number" aria-describedby="inputGroup-sizing-sm" required>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Login Password</span>
                          <input type="text" class="form-control" aria-label="Sizing example input"
                            name="login_password" aria-describedby="inputGroup-sizing-sm" required>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Name Broker Server</span>
                          <input type="text" class="form-control" aria-label="Sizing example input"
                            name="server_address" aria-describedby="inputGroup-sizing-sm" required>
                        </div>
                      </div>
                      <div>
                        <div>
                          <span>
                            Upload Credentials Picture
                          </span>
                          <div class="image-input">
                            <input type="file" accept="image/*" id="imageInput" name="image">
                            <label for="imageInput" class="image-button"><i class="far fa-image"></i> Choose
                              image</label>
                            <img src="" class="image-preview">
                            <span class="change-image">Choose different image</span>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success up">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              @if (Count($packages) > 0)
                <div class="controls">
                  <button class="btn up" id="prev" disabled>Prev</button>
                  <button class="btn up" id="next" style="display: none;">Next</button>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
  </main>

  <script>
    const progress = document.getElementById('progress');
    const prev = document.getElementById('prev');
    const next = document.getElementById('next');
    const circles = document.querySelectorAll('.circle');
    let currentActive = 1;

    // document.getElementById('link-pdf').addEventListener('click', () => {
    //   window.location = document.getElementById('link-pdf').href;
    // });

    let inputsPackage = document.querySelectorAll('.form-check-input')
    inputsPackage.forEach(element => {
      element.addEventListener('click', (e) => {
        next.style.display = 'initial'
      });
    });

    let inputsVideo = document.querySelectorAll('.form-check-input-video')
    inputsVideo.forEach(element => {
      element.addEventListener('click', (e) => {
        let logo = document.querySelectorAll('.logo-video')
        let video = document.getElementById('video')
        next.style.display = 'initial'; //  

        if (e.target.value == 'blueberry') {
          logo.forEach(element => {
            element.src = "{{ asset('images/blueberry_logo.png') }}";
            video.src = "/images/video 1 english.mp4";
            document.getElementById('link-pdf').href = "{{ route('packages.baixaPdf', 'blueberrymarkets') }}"
          });
        }

        if (e.target.value == 'ic') {
          logo.forEach(element => {
            element.src = "{{ asset('images/ic-markets-logo.png') }}";
            video.src = "/images/video 1 english.mp4";
            document.getElementById('link-pdf').href = "{{ route('packages.baixaPdf', 'icmarkets') }}"
          });
        }

        if (e.target.value == 'exness') {
          logo.forEach(element => {
            element.src = "{{ asset('images/Exness-Logo.png') }}";
            video.src = "/images/video 1 english.mp4";
            document.getElementById('link-pdf').href = "{{ route('packages.baixaPdf', 'exness') }}"
          });
        }

        if (e.target.value == 'vantage') {
          logo.forEach(element => {
            element.src = "{{ asset('images/vantage_logo.webp') }}";
            video.src = "/images/video 1 english.mp4";
            document.getElementById('link-pdf').href = "{{ route('packages.baixaPdf', 'vantagemarkets') }}"
          });
        }
      })
    });

    next.addEventListener('click', () => {

      currentActive++

      if (currentActive > circles.length) {
        currentActive = circles.length;
      }

      update();
    });

    prev.addEventListener('click', () => {
      currentActive--

      // prevents currentActive from going below 1
      if (currentActive < 1) {
        currentActive = 1;
      }

      update();
    });

    function passStep($step) {
      let steps = document.querySelectorAll('.step');
      steps.forEach(element => {
        element.style.display = 'none';
      });
      document.getElementById(`step${$step}`).style.display = 'flex';
    }

    function update() {
      circles.forEach((circle, idx) => {
        if (idx < currentActive) {
          circle.classList.add('active')
        } else {
          circle.classList.remove('active')
        }

        switch (currentActive) {
          case 1:
            passStep(1);
            break;
          case 2:
            passStep(2);
            next.style.display = 'none';
            break;
          case 3:
            passStep(3);
            next.style.display = 'initial';
            break;
          case 4:
            passStep(4);
            next.style.display = 'none';
            break;

          default:
            passStep(1);
            break;
        }
      });

      const actives = document.querySelectorAll('.active');

      progress.style.width = (actives.length - 1) / (circles.length - 1) * 100 + '%';

      // disables prev when you can't go back further, disables next when there are no more steps
      if (currentActive === 1) {
        prev.disabled = true;
      } else if (currentActive === circles.length) {
        next.disabled = true;
      } else {
        prev.disabled = false;
        next.disabled = false;
      }
    };

    $('#imageInput').on('change', function() {
      $input = $(this);
      if ($input.val().length > 0) {
        fileReader = new FileReader();
        fileReader.onload = function(data) {
          $('.image-preview').attr('src', data.target.result);
        }
        fileReader.readAsDataURL($input.prop('files')[0]);
        $('.image-button').css('display', 'none');
        $('.image-preview').css('display', 'block');
        $('.change-image').css('display', 'block');
      }
    });

    $('.change-image').on('click', function() {
      $control = $(this);
      $('#imageInput').val('');
      $preview = $('.image-preview');
      $preview.attr('src', '');
      $preview.css('display', 'none');
      $control.css('display', 'none');
      $('.image-button').css('display', 'block');
    });
  </script>
@endsection
