@extends('layouts.app')
@section('content')
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
  <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
  <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet"
    type="text/css" />
  <style>
    input[type="date"]::-webkit-calendar-picker-indicator {
      cursor: pointer;
      filter: invert(0.8) brightness(50%) sepia(100%) saturate(10000%) hue-rotate(20deg);
    }

    .label_check {
      display: inline-block;
    }

    .check_teste {
      padding: 0;
      margin: 0;
      vertical-align: center;
      position: relative;
      top: 1px;
      overflow: hidden;
    }

    .list-group-item {
      color: #fff !important;
      background-color: #070707 !important;
      border: 1px solid rgba(56, 56, 56, 0.125)
    }
  </style>
  {{-- <video autoplay muted loop class="bg_video">
    <source src="/videos/infinitylogvideo.mp4" type="video/mp4">
  </video> --}}
  @include('flash::message')
  <div class="limiter">
    <div class="container-login100"
      style="background-image: url({{ asset('/assetsWelcome/images/tiger.jpeg') }});background-size:cover; ;margin:0">
      <div style="position: absolute; width: 100vw ;z-index:-1">
        {{-- <img src="{{ asset('/assetsWelcome/images/tiger.jpeg') }}" alt=""> --}}
      </div>
      <div class="wrap-login100" style="width: 800px;">
        <span class="login100-form-title p-b-48">
          <img class="imagetest2" src="{{ asset('/images/tigle_logo.png') }}" alt="">
        </span>
        <h4 class="title-login">{{ __('Register') }}</h4>
        <div class="row g-0">
        </div>
      </div>
    </div>
  </div>
  <script>
    function allowAlphaNumeric(e) {
      var code = ('charCode' in e) ? e.charCode : e.keyCode;
      if (!(code > 47 && code < 58) && // numeric (0-9)
        !(code > 64 && code < 91) && // upper alpha (A-Z)
        !(code > 96 && code < 123)) { // lower alpha (a-z)
        e.preventDefault();
      }
    }
  </script>
  <script>
    $(function() {
      $("#birthday").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        yearRange: '1900:+0',
        onSelect: function(dateString, txtDate) {
          ValidateDOB(dateString);
        }
      });
    });

    function ValidateDOB(dateString) {
      var lblError = $("#lblError");
      var parts = dateString.split("/");
      var dtDOB = new Date(parts[1] + "/" + parts[0] + "/" + parts[2]);
      var dtCurrent = new Date();
      lblError.html("Eligibility 18 years ONLY.")
      if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 18) {
        return false;
      }
      if (dtCurrent.getFullYear() - dtDOB.getFullYear() == 18) {
        //CD: 11/06/2018 and DB: 15/07/2000. Will turned 18 on 15/07/2018.
        if (dtCurrent.getMonth() < dtDOB.getMonth()) {
          return false;
        }
        if (dtCurrent.getMonth() == dtDOB.getMonth()) {
          //CD: 11/06/2018 and DB: 15/06/2000. Will turned 18 on 15/06/2018.
          if (dtCurrent.getDate() < dtDOB.getDate()) {
            return false;
          }
        }
      }
      lblError.html("");
      return true;
    }
  </script>
  <script>
    $(window).load(function() {
      $('#flash-overlay-modal').modal('show');
    });
  </script>
  <script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  </script>
  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', () => {
      // Toggle the type attribute using
      // getAttribure() method
      const type = password
        .getAttribute('type') === 'password' ?
        'text' : 'password';
      password.setAttribute('type', type);
    });
    const togglePasswordconf = document.querySelector('#togglePasswordconfim');
    const passwordconf = document.querySelector('#password-confirm');
    togglePasswordconf.addEventListener('click', () => {
      // Toggle the type attribute using
      // getAttribure() method
      const type = passwordconf
        .getAttribute('type') === 'password' ?
        'text' : 'password';
      passwordconf.setAttribute('type', type);
    });
  </script>
  <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
  <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
@endsection
