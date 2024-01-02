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

    .form-control.is-invalid {
      border-color: goldenrod;
      padding-right: calc(1.5em + 0.75rem);
      background-repeat: no-repeat;
      background-position: right calc(0.375em + 0.1875rem) center;
      background-size: calc(0.75em em + 0.375rem) calc(0.75em + 0.375rem);
      background-image: none !important;
    }
  </style>
  <video autoplay muted loop class="bg_video">
    <source src="/videos/tigervideo.mp4" type="video/mp4">
  </video>
  @include('flash::message')
  <div class="limiter py-5">
    <div class="container-login100">
      <div class="wrap-login100" style="width: 800px;">
        <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
          @csrf
          <span class="login100-form-title p-b-48">
            <img class="imagetest2" style="filter: brightness(9);" src="{{ asset('images/tigle_logo2.png') }}"
              alt="">
          </span>
          @if (isset($id))
            <h4 class="title-login mb-5">{{ __('Register with ') . $user->login }}</h4>
          @else
            <h4 class="title-login mb-5">{{ __('Register') }}</h4>
          @endif
          <div class="row g-3 px-2">

            <div class="col-lg-6">
              <label for="name" class="form-label teste1234">First Name<span style="color: brown">*</span></label>
              <input id="name" type="text" class="form-control form-register @error('name') is-invalid @enderror"
                placeholder="First Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                tabindex="1">
              <span for="name" class="focus-input100"></span>
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="col-lg-6">
              <label for="last_name" class="form-label teste1234">Last Name<span style="color: brown">*</span></label>
              <input id="last_name" type="text"
                class="form-control form-register @error('last_name') is-invalid @enderror" placeholder="Last Name"
                name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus
                tabindex="2">
              <span for="last_name" class="focus-input100"></span>
              @error('last_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            {{-- <div class="mb-3 mt-3">
                                <label for="address1" class="form-label teste1234">Address 1 <span style="color: brown">
                                        *</span>:</label>
                                <input id="address1" type="text"
                                    class="form-control form-register @error('address1') is-invalid @enderror"
                                    placeholder="Address 1" name="address1" value="{{ old('address1') }}" required
                    autocomplete="address1" tabindex="3">
                    <span for="address1" class="focus-input100"></span>
                    @error('address1')
                    <span class="invalid-feedback " role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    --}}
            {{-- <div class="mb-3 mt-3">
                                <label for="postcode " class="form-label teste1234">Postcode <span style="color: brown">
                                        *</span>:</label>
                                <input id="postcode" type="text"
                                    class="form-control form-register @error('postcode') is-invalid @enderror"
                                    placeholder="Postcode" name="postcode" value="{{ old('postcode') }}" required
                    autocomplete="postcode" tabindex="5">
                    <span for="postcode" class="focus-input100"></span>
                    @error('postcode')
                    <span class="invalid-feedback " role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div> --}}
            <div class="col-lg-6">
              <label class="form-label teste1234">Country <span style="color: brown">*</span></label>
              <select class="teste1234 form-register form-control" required name="country" tabindex="7">
                <option>Select Country</option>
                <option value="AF" @if (old('country') == 'AF') selected="selected" @endif>
                  Afghanistan</option>
                <option value="AX" @if (old('country') == 'AX') selected="selected" @endif>Aland
                  Islands</option>
                <option value="AL" @if (old('country') == 'AL') selected="selected" @endif>Albania
                </option>
                <option value="DZ" @if (old('country') == 'DZ') selected="selected" @endif>Algeria
                </option>
                <option value="AS" @if (old('country') == 'AS') selected="selected" @endif>American
                  Samoa</option>
                <option value="AD" @if (old('country') == 'AD') selected="selected" @endif>Andorra
                </option>
                <option value="AO" @if (old('country') == 'AO') selected="selected" @endif>Angola
                </option>
                <option value="AI" @if (old('country') == 'AI') selected="selected" @endif>Anguilla
                </option>
                <option value="AQ" @if (old('country') == 'AQ') selected="selected" @endif>
                  Antarctica</option>
                <option value="AG" @if (old('country') == 'AG') selected="selected" @endif>
                  Antigua and Barbuda
                </option>
                <option value="AR" @if (old('country') == 'AR') selected="selected" @endif>
                  Argentina</option>
                <option value="AM" @if (old('country') == 'AM') selected="selected" @endif>
                  Armenia</option>
                <option value="AW" @if (old('country') == 'AW') selected="selected" @endif>Aruba
                </option>
                <option value="AU" @if (old('country') == 'AU') selected="selected" @endif>
                  Australia</option>
                <option value="AT" @if (old('country') == 'AT') selected="selected" @endif>
                  Austria</option>
                <option value="AZ" @if (old('country') == 'AZ') selected="selected" @endif>
                  Azerbaijan</option>
                <option value="BS" @if (old('country') == 'BS') selected="selected" @endif>
                  Bahamas</option>
                <option value="BH" @if (old('country') == 'BH') selected="selected" @endif>
                  Bahrain</option>
                <option value="BD" @if (old('country') == 'BD') selected="selected" @endif>
                  Bangladesh</option>
                <option value="BB" @if (old('country') == 'BB') selected="selected" @endif>
                  Barbados</option>
                <option value="BY" @if (old('country') == 'BY') selected="selected" @endif>
                  Belarus</option>
                <option value="BE" @if (old('country') == 'BE') selected="selected" @endif>
                  Belgium</option>
                <option value="BZ" @if (old('country') == 'BZ') selected="selected" @endif>Belize
                </option>
                <option value="BJ" @if (old('country') == 'BJ') selected="selected" @endif>Benin
                </option>
                <option value="BM" @if (old('country') == 'BM') selected="selected" @endif>
                  Bermuda</option>
                <option value="BT" @if (old('country') == 'BT') selected="selected" @endif>Bhutan
                </option>
                <option value="BO" @if (old('country') == 'BO') selected="selected" @endif>
                  Bolivia</option>
                <option value="BQ" @if (old('country') == 'BQ') selected="selected" @endif>
                  Bonaire, Sint Eustatius
                  and Saba</option>
                <option value="BA" @if (old('country') == 'BA') selected="selected" @endif>Bosnia
                  and Herzegovina
                </option>
                <option value="BW" @if (old('country') == 'BW') selected="selected" @endif>
                  Botswana</option>
                <option value="BV" @if (old('country') == 'BV') selected="selected" @endif>Bouvet
                  Island</option>
                <option value="BR" @if (old('country') == 'BR') selected="selected" @endif>Brazil
                </option>
                <option value="IO" @if (old('country') == 'IO') selected="selected" @endif>
                  British Indian Ocean
                  Territory</option>
                <option value="BN" @if (old('country') == 'BN') selected="selected" @endif>Brunei
                  Darussalam
                </option>
                <option value="BG" @if (old('country') == 'BG') selected="selected" @endif>
                  Bulgaria</option>
                <option value="BF" @if (old('country') == 'BF') selected="selected" @endif>
                  Burkina Faso</option>
                <option value="BI" @if (old('country') == 'BI') selected="selected" @endif>
                  Burundi</option>
                <option value="KH" @if (old('country') == 'KH') selected="selected" @endif>
                  Cambodia</option>
                <option value="CM" @if (old('country') == 'CM') selected="selected" @endif>
                  Cameroon</option>
                <option value="CA" @if (old('country') == 'CA') selected="selected" @endif>
                  Canada</option>
                <option value="CV" @if (old('country') == 'CV') selected="selected" @endif>Cape
                  Verde</option>
                <option value="KY" @if (old('country') == 'KY') selected="selected" @endif>
                  Cayman Islands</option>
                <option value="CF" @if (old('country') == 'CF') selected="selected" @endif>
                  Central African Republic
                </option>
                <option value="TD" @if (old('country') == 'TD') selected="selected" @endif>Chad
                </option>
                <option value="CL" @if (old('country') == 'CL') selected="selected" @endif>Chile
                </option>
                <option value="CN" @if (old('country') == 'CN') selected="selected" @endif>China
                </option>
                <option value="CX" @if (old('country') == 'CX') selected="selected" @endif>
                  Christmas Island</option>
                <option value="CC" @if (old('country') == 'CC') selected="selected" @endif>Cocos
                  (Keeling) Islands
                </option>
                <option value="CO" @if (old('country') == 'CO') selected="selected" @endif>
                  Colombia</option>
                <option value="KM" @if (old('country') == 'KM') selected="selected" @endif>
                  Comoros</option>
                <option value="CG" @if (old('country') == 'CG') selected="selected" @endif>Congo
                </option>
                <option value="CD" @if (old('country') == 'CD') selected="selected" @endif>
                  Congo, Democratic
                  Republic of the Congo</option>
                <option value="CK" @if (old('country') == 'CK') selected="selected" @endif>Cook
                  Islands</option>
                <option value="CR" @if (old('country') == 'CR') selected="selected" @endif>Costa
                  Rica</option>
                <option value="CI" @if (old('country') == 'CI') selected="selected" @endif>Cote
                  D'Ivoire</option>
                <option value="HR" @if (old('country') == 'HR') selected="selected" @endif>
                  Croatia</option>
                <option value="CU" @if (old('country') == 'CU') selected="selected" @endif>Cuba
                </option>
                <option value="CW" @if (old('country') == 'CW') selected="selected" @endif>
                  Curacao</option>
                <option value="CY" @if (old('country') == 'CY') selected="selected" @endif>
                  Cyprus</option>
                <option value="CZ" @if (old('country') == 'CZ') selected="selected" @endif>Czech
                  Republic</option>
                <option value="DK" @if (old('country') == 'DK') selected="selected" @endif>
                  Denmark</option>
                <option value="DJ" @if (old('country') == 'DJ') selected="selected" @endif>
                  Djibouti</option>
                <option value="DM" @if (old('country') == 'DM') selected="selected" @endif>
                  Dominica</option>
                <option value="DO" @if (old('country') == 'DO') selected="selected" @endif>
                  Dominican Republic
                </option>
                <option value="EC" @if (old('country') == 'EC') selected="selected" @endif>
                  Ecuador</option>
                <option value="EG" @if (old('country') == 'EG') selected="selected" @endif>Egypt
                </option>
                <option value="SV" @if (old('country') == 'SV') selected="selected" @endif>El
                  Salvador</option>
                <option value="GQ" @if (old('country') == 'GQ') selected="selected" @endif>
                  Equatorial Guinea
                </option>
                <option value="ER" @if (old('country') == 'ER') selected="selected" @endif>
                  Eritrea</option>
                <option value="EE" @if (old('country') == 'EE') selected="selected" @endif>
                  Estonia</option>
                <option value="ET" @if (old('country') == 'ET') selected="selected" @endif>
                  Ethiopia</option>
                <option value="FK" @if (old('country') == 'FK') selected="selected" @endif>
                  Falkland Islands
                  (Malvinas)</option>
                <option value="FO" @if (old('country') == 'FO') selected="selected" @endif>Faroe
                  Islands</option>
                <option value="FJ" @if (old('country') == 'FJ') selected="selected" @endif>Fiji
                </option>
                <option value="FI" @if (old('country') == 'FI') selected="selected" @endif>
                  Finland</option>
                <option value="FR" @if (old('country') == 'FR') selected="selected" @endif>
                  France</option>
                <option value="GF" @if (old('country') == 'GF') selected="selected" @endif>
                  French Guiana</option>
                <option value="PF" @if (old('country') == 'PF') selected="selected" @endif>
                  French Polynesia</option>
                <option value="TF" @if (old('country') == 'TF') selected="selected" @endif>
                  French Southern
                  Territories</option>
                <option value="GA" @if (old('country') == 'GA') selected="selected" @endif>Gabon
                </option>
                <option value="GM" @if (old('country') == 'GM') selected="selected" @endif>
                  Gambia</option>
                <option value="GE" @if (old('country') == 'GE') selected="selected" @endif>
                  Georgia</option>
                <option value="DE" @if (old('country') == 'DE') selected="selected" @endif>
                  Germany</option>
                <option value="GH" @if (old('country') == 'GH') selected="selected" @endif>Ghana
                </option>
                <option value="GI" @if (old('country') == 'GI') selected="selected" @endif>
                  Gibraltar</option>
                <option value="GR" @if (old('country') == 'GR') selected="selected" @endif>
                  Greece</option>
                <option value="GL" @if (old('country') == 'GL') selected="selected" @endif>
                  Greenland</option>
                <option value="GD" @if (old('country') == 'GD') selected="selected" @endif>
                  Grenada</option>
                <option value="GP" @if (old('country') == 'GP') selected="selected" @endif>
                  Guadeloupe</option>
                <option value="GU" @if (old('country') == 'GU') selected="selected" @endif>Guam
                </option>
                <option value="GT" @if (old('country') == 'GT') selected="selected" @endif>
                  Guatemala</option>
                <option value="GG" @if (old('country') == 'GG') selected="selected" @endif>
                  Guernsey</option>
                <option value="GN" @if (old('country') == 'GN') selected="selected" @endif>
                  Guinea</option>
                <option value="GW" @if (old('country') == 'GW') selected="selected" @endif>
                  Guinea-Bissau</option>
                <option value="GY" @if (old('country') == 'GY') selected="selected" @endif>
                  Guyana</option>
                <option value="HT" @if (old('country') == 'HT') selected="selected" @endif>Haiti
                </option>
                <option value="HM" @if (old('country') == 'HM') selected="selected" @endif>Heard
                  Island and Mcdonald
                  Islands</option>
                <option value="VA" @if (old('country') == 'VA') selected="selected" @endif>Holy
                  See (Vatican City
                  State)</option>
                <option value="HN" @if (old('country') == 'HN') selected="selected" @endif>
                  Honduras</option>
                <option value="HK" @if (old('country') == 'HK') selected="selected" @endif>
                  Hong Kong</option>
                <option value="HU" @if (old('country') == 'HU') selected="selected" @endif>
                  Hungary</option>
                <option value="IS" @if (old('country') == 'IS') selected="selected" @endif>
                  Iceland</option>
                <option value="IN" @if (old('country') == 'IN') selected="selected" @endif>
                  India</option>
                <option value="ID" @if (old('country') == 'ID') selected="selected" @endif>
                  Indonesia</option>
                <option value="IR" @if (old('country') == 'IR') selected="selected" @endif>
                  Iran, Islamic Republic
                  of</option>
                <option value="IQ" @if (old('country') == 'IQ') selected="selected" @endif>
                  Iraq</option>
                <option value="IE" @if (old('country') == 'IE') selected="selected" @endif>
                  Ireland</option>
                <option value="IM" @if (old('country') == 'IM') selected="selected" @endif>
                  Isle of Man</option>
                <option value="IL" @if (old('country') == 'IL') selected="selected" @endif>
                  Israel</option>
                <option value="IT" @if (old('country') == 'IT') selected="selected" @endif>
                  Italy</option>
                <option value="JM" @if (old('country') == 'JM') selected="selected" @endif>
                  Jamaica</option>
                <option value="JP" @if (old('country') == 'JP') selected="selected" @endif>
                  Japan</option>
                <option value="JE" @if (old('country') == 'JE') selected="selected" @endif>
                  Jersey</option>
                <option value="JO" @if (old('country') == 'JO') selected="selected" @endif>
                  Jordan</option>
                <option value="KZ" @if (old('country') == 'KZ') selected="selected" @endif>
                  Kazakhstan</option>
                <option value="KE" @if (old('country') == 'KE') selected="selected" @endif>
                  Kenya</option>
                <option value="KI" @if (old('country') == 'KI') selected="selected" @endif>
                  Kiribati</option>
                <option value="KP" @if (old('country') == 'KP') selected="selected" @endif>
                  Korea, Democratic
                  People's Republic of</option>
                <option value="KR" @if (old('country') == 'KR') selected="selected" @endif>
                  Korea, Republic of
                </option>
                <option value="XK" @if (old('country') == 'XK') selected="selected" @endif>
                  Kosovo</option>
                <option value="KW" @if (old('country') == 'KW') selected="selected" @endif>
                  Kuwait</option>
                <option value="KG" @if (old('country') == 'KG') selected="selected" @endif>
                  Kyrgyzstan</option>
                <option value="LA" @if (old('country') == 'LA') selected="selected" @endif>Lao
                  People's Democratic
                  Republic</option>
                <option value="LV" @if (old('country') == 'LV') selected="selected" @endif>
                  Latvia</option>
                <option value="LB" @if (old('country') == 'LB') selected="selected" @endif>
                  Lebanon</option>
                <option value="LS" @if (old('country') == 'LS') selected="selected" @endif>
                  Lesotho</option>
                <option value="LR" @if (old('country') == 'LR') selected="selected" @endif>
                  Liberia</option>
                <option value="LY" @if (old('country') == 'LY') selected="selected" @endif>
                  Libyan Arab Jamahiriya
                </option>
                <option value="LI" @if (old('country') == 'LI') selected="selected" @endif>
                  Liechtenstein</option>
                <option value="LT" @if (old('country') == 'LT') selected="selected" @endif>
                  Lithuania</option>
                <option value="LU" @if (old('country') == 'LU') selected="selected" @endif>
                  Luxembourg</option>
                <option value="MO" @if (old('country') == 'MO') selected="selected" @endif>
                  Macao</option>
                <option value="MK" @if (old('country') == 'MK') selected="selected" @endif>
                  Macedonia, the Former
                  Yugoslav Republic of</option>
                <option value="MG" @if (old('country') == 'MG') selected="selected" @endif>
                  Madagascar</option>
                <option value="MW" @if (old('country') == 'MW') selected="selected" @endif>
                  Malawi</option>
                <option value="MY" @if (old('country') == 'MY') selected="selected" @endif>
                  Malaysia</option>
                <option value="MV" @if (old('country') == 'MV') selected="selected" @endif>
                  Maldives</option>
                <option value="ML" @if (old('country') == 'ML') selected="selected" @endif>
                  Mali</option>
                <option value="MT" @if (old('country') == 'MT') selected="selected" @endif>
                  Malta</option>
                <option value="MH" @if (old('country') == 'MH') selected="selected" @endif>
                  Marshall Islands
                </option>
                <option value="MQ" @if (old('country') == 'MQ') selected="selected" @endif>
                  Martinique</option>
                <option value="MR" @if (old('country') == 'MR') selected="selected" @endif>
                  Mauritania</option>
                <option value="MU" @if (old('country') == 'MU') selected="selected" @endif>
                  Mauritius</option>
                <option value="YT" @if (old('country') == 'YT') selected="selected" @endif>
                  Mayotte</option>
                <option value="MX" @if (old('country') == 'MX') selected="selected" @endif>
                  Mexico</option>
                <option value="FM" @if (old('country') == 'FM') selected="selected" @endif>
                  Micronesia, Federated
                  States of</option>
                <option value="MD" @if (old('country') == 'MD') selected="selected" @endif>
                  Moldova, Republic of
                </option>
                <option value="MC" @if (old('country') == 'MC') selected="selected" @endif>
                  Monaco</option>
                <option value="MN" @if (old('country') == 'MN') selected="selected" @endif>
                  Mongolia</option>
                <option value="ME" @if (old('country') == 'ME') selected="selected" @endif>
                  Montenegro</option>
                <option value="MS" @if (old('country') == 'MS') selected="selected" @endif>
                  Montserrat</option>
                <option value="MA" @if (old('country') == 'MA') selected="selected" @endif>
                  Morocco</option>
                <option value="MZ" @if (old('country') == 'MZ') selected="selected" @endif>
                  Mozambique</option>
                <option value="MM" @if (old('country') == 'MM') selected="selected" @endif>
                  Myanmar</option>
                <option value="NA" @if (old('country') == 'NA') selected="selected" @endif>
                  Namibia</option>
                <option value="NR" @if (old('country') == 'NR') selected="selected" @endif>
                  Nauru</option>
                <option value="NP" @if (old('country') == 'NP') selected="selected" @endif>
                  Nepal</option>
                <option value="NL" @if (old('country') == 'NL') selected="selected" @endif>
                  Netherlands</option>
                <option value="AN" @if (old('country') == 'AN') selected="selected" @endif>
                  Netherlands Antilles
                </option>
                <option value="NC" @if (old('country') == 'NC') selected="selected" @endif>New
                  Caledonia</option>
                <option value="NZ" @if (old('country') == 'NZ') selected="selected" @endif>New
                  Zealand</option>
                <option value="NI" @if (old('country') == 'NI') selected="selected" @endif>
                  Nicaragua</option>
                <option value="NE" @if (old('country') == 'NE') selected="selected" @endif>
                  Niger</option>
                <option value="NG" @if (old('country') == 'NG') selected="selected" @endif>
                  Nigeria</option>
                <option value="NU" @if (old('country') == 'NU') selected="selected" @endif>
                  Niue</option>
                <option value="NF" @if (old('country') == 'NF') selected="selected" @endif>
                  Norfolk Island</option>
                <option value="MP" @if (old('country') == 'MP') selected="selected" @endif>
                  Northern Mariana
                  Islands</option>
                <option value="NO" @if (old('country') == 'NO') selected="selected" @endif>
                  Norway</option>
                <option value="OM" @if (old('country') == 'OM') selected="selected" @endif>
                  Oman</option>
                <option value="PK" @if (old('country') == 'PK') selected="selected" @endif>
                  Pakistan</option>
                <option value="PW" @if (old('country') == 'PW') selected="selected" @endif>
                  Palau</option>
                <option value="PS" @if (old('country') == 'PS') selected="selected" @endif>
                  Palestinian Territory,
                  Occupied</option>
                <option value="PA" @if (old('country') == 'PA') selected="selected" @endif>
                  Panama</option>
                <option value="PG" @if (old('country') == 'PG') selected="selected" @endif>
                  Papua New Guinea
                </option>
                <option value="PY" @if (old('country') == 'PY') selected="selected" @endif>
                  Paraguay</option>
                <option value="PE" @if (old('country') == 'PE') selected="selected" @endif>
                  Peru</option>
                <option value="PH" @if (old('country') == 'PH') selected="selected" @endif>
                  Philippines</option>
                <option value="PN" @if (old('country') == 'PN') selected="selected" @endif>
                  Pitcairn</option>
                <option value="PL" @if (old('country') == 'PL') selected="selected" @endif>
                  Poland</option>
                <option value="PT" @if (old('country') == 'PT') selected="selected" @endif>
                  Portugal</option>
                <option value="PR" @if (old('country') == 'PR') selected="selected" @endif>
                  Puerto Rico</option>
                <option value="QA" @if (old('country') == 'QA') selected="selected" @endif>
                  Qatar</option>
                <option value="RE" @if (old('country') == 'RE') selected="selected" @endif>
                  Reunion</option>
                <option value="RO" @if (old('country') == 'RO') selected="selected" @endif>
                  Romania</option>
                <option value="RU" @if (old('country') == 'RU') selected="selected" @endif>
                  Russian Federation
                </option>
                <option value="RW" @if (old('country') == 'RW') selected="selected" @endif>
                  Rwanda</option>
                <option value="BL" @if (old('country') == 'BL') selected="selected" @endif>
                  Saint Barthelemy
                </option>
                <option value="SH" @if (old('country') == 'SH') selected="selected" @endif>
                  Saint Helena</option>
                <option value="KN" @if (old('country') == 'KN') selected="selected" @endif>
                  Saint Kitts and Nevis
                </option>
                <option value="LC" @if (old('country') == 'LC') selected="selected" @endif>
                  Saint Lucia</option>
                <option value="MF" @if (old('country') == 'MF') selected="selected" @endif>
                  Saint Martin</option>
                <option value="PM" @if (old('country') == 'PM') selected="selected" @endif>
                  Saint Pierre and
                  Miquelon</option>
                <option value="VC" @if (old('country') == 'VC') selected="selected" @endif>
                  Saint Vincent and the
                  Grenadines</option>
                <option value="WS" @if (old('country') == 'WS') selected="selected" @endif>
                  Samoa</option>
                <option value="SM" @if (old('country') == 'SM') selected="selected" @endif>San
                  Marino</option>
                <option value="ST" @if (old('country') == 'ST') selected="selected" @endif>Sao
                  Tome and Principe
                </option>
                <option value="SA" @if (old('country') == 'SA') selected="selected" @endif>
                  Saudi Arabia</option>
                <option value="SN" @if (old('country') == 'SN') selected="selected" @endif>
                  Senegal</option>
                <option value="RS" @if (old('country') == 'RS') selected="selected" @endif>
                  Serbia</option>
                <option value="CS" @if (old('country') == 'CS') selected="selected" @endif>
                  Serbia and Montenegro
                </option>
                <option value="SC" @if (old('country') == 'SC') selected="selected" @endif>
                  Seychelles</option>
                <option value="SL" @if (old('country') == 'SL') selected="selected" @endif>
                  Sierra Leone</option>
                <option value="SG" @if (old('country') == 'SG') selected="selected" @endif>
                  Singapore</option>
                <option value="SX" @if (old('country') == 'SX') selected="selected" @endif>
                  Sint Maarten</option>
                <option value="SK" @if (old('country') == 'SK') selected="selected" @endif>
                  Slovakia</option>
                <option value="SI" @if (old('country') == 'SI') selected="selected" @endif>
                  Slovenia</option>
                <option value="SB" @if (old('country') == 'SB') selected="selected" @endif>
                  Solomon Islands
                </option>
                <option value="SO" @if (old('country') == 'SO') selected="selected" @endif>
                  Somalia</option>
                <option value="ZA" @if (old('country') == 'ZA') selected="selected" @endif>
                  South Africa</option>
                <option value="GS" @if (old('country') == 'GS') selected="selected" @endif>
                  South Georgia and the
                  South Sandwich Islands</option>
                <option value="SS" @if (old('country') == 'SS') selected="selected" @endif>
                  South Sudan</option>
                <option value="ES" @if (old('country') == 'ES') selected="selected" @endif>
                  Spain</option>
                <option value="LK" @if (old('country') == 'LK') selected="selected" @endif>Sri
                  Lanka</option>
                <option value="SD" @if (old('country') == 'SD') selected="selected" @endif>
                  Sudan</option>
                <option value="SR" @if (old('country') == 'SR') selected="selected" @endif>
                  Suriname</option>
                <option value="SJ" @if (old('country') == 'SJ') selected="selected" @endif>
                  Svalbard and Jan Mayen
                </option>
                <option value="SZ" @if (old('country') == 'SZ') selected="selected" @endif>
                  Swaziland</option>
                <option value="SE" @if (old('country') == 'SE') selected="selected" @endif>
                  Sweden</option>
                <option value="CH" @if (old('country') == 'CH') selected="selected" @endif>
                  Switzerland</option>
                <option value="SY" @if (old('country') == 'SY') selected="selected" @endif>
                  Syrian Arab Republic
                </option>
                <option value="TW" @if (old('country') == 'TW') selected="selected" @endif>
                  Taiwan, Province of
                  China</option>
                <option value="TJ" @if (old('country') == 'TJ') selected="selected" @endif>
                  Tajikistan</option>
                <option value="TZ" @if (old('country') == 'TZ') selected="selected" @endif>
                  Tanzania, United
                  Republic of</option>
                <option value="TH" @if (old('country') == 'TH') selected="selected" @endif>
                  Thailand</option>
                <option value="TL" @if (old('country') == 'TL') selected="selected" @endif>
                  Timor-Leste</option>
                <option value="TG" @if (old('country') == 'TG') selected="selected" @endif>
                  Togo</option>
                <option value="TK" @if (old('country') == 'TK') selected="selected" @endif>
                  Tokelau</option>
                <option value="TO" @if (old('country') == 'TO') selected="selected" @endif>
                  Tonga</option>
                <option value="TT" @if (old('country') == 'TT') selected="selected" @endif>
                  Trinidad and Tobago
                </option>
                <option value="TN" @if (old('country') == 'TN') selected="selected" @endif>
                  Tunisia</option>
                <option value="TR" @if (old('country') == 'TR') selected="selected" @endif>
                  Turkey</option>
                <option value="TM" @if (old('country') == 'TM') selected="selected" @endif>
                  Turkmenistan</option>
                <option value="TC" @if (old('country') == 'TC') selected="selected" @endif>
                  Turks and Caicos
                  Islands</option>
                <option value="TV" @if (old('country') == 'TV') selected="selected" @endif>
                  Tuvalu</option>
                <option value="UG" @if (old('country') == 'UG') selected="selected" @endif>
                  Uganda</option>
                <option value="UA" @if (old('country') == 'UA') selected="selected" @endif>
                  Ukraine</option>
                <option value="AE" @if (old('country') == 'AE') selected="selected" @endif>
                  United Arab Emirates
                </option>
                <option value="GB" @if (old('country') == 'GB') selected="selected" @endif>
                  United Kingdom</option>
                <option value="US" @if (old('country') == 'US') selected="selected" @endif>
                  United States of America</option>
                <option value="UY" @if (old('country') == 'UY') selected="selected" @endif>
                  Uruguay</option>
                <option value="UZ" @if (old('country') == 'UZ') selected="selected" @endif>
                  Uzbekistan</option>
                <option value="VU" @if (old('country') == 'VU') selected="selected" @endif>
                  Vanuatu</option>
                <option value="VE" @if (old('country') == 'VE') selected="selected" @endif>
                  Venezuela</option>
                <option value="VN" @if (old('country') == 'VN') selected="selected" @endif>
                  Viet Nam</option>
                <option value="VG" @if (old('country') == 'VG') selected="selected" @endif>
                  Virgin Islands, British
                </option>
                <option value="VI" @if (old('country') == 'VI') selected="selected" @endif>
                  Virgin Islands, U.s.
                </option>
                <option value="WF" @if (old('country') == 'WF') selected="selected" @endif>
                  Wallis and Futuna
                </option>
                <option value="EH" @if (old('country') == 'EH') selected="selected" @endif>
                  Western Sahara</option>
                <option value="YE" @if (old('country') == 'YE') selected="selected" @endif>
                  Yemen</option>
                <option value="ZM" @if (old('country') == 'ZM') selected="selected" @endif>
                  Zambia</option>
                <option value="ZW" @if (old('country') == 'ZW') selected="selected" @endif>
                  Zimbabwe</option>

              </select>
            </div>
            <div class="col-lg-6">
              <label for="city" class="form-label teste1234">City<span style="color: brown">*
                </span></label>
              <input id="city" type="text"
                class="form-control form-register @error('city') is-invalid @enderror" placeholder="City"
                name="city" value="{{ old('city') }}" required autocomplete="city" tabindex="8">
              <span for="city" class="focus-input100"></span>
              @error('city')
                <span class="invalid-feedback " role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="col-lg-6">
              <label for="login" class="form-label teste1234">Username<span style="color: brown">*
                </span></label>
              <input id="login" type="text"
                class="form-control form-register login @error('login') is-invalid @enderror" placeholder="Username"
                name="login" value="{{ old('login') }}" required autocomplete="login" autofocus tabindex="13"
                onkeypress="allowAlphaNumeric(event)">
              <span for="login" class="focus-input100"></span>
              @error('login')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="col-lg-6">
              <label for="cell" class="form-label teste1234">Phone<span style="color: brown">* </span>
                (Just Numbers)</label>
              <input id="cell" type="cell"
                class="form-control form-register @error('cell') is-invalid @enderror" placeholder="Phone"
                name="cell" value="{{ old('cell') }}" required autocomplete="cell" tabindex="10">
              <span for="cell" class="focus-input100"></span>
              @error('cell')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            @if (isset($id))
              <div class="wrap-input100 validate-input" style="display: none;">
                <input id="recommendation_user_id" type="text" class="input100" name="recommendation_user_id"
                  value="{{ $id }}" autofocus>
                <span for="recommendation_user_id" class="focus-input100"
                  data-placeholder="Recommendation User Id"></span>
              </div>
            @else
              <div class="col-lg-6">
                <label for="recommendation_user_id" class="form-label teste1234">Referral Username</label>
                <input id="recommendation_user_id" type="text" class="form-control form-register"
                  name="recommendation_user_id" placeholder="Referral Username"
                  value="{{ old('recommendation_user_id') }}" autofocus tabindex="18"
                  onkeypress="allowAlphaNumeric(event)">
                <span for="recommendation_user_id" class="focus-input100"></span>
              </div>
            @endif

            <div class="col-lg-6">
              <label for="email" class="form-label teste1234">Email<span style="color: brown">*</span></label>
              <input id="email" type="email"
                class="form-control form-register @error('email') is-invalid @enderror" placeholder="Email"
                name="email" value="{{ old('email') }}" required autocomplete="email" tabindex="14">
              <span for="email" class="focus-input100"></span>
              @error('email')
                <span class="invalid-feedback " role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="col-lg-6">
              <label for="password" class="form-label teste1234">Password<span style="color: brown">*</span></label>
              <span class="btn-show-pass d-inline-flex ps-2">
                <i class="fa fa-eye" id="togglePassword"></i>
              </span>
              <input id="password" type="password"
                class="form-control form-register @error('password') iconreg is-invalid  @enderror"
                placeholder="Password" name="password" required autocomplete="new-password" tabindex="15">

              <span for="password" class="focus-input100"></span>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="col-lg-6">
              <label for=" password-confirm" class="form-label teste1234">Confirm Password<span
                  style="color: brown">*</span></label>
              <span class="btn-show-pass d-inline-flex ps-2">
                <i class="fa fa-eye" id="togglePasswordconfim"></i>
              </span>
              <input id="password-confirm" type="password" class="form-control form-register"
                placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password"
                tabindex="16">
              <span for="password-confirm" class="focus-input100"></span>
            </div>

            {{-- <div class="mb-3 mt-3">
                                <label for="telephone" class="form-label teste1234">Telephone <span style="color: brown">
                                    </span>:</label>
                                <input id="telephone" type="telephone"
                                    class="form-control form-register @error('telephone') is-invalid @enderror"
                                    placeholder="Telephone" name="telephone" value="{{ old('telephone') }}"
                autocomplete="telephone" tabindex="9">
                <span for="telephone" class="focus-input100"></span>
                @error('telephone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div> --}}
            {{-- <div class="mb-3 mt-3">
                                <label for="birthday" class="form-label teste1234">Date of birth <span
                                        style="color: brown"> *</span>:</label>
                                <input id="birthday" type="text"
                                    class="form-control form-register @error('birthday') is-invalid @enderror"
                                    name="birthday" value="{{ old('birthday') }}" readonly="readonly" required
        autocomplete="birthday" placeholder="dd/mm/yyyy" value="" tabindex="11">
        <span id="lblError" style="color:Red"></span>
        @error('birthday')
        <span class="invalid-feedback " role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> --}}


          </div>
          <div class="p-4">

            {{-- <div class="mb-3 mt-3">
                                <label for="address2" class="form-label teste1234">Address 2:</label>
                                <input id="address2" type="text"
                                    class="form-control form-register @error('address2') is-invalid @enderror"
                                    placeholder="Address 2" name="address2" value="{{ old('address2') }}"
    autocomplete="address2" tabindex="4">
    <span for="address2" class="focus-input100"></span>
    @error('address2')
    <span class="invalid-feedback " role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div> --}}

            {{-- <div class="mb-3 mt-3">
                                <label for="state" class="form-label teste1234">State <span style="color: brown">
                                        *</span>:</label>
                                <input id="state" type="text"
                                    class="form-control form-register @error('state') is-invalid @enderror"
                                    placeholder="State" name="state" value="{{ old('state') }}" required
autocomplete="state" tabindex="6">
<span for="state" class="focus-input100"></span>
@error('state')
<span class="invalid-feedback " role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
</div> --}}

            {{-- <div class="mb-3 mt-3">
                                <label class="form-label teste1234">Gender <span style="color: brown"> *</span>:</label>
                                <select class="teste1234 form-register form-control" required name="gender"
                                    tabindex="12">
                                    <option>Select</option>
                                    <option value="M" @if (old('gender') == 'M') selected="selected" @endif>
                                        Male</option>
                                    <option value="F" @if (old('gender') == 'F') selected="selected" @endif>
                                        Female</option>
                                </select>
                            </div> --}}

            {{-- <div class="mb-3 mt-3">
                            <label for="ssn" class="form-label teste1234">SSN <span style="color: brown"> *</span>:</label>
                            <input id="ssn" type="text" class="form-control form-register @error('ssn') is-invalid @enderror" placeholder="SSN" name="ssn" value="{{ old('ssn') }}" required autocomplete="ssn">
<span for="ssn" class="focus-input100"></span>
@error('ssn')
<span class="invalid-feedback " role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
</div> --}}

          </div>
          {{-- <div class="row my-5">
                            <div class="col-12 my-2 py-2 fontregi">
                                <div id="carouselExampleControls" class="carousel carousel-fade" data-interval="0"
                                    data-bs-touch="false">
                                    <div class="carousel-inner">
                                        @foreach ($packages as $package)
                                            <div class="text-center">
                                                <div
                                                    class="carousel-item @if ($loop->index == 0) active @endif">
                                                    <h5 class="text-center mb-4 colorpkg">Tell us for our statistics which card you might order when we go live (this is no order):</h5>
                                                    <img src="{{ asset('storage/' . $package->img) }}" class="img-fluid"
style="width: 50%;" alt="...">
<h3 class="text-center mb-4 colorpkg">{{ $package->name }}</h3>
<div class="d-block mt-4">
    <input type="checkbox" class="check_teste" id="flexCheckChecked" name="id_card" value="{{ $package->id }}">
    <label class="label_check colorpkg" for="flexCheckChecked">Choose</label>
</div>
<h5 class="text-center mb-4 colorpkg">${{ $package->price }}</h5>
<h5 class="text-center mb-4 colorpkg" style="font-size: 12px;">
    {!! $package->long_description !!}</h5>
</div>
</div>
@endforeach
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon colorpkg" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>
</div>
<!-- <div class="text-center">
                                                                                <input type="radio" class="btn-check" name="options-outlined" id="card-1" autocomplete="off" checked>
                                                                                <label class="btn btn-outline-success" for="card-1">Card 1</label>
                                                                                <input type="radio" class="btn-check" name="options-outlined" id="card-2" autocomplete="off">
                                                                                <label class="btn btn-outline-success" for="card-2">Card 2</label>
                                                                                <input type="radio" class="btn-check" name="options-outlined" id="card-3" autocomplete="off">
                                                                                <label class="btn btn-outline-success" for="card-3">Card 3</label>
                                                                            </div> -->
</div>
</div> --}}
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button type="submit" class="login100-form-btn btn btn-primary rounded-pill">
                {{ __('Register') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script>
    document.getElementsByClassName('login')[0].addEventListener("change", function() {
      this.value = this.value.toLowerCase();
    });
  </script>
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
