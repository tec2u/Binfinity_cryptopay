@extends('layouts.app')

@section('content')
  <video autoplay muted loop class="bg_video">
    <source src="/videos/tigervideo.mp4" type="video/mp4">
  </video>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">


        <span class="login100-form-title p-b-48">
          <img class="imagetest" style="filter: brightness(0);" src="{{ asset('/images/tigle_logo2.png') }}" alt="">
        </span>
        <h4 class="title-login mt-3">{{ __('Reset Password') }}</h4>

        <form class="login100-form validate-form" method="POST" action="{{ route('password.update') }}">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">


          <div class="mb-3">
            <label for="email" class="form-label teste1234">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control form-register @error('email') is-invalid @enderror"
              name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label teste1234">{{ __('Password') }}</label>
            <input id="password" type="password"
              class="form-control form-register @error('password') is-invalid @enderror" name="password" required
              autocomplete="new-password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password-confirm" class="form-label teste1234">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control form-register" name="password_confirmation"
              required autocomplete="new-password">
          </div>


          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button type="submit" class="login100-form-btn">
                {{ __('Reset Password') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  @endsection
