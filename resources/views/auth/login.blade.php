@extends('layouts.app')
@section('content')
  <video autoplay muted loop class="bg_video">
    <source src="/videos/tigervideo.mp4" type="video/mp4">
  </video>

  @include('flash::message')

  <style>
    .limpa-cor {
      filter: grayscale(0%) !important;
      filter: sepia(0%) !important;
      filter: hue-rotate(0deg) !important;
      filter: invert(0%) !important;
      filter: brightness(100%) !important;
      color: #fff !important;
    }

    .limpa-cor::after,
    .limpa-cor::before {
      color: #fff !important;
    }
  </style>

  <div id="loginform" class="limiter">
    <div class="container-login100">
      <div class="wrap-login100" style="background-color: #2e869b">
        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
          @csrf
          <span class="login100-form-title p-b-48">
            <img class="imagetest" style="filter: brightness(9);" src="{{ asset('/images/tigle_logo2.png') }}"
              alt="">
          </span>
          <h4 class="title-login limpa-cor" style="color: #fff">{{ __('Login') }}</h4>
          <div class="wrap-input100 validate-input">

            <input id="email" type="email" style="color: #fff"
              class="limpa-cor input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
              required autocomplete="email" autofocus>
            <span class="focus-input100 limpa-cor" style="color: #fff" data-placeholder="Email"></span>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="wrap-input100 validate-input">
            <span class="btn-show-password">
              <i class="fa fa-eye"></i>
            </span>
            <input style="color: #fff" id="password" type="password"
              class="input100 limpa-cor @error('password') is-invalid @enderror" name="password" required
              autocomplete="current-password">
            <span style="color: #fff" class="focus-input100 limpa-cor" data-placeholder="Password"></span>

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="contact100-form-checkbox">
            <div class="input100">
              <input class="form-check-input checkcheck" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>

              <label class="form-check-label remember-title" for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn "></div>
              <button type="submit" class="login100-form-btn btn btn-primary rounded-pill">
                {{ __('Login') }}
              </button>
            </div>
            <div class="text-center p-t-115 mt-40">
              @if (Route::has('password.request'))
                <a class="txt2" href="{{ route('password.request') }}" style="color: #fff">
                  {{ __('Forgot Your Password?') }}
                </a>
              @endif
            </div>
          </div>
          <div class="text-center p-t-115">
            <span class="txt1" style="color: #fff">
              Don’t have an account?
            </span>

            <a class="txt2" href="{{ route('register') }}" style="color: #fff">
              Sign Up
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $('#flash-overlay-modal').modal();
  </script>
  <script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  </script>

  <script>
    (function($) {
      "use strict";


      /*==================================================================
      [ Focus input ]*/
      $('.input100').each(function() {
        $(this).on('blur', function() {
          if ($(this).val().trim() != "") {
            $(this).addClass('has-val');
          } else {
            $(this).removeClass('has-val');
          }
        })
      })

      /*==================================================================
      [ Show pass ]*/
      var showPass = 0;
      $('.btn-show-password').on('click', function() {
        if (showPass == 0) {
          $(this).next('input').attr('type', 'text');
          $(this).find('i').removeClass('fa-eye');
          $(this).find('i').addClass('fa-eye-slash');
          showPass = 1;
        } else {
          $(this).next('input').attr('type', 'password');
          $(this).find('i').addClass('fa-eye');
          $(this).find('i').removeClass('fa-eye-slash');
          showPass = 0;
        }

      });
    })(jQuery);
  </script>
@endsection
