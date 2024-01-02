@extends('layouts.app')

@section('content')
  <video autoplay muted loop class="bg_video">
    <source src="/videos/tigervideo.mp4" type="video/mp4">
  </video>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-reset100">
        <span class="login100-form-title p-b-48 mt-3">
          <img class="imagetest" style="filter: brightness(0);" src="{{ asset('/images/tigle_logo2.png') }}" alt="">
        </span>
        <h4 class="title-login">{{ __('Reset Password') }}</h4>
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif

        @if (session('email'))
          <div class="alert alert-warning" role="alert">
            {{ session('email') }}
          </div>
        @endif

        <form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}">
          @csrf

          <div class="wrap-input100 validate-input mt-5">
            <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email"
              value="{{ old('email') }}" required autocomplete="email" autofocus>
            <span class="focus-input100" data-placeholder="Email"></span>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button type="submit" class="login100-form-btn">
                {{ __('Send Password Reset Link') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
@endsection
