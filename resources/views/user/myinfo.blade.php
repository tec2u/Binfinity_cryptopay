@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="myinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1 class="up font">@lang('user.my_information')</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title up font">@lang('user.info')</h3>
                </div>
                <form class="row g-3 p-5" action="{{ route('users.update', ['id' => $user->id]) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.name')<span style="color: brown">*</span></label>
                    <input type="name" class="form-control" id="name" required name="name"
                      value="{{ $user->name }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.last_name')<span style="color: brown">*</span></label>
                    <input type="name" class="form-control" id="last_name" required name="last_name"
                      value="{{ $user->last_name }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">Birthday<span style="color: brown">*</span></label>
                    <input type="date" class="form-control" id="birthday" required name="birthday"
                      value="{{ $user->birthday }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">City<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="city" required name="city"
                      value="{{ $user->city }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.address1')<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="address1" required name="address1"
                      value="{{ $user->address1 }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.address2')<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="address2" required name="address2"
                      value="{{ $user->address2 }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.postcode')<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="postcode" required name="postcode"
                      value="{{ $user->postcode }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputname" class="form-label">@lang('user.state')<span style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="state" required name="state"
                      value="{{ $user->state }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputAddress" class="form-label">@lang('user.country')<span
                        style="color: brown">*</span></label>
                    <select class="form-control" id="country" required name="country" tabindex="7">
                      <option>Select Country</option>
                      <option value="AF" @if ($user->country == 'AF') selected="selected" @endif>
                        Afghanistan</option>
                      <option value="AX" @if ($user->country == 'AX') selected="selected" @endif>Aland
                        Islands</option>
                      <option value="AL" @if ($user->country == 'AL') selected="selected" @endif>Albania
                      </option>
                      <option value="DZ" @if ($user->country == 'DZ') selected="selected" @endif>Algeria
                      </option>
                      <option value="AS" @if ($user->country == 'AS') selected="selected" @endif>American
                        Samoa</option>
                      <option value="AD" @if ($user->country == 'AD') selected="selected" @endif>Andorra
                      </option>
                      <option value="AO" @if ($user->country == 'AO') selected="selected" @endif>Angola
                      </option>
                      <option value="AI" @if ($user->country == 'AI') selected="selected" @endif>Anguilla
                      </option>
                      <option value="AQ" @if ($user->country == 'AQ') selected="selected" @endif>
                        Antarctica</option>
                      <option value="AG" @if ($user->country == 'AG') selected="selected" @endif>
                        Antigua and Barbuda
                      </option>
                      <option value="AR" @if ($user->country == 'AR') selected="selected" @endif>
                        Argentina</option>
                      <option value="AM" @if ($user->country == 'AM') selected="selected" @endif>
                        Armenia</option>
                      <option value="AW" @if ($user->country == 'AW') selected="selected" @endif>Aruba
                      </option>
                      <option value="AU" @if ($user->country == 'AU') selected="selected" @endif>
                        Australia</option>
                      <option value="AT" @if ($user->country == 'AT') selected="selected" @endif>
                        Austria</option>
                      <option value="AZ" @if ($user->country == 'AZ') selected="selected" @endif>
                        Azerbaijan</option>
                      <option value="BS" @if ($user->country == 'BS') selected="selected" @endif>
                        Bahamas</option>
                      <option value="BH" @if ($user->country == 'BH') selected="selected" @endif>
                        Bahrain</option>
                      <option value="BD" @if ($user->country == 'BD') selected="selected" @endif>
                        Bangladesh</option>
                      <option value="BB" @if ($user->country == 'BB') selected="selected" @endif>
                        Barbados</option>
                      <option value="BY" @if ($user->country == 'BY') selected="selected" @endif>
                        Belarus</option>
                      <option value="BE" @if ($user->country == 'BE') selected="selected" @endif>
                        Belgium</option>
                      <option value="BZ" @if ($user->country == 'BZ') selected="selected" @endif>Belize
                      </option>
                      <option value="BJ" @if ($user->country == 'BJ') selected="selected" @endif>Benin
                      </option>
                      <option value="BM" @if ($user->country == 'BM') selected="selected" @endif>
                        Bermuda</option>
                      <option value="BT" @if ($user->country == 'BT') selected="selected" @endif>Bhutan
                      </option>
                      <option value="BO" @if ($user->country == 'BO') selected="selected" @endif>
                        Bolivia</option>
                      <option value="BQ" @if ($user->country == 'BQ') selected="selected" @endif>
                        Bonaire, Sint Eustatius
                        and Saba</option>
                      <option value="BA" @if ($user->country == 'BA') selected="selected" @endif>Bosnia
                        and Herzegovina
                      </option>
                      <option value="BW" @if ($user->country == 'BW') selected="selected" @endif>
                        Botswana</option>
                      <option value="BV" @if ($user->country == 'BV') selected="selected" @endif>Bouvet
                        Island</option>
                      <option value="BR" @if ($user->country == 'BR') selected="selected" @endif>Brazil
                      </option>
                      <option value="IO" @if ($user->country == 'IO') selected="selected" @endif>
                        British Indian Ocean
                        Territory</option>
                      <option value="BN" @if ($user->country == 'BN') selected="selected" @endif>Brunei
                        Darussalam
                      </option>
                      <option value="BG" @if ($user->country == 'BG') selected="selected" @endif>
                        Bulgaria</option>
                      <option value="BF" @if ($user->country == 'BF') selected="selected" @endif>
                        Burkina Faso</option>
                      <option value="BI" @if ($user->country == 'BI') selected="selected" @endif>
                        Burundi</option>
                      <option value="KH" @if ($user->country == 'KH') selected="selected" @endif>
                        Cambodia</option>
                      <option value="CM" @if ($user->country == 'CM') selected="selected" @endif>
                        Cameroon</option>
                      <option value="CA" @if ($user->country == 'CA') selected="selected" @endif>
                        Canada</option>
                      <option value="CV" @if ($user->country == 'CV') selected="selected" @endif>Cape
                        Verde</option>
                      <option value="KY" @if ($user->country == 'KY') selected="selected" @endif>
                        Cayman Islands</option>
                      <option value="CF" @if ($user->country == 'CF') selected="selected" @endif>
                        Central African Republic
                      </option>
                      <option value="TD" @if ($user->country == 'TD') selected="selected" @endif>Chad
                      </option>
                      <option value="CL" @if ($user->country == 'CL') selected="selected" @endif>Chile
                      </option>
                      <option value="CN" @if ($user->country == 'CN') selected="selected" @endif>China
                      </option>
                      <option value="CX" @if ($user->country == 'CX') selected="selected" @endif>
                        Christmas Island</option>
                      <option value="CC" @if ($user->country == 'CC') selected="selected" @endif>Cocos
                        (Keeling) Islands
                      </option>
                      <option value="CO" @if ($user->country == 'CO') selected="selected" @endif>
                        Colombia</option>
                      <option value="KM" @if ($user->country == 'KM') selected="selected" @endif>
                        Comoros</option>
                      <option value="CG" @if ($user->country == 'CG') selected="selected" @endif>Congo
                      </option>
                      <option value="CD" @if ($user->country == 'CD') selected="selected" @endif>
                        Congo, Democratic
                        Republic of the Congo</option>
                      <option value="CK" @if ($user->country == 'CK') selected="selected" @endif>Cook
                        Islands</option>
                      <option value="CR" @if ($user->country == 'CR') selected="selected" @endif>Costa
                        Rica</option>
                      <option value="CI" @if ($user->country == 'CI') selected="selected" @endif>Cote
                        D'Ivoire</option>
                      <option value="HR" @if ($user->country == 'HR') selected="selected" @endif>
                        Croatia</option>
                      <option value="CU" @if ($user->country == 'CU') selected="selected" @endif>Cuba
                      </option>
                      <option value="CW" @if ($user->country == 'CW') selected="selected" @endif>
                        Curacao</option>
                      <option value="CY" @if ($user->country == 'CY') selected="selected" @endif>
                        Cyprus</option>
                      <option value="CZ" @if ($user->country == 'CZ') selected="selected" @endif>Czech
                        Republic</option>
                      <option value="DK" @if ($user->country == 'DK') selected="selected" @endif>
                        Denmark</option>
                      <option value="DJ" @if ($user->country == 'DJ') selected="selected" @endif>
                        Djibouti</option>
                      <option value="DM" @if ($user->country == 'DM') selected="selected" @endif>
                        Dominica</option>
                      <option value="DO" @if ($user->country == 'DO') selected="selected" @endif>
                        Dominican Republic
                      </option>
                      <option value="EC" @if ($user->country == 'EC') selected="selected" @endif>
                        Ecuador</option>
                      <option value="EG" @if ($user->country == 'EG') selected="selected" @endif>Egypt
                      </option>
                      <option value="SV" @if ($user->country == 'SV') selected="selected" @endif>El
                        Salvador</option>
                      <option value="GQ" @if ($user->country == 'GQ') selected="selected" @endif>
                        Equatorial Guinea
                      </option>
                      <option value="ER" @if ($user->country == 'ER') selected="selected" @endif>
                        Eritrea</option>
                      <option value="EE" @if ($user->country == 'EE') selected="selected" @endif>
                        Estonia</option>
                      <option value="ET" @if ($user->country == 'ET') selected="selected" @endif>
                        Ethiopia</option>
                      <option value="FK" @if ($user->country == 'FK') selected="selected" @endif>
                        Falkland Islands
                        (Malvinas)</option>
                      <option value="FO" @if ($user->country == 'FO') selected="selected" @endif>Faroe
                        Islands</option>
                      <option value="FJ" @if ($user->country == 'FJ') selected="selected" @endif>Fiji
                      </option>
                      <option value="FI" @if ($user->country == 'FI') selected="selected" @endif>
                        Finland</option>
                      <option value="FR" @if ($user->country == 'FR') selected="selected" @endif>
                        France</option>
                      <option value="GF" @if ($user->country == 'GF') selected="selected" @endif>
                        French Guiana</option>
                      <option value="PF" @if ($user->country == 'PF') selected="selected" @endif>
                        French Polynesia</option>
                      <option value="TF" @if ($user->country == 'TF') selected="selected" @endif>
                        French Southern
                        Territories</option>
                      <option value="GA" @if ($user->country == 'GA') selected="selected" @endif>Gabon
                      </option>
                      <option value="GM" @if ($user->country == 'GM') selected="selected" @endif>
                        Gambia</option>
                      <option value="GE" @if ($user->country == 'GE') selected="selected" @endif>
                        Georgia</option>
                      <option value="DE" @if ($user->country == 'DE') selected="selected" @endif>
                        Germany</option>
                      <option value="GH" @if ($user->country == 'GH') selected="selected" @endif>Ghana
                      </option>
                      <option value="GI" @if ($user->country == 'GI') selected="selected" @endif>
                        Gibraltar</option>
                      <option value="GR" @if ($user->country == 'GR') selected="selected" @endif>
                        Greece</option>
                      <option value="GL" @if ($user->country == 'GL') selected="selected" @endif>
                        Greenland</option>
                      <option value="GD" @if ($user->country == 'GD') selected="selected" @endif>
                        Grenada</option>
                      <option value="GP" @if ($user->country == 'GP') selected="selected" @endif>
                        Guadeloupe</option>
                      <option value="GU" @if ($user->country == 'GU') selected="selected" @endif>Guam
                      </option>
                      <option value="GT" @if ($user->country == 'GT') selected="selected" @endif>
                        Guatemala</option>
                      <option value="GG" @if ($user->country == 'GG') selected="selected" @endif>
                        Guernsey</option>
                      <option value="GN" @if ($user->country == 'GN') selected="selected" @endif>
                        Guinea</option>
                      <option value="GW" @if ($user->country == 'GW') selected="selected" @endif>
                        Guinea-Bissau</option>
                      <option value="GY" @if ($user->country == 'GY') selected="selected" @endif>
                        Guyana</option>
                      <option value="HT" @if ($user->country == 'HT') selected="selected" @endif>Haiti
                      </option>
                      <option value="HM" @if ($user->country == 'HM') selected="selected" @endif>Heard
                        Island and Mcdonald
                        Islands</option>
                      <option value="VA" @if ($user->country == 'VA') selected="selected" @endif>Holy
                        See (Vatican City
                        State)</option>
                      <option value="HN" @if ($user->country == 'HN') selected="selected" @endif>
                        Honduras</option>
                      <option value="HK" @if ($user->country == 'HK') selected="selected" @endif>
                        Hong Kong</option>
                      <option value="HU" @if ($user->country == 'HU') selected="selected" @endif>
                        Hungary</option>
                      <option value="IS" @if ($user->country == 'IS') selected="selected" @endif>
                        Iceland</option>
                      <option value="IN" @if ($user->country == 'IN') selected="selected" @endif>
                        India</option>
                      <option value="ID" @if ($user->country == 'ID') selected="selected" @endif>
                        Indonesia</option>
                      <option value="IR" @if ($user->country == 'IR') selected="selected" @endif>
                        Iran, Islamic Republic
                        of</option>
                      <option value="IQ" @if ($user->country == 'IQ') selected="selected" @endif>
                        Iraq</option>
                      <option value="IE" @if ($user->country == 'IE') selected="selected" @endif>
                        Ireland</option>
                      <option value="IM" @if ($user->country == 'IM') selected="selected" @endif>
                        Isle of Man</option>
                      <option value="IL" @if ($user->country == 'IL') selected="selected" @endif>
                        Israel</option>
                      <option value="IT" @if ($user->country == 'IT') selected="selected" @endif>
                        Italy</option>
                      <option value="JM" @if ($user->country == 'JM') selected="selected" @endif>
                        Jamaica</option>
                      <option value="JP" @if ($user->country == 'JP') selected="selected" @endif>
                        Japan</option>
                      <option value="JE" @if ($user->country == 'JE') selected="selected" @endif>
                        Jersey</option>
                      <option value="JO" @if ($user->country == 'JO') selected="selected" @endif>
                        Jordan</option>
                      <option value="KZ" @if ($user->country == 'KZ') selected="selected" @endif>
                        Kazakhstan</option>
                      <option value="KE" @if ($user->country == 'KE') selected="selected" @endif>
                        Kenya</option>
                      <option value="KI" @if ($user->country == 'KI') selected="selected" @endif>
                        Kiribati</option>
                      <option value="KP" @if ($user->country == 'KP') selected="selected" @endif>
                        Korea, Democratic
                        People's Republic of</option>
                      <option value="KR" @if ($user->country == 'KR') selected="selected" @endif>
                        Korea, Republic of
                      </option>
                      <option value="XK" @if ($user->country == 'XK') selected="selected" @endif>
                        Kosovo</option>
                      <option value="KW" @if ($user->country == 'KW') selected="selected" @endif>
                        Kuwait</option>
                      <option value="KG" @if ($user->country == 'KG') selected="selected" @endif>
                        Kyrgyzstan</option>
                      <option value="LA" @if ($user->country == 'LA') selected="selected" @endif>Lao
                        People's Democratic
                        Republic</option>
                      <option value="LV" @if ($user->country == 'LV') selected="selected" @endif>
                        Latvia</option>
                      <option value="LB" @if ($user->country == 'LB') selected="selected" @endif>
                        Lebanon</option>
                      <option value="LS" @if ($user->country == 'LS') selected="selected" @endif>
                        Lesotho</option>
                      <option value="LR" @if ($user->country == 'LR') selected="selected" @endif>
                        Liberia</option>
                      <option value="LY" @if ($user->country == 'LY') selected="selected" @endif>
                        Libyan Arab Jamahiriya
                      </option>
                      <option value="LI" @if ($user->country == 'LI') selected="selected" @endif>
                        Liechtenstein</option>
                      <option value="LT" @if ($user->country == 'LT') selected="selected" @endif>
                        Lithuania</option>
                      <option value="LU" @if ($user->country == 'LU') selected="selected" @endif>
                        Luxembourg</option>
                      <option value="MO" @if ($user->country == 'MO') selected="selected" @endif>
                        Macao</option>
                      <option value="MK" @if ($user->country == 'MK') selected="selected" @endif>
                        Macedonia, the Former
                        Yugoslav Republic of</option>
                      <option value="MG" @if ($user->country == 'MG') selected="selected" @endif>
                        Madagascar</option>
                      <option value="MW" @if ($user->country == 'MW') selected="selected" @endif>
                        Malawi</option>
                      <option value="MY" @if ($user->country == 'MY') selected="selected" @endif>
                        Malaysia</option>
                      <option value="MV" @if ($user->country == 'MV') selected="selected" @endif>
                        Maldives</option>
                      <option value="ML" @if ($user->country == 'ML') selected="selected" @endif>
                        Mali</option>
                      <option value="MT" @if ($user->country == 'MT') selected="selected" @endif>
                        Malta</option>
                      <option value="MH" @if ($user->country == 'MH') selected="selected" @endif>
                        Marshall Islands
                      </option>
                      <option value="MQ" @if ($user->country == 'MQ') selected="selected" @endif>
                        Martinique</option>
                      <option value="MR" @if ($user->country == 'MR') selected="selected" @endif>
                        Mauritania</option>
                      <option value="MU" @if ($user->country == 'MU') selected="selected" @endif>
                        Mauritius</option>
                      <option value="YT" @if ($user->country == 'YT') selected="selected" @endif>
                        Mayotte</option>
                      <option value="MX" @if ($user->country == 'MX') selected="selected" @endif>
                        Mexico</option>
                      <option value="FM" @if ($user->country == 'FM') selected="selected" @endif>
                        Micronesia, Federated
                        States of</option>
                      <option value="MD" @if ($user->country == 'MD') selected="selected" @endif>
                        Moldova, Republic of
                      </option>
                      <option value="MC" @if ($user->country == 'MC') selected="selected" @endif>
                        Monaco</option>
                      <option value="MN" @if ($user->country == 'MN') selected="selected" @endif>
                        Mongolia</option>
                      <option value="ME" @if ($user->country == 'ME') selected="selected" @endif>
                        Montenegro</option>
                      <option value="MS" @if ($user->country == 'MS') selected="selected" @endif>
                        Montserrat</option>
                      <option value="MA" @if ($user->country == 'MA') selected="selected" @endif>
                        Morocco</option>
                      <option value="MZ" @if ($user->country == 'MZ') selected="selected" @endif>
                        Mozambique</option>
                      <option value="MM" @if ($user->country == 'MM') selected="selected" @endif>
                        Myanmar</option>
                      <option value="NA" @if ($user->country == 'NA') selected="selected" @endif>
                        Namibia</option>
                      <option value="NR" @if ($user->country == 'NR') selected="selected" @endif>
                        Nauru</option>
                      <option value="NP" @if ($user->country == 'NP') selected="selected" @endif>
                        Nepal</option>
                      <option value="NL" @if ($user->country == 'NL') selected="selected" @endif>
                        Netherlands</option>
                      <option value="AN" @if ($user->country == 'AN') selected="selected" @endif>
                        Netherlands Antilles
                      </option>
                      <option value="NC" @if ($user->country == 'NC') selected="selected" @endif>New
                        Caledonia</option>
                      <option value="NZ" @if ($user->country == 'NZ') selected="selected" @endif>New
                        Zealand</option>
                      <option value="NI" @if ($user->country == 'NI') selected="selected" @endif>
                        Nicaragua</option>
                      <option value="NE" @if ($user->country == 'NE') selected="selected" @endif>
                        Niger</option>
                      <option value="NG" @if ($user->country == 'NG') selected="selected" @endif>
                        Nigeria</option>
                      <option value="NU" @if ($user->country == 'NU') selected="selected" @endif>
                        Niue</option>
                      <option value="NF" @if ($user->country == 'NF') selected="selected" @endif>
                        Norfolk Island</option>
                      <option value="MP" @if ($user->country == 'MP') selected="selected" @endif>
                        Northern Mariana
                        Islands</option>
                      <option value="NO" @if ($user->country == 'NO') selected="selected" @endif>
                        Norway</option>
                      <option value="OM" @if ($user->country == 'OM') selected="selected" @endif>
                        Oman</option>
                      <option value="PK" @if ($user->country == 'PK') selected="selected" @endif>
                        Pakistan</option>
                      <option value="PW" @if ($user->country == 'PW') selected="selected" @endif>
                        Palau</option>
                      <option value="PS" @if ($user->country == 'PS') selected="selected" @endif>
                        Palestinian Territory,
                        Occupied</option>
                      <option value="PA" @if ($user->country == 'PA') selected="selected" @endif>
                        Panama</option>
                      <option value="PG" @if ($user->country == 'PG') selected="selected" @endif>
                        Papua New Guinea
                      </option>
                      <option value="PY" @if ($user->country == 'PY') selected="selected" @endif>
                        Paraguay</option>
                      <option value="PE" @if ($user->country == 'PE') selected="selected" @endif>
                        Peru</option>
                      <option value="PH" @if ($user->country == 'PH') selected="selected" @endif>
                        Philippines</option>
                      <option value="PN" @if ($user->country == 'PN') selected="selected" @endif>
                        Pitcairn</option>
                      <option value="PL" @if ($user->country == 'PL') selected="selected" @endif>
                        Poland</option>
                      <option value="PT" @if ($user->country == 'PT') selected="selected" @endif>
                        Portugal</option>
                      <option value="PR" @if ($user->country == 'PR') selected="selected" @endif>
                        Puerto Rico</option>
                      <option value="QA" @if ($user->country == 'QA') selected="selected" @endif>
                        Qatar</option>
                      <option value="RE" @if ($user->country == 'RE') selected="selected" @endif>
                        Reunion</option>
                      <option value="RO" @if ($user->country == 'RO') selected="selected" @endif>
                        Romania</option>
                      <option value="RU" @if ($user->country == 'RU') selected="selected" @endif>
                        Russian Federation
                      </option>
                      <option value="RW" @if ($user->country == 'RW') selected="selected" @endif>
                        Rwanda</option>
                      <option value="BL" @if ($user->country == 'BL') selected="selected" @endif>
                        Saint Barthelemy
                      </option>
                      <option value="SH" @if ($user->country == 'SH') selected="selected" @endif>
                        Saint Helena</option>
                      <option value="KN" @if ($user->country == 'KN') selected="selected" @endif>
                        Saint Kitts and Nevis
                      </option>
                      <option value="LC" @if ($user->country == 'LC') selected="selected" @endif>
                        Saint Lucia</option>
                      <option value="MF" @if ($user->country == 'MF') selected="selected" @endif>
                        Saint Martin</option>
                      <option value="PM" @if ($user->country == 'PM') selected="selected" @endif>
                        Saint Pierre and
                        Miquelon</option>
                      <option value="VC" @if ($user->country == 'VC') selected="selected" @endif>
                        Saint Vincent and the
                        Grenadines</option>
                      <option value="WS" @if ($user->country == 'WS') selected="selected" @endif>
                        Samoa</option>
                      <option value="SM" @if ($user->country == 'SM') selected="selected" @endif>San
                        Marino</option>
                      <option value="ST" @if ($user->country == 'ST') selected="selected" @endif>Sao
                        Tome and Principe
                      </option>
                      <option value="SA" @if ($user->country == 'SA') selected="selected" @endif>
                        Saudi Arabia</option>
                      <option value="SN" @if ($user->country == 'SN') selected="selected" @endif>
                        Senegal</option>
                      <option value="RS" @if ($user->country == 'RS') selected="selected" @endif>
                        Serbia</option>
                      <option value="CS" @if ($user->country == 'CS') selected="selected" @endif>
                        Serbia and Montenegro
                      </option>
                      <option value="SC" @if ($user->country == 'SC') selected="selected" @endif>
                        Seychelles</option>
                      <option value="SL" @if ($user->country == 'SL') selected="selected" @endif>
                        Sierra Leone</option>
                      <option value="SG" @if ($user->country == 'SG') selected="selected" @endif>
                        Singapore</option>
                      <option value="SX" @if ($user->country == 'SX') selected="selected" @endif>
                        Sint Maarten</option>
                      <option value="SK" @if ($user->country == 'SK') selected="selected" @endif>
                        Slovakia</option>
                      <option value="SI" @if ($user->country == 'SI') selected="selected" @endif>
                        Slovenia</option>
                      <option value="SB" @if ($user->country == 'SB') selected="selected" @endif>
                        Solomon Islands
                      </option>
                      <option value="SO" @if ($user->country == 'SO') selected="selected" @endif>
                        Somalia</option>
                      <option value="ZA" @if ($user->country == 'ZA') selected="selected" @endif>
                        South Africa</option>
                      <option value="GS" @if ($user->country == 'GS') selected="selected" @endif>
                        South Georgia and the
                        South Sandwich Islands</option>
                      <option value="SS" @if ($user->country == 'SS') selected="selected" @endif>
                        South Sudan</option>
                      <option value="ES" @if ($user->country == 'ES') selected="selected" @endif>
                        Spain</option>
                      <option value="LK" @if ($user->country == 'LK') selected="selected" @endif>Sri
                        Lanka</option>
                      <option value="SD" @if ($user->country == 'SD') selected="selected" @endif>
                        Sudan</option>
                      <option value="SR" @if ($user->country == 'SR') selected="selected" @endif>
                        Suriname</option>
                      <option value="SJ" @if ($user->country == 'SJ') selected="selected" @endif>
                        Svalbard and Jan Mayen
                      </option>
                      <option value="SZ" @if ($user->country == 'SZ') selected="selected" @endif>
                        Swaziland</option>
                      <option value="SE" @if ($user->country == 'SE') selected="selected" @endif>
                        Sweden</option>
                      <option value="CH" @if ($user->country == 'CH') selected="selected" @endif>
                        Switzerland</option>
                      <option value="SY" @if ($user->country == 'SY') selected="selected" @endif>
                        Syrian Arab Republic
                      </option>
                      <option value="TW" @if ($user->country == 'TW') selected="selected" @endif>
                        Taiwan, Province of
                        China</option>
                      <option value="TJ" @if ($user->country == 'TJ') selected="selected" @endif>
                        Tajikistan</option>
                      <option value="TZ" @if ($user->country == 'TZ') selected="selected" @endif>
                        Tanzania, United
                        Republic of</option>
                      <option value="TH" @if ($user->country == 'TH') selected="selected" @endif>
                        Thailand</option>
                      <option value="TL" @if ($user->country == 'TL') selected="selected" @endif>
                        Timor-Leste</option>
                      <option value="TG" @if ($user->country == 'TG') selected="selected" @endif>
                        Togo</option>
                      <option value="TK" @if ($user->country == 'TK') selected="selected" @endif>
                        Tokelau</option>
                      <option value="TO" @if ($user->country == 'TO') selected="selected" @endif>
                        Tonga</option>
                      <option value="TT" @if ($user->country == 'TT') selected="selected" @endif>
                        Trinidad and Tobago
                      </option>
                      <option value="TN" @if ($user->country == 'TN') selected="selected" @endif>
                        Tunisia</option>
                      <option value="TR" @if ($user->country == 'TR') selected="selected" @endif>
                        Turkey</option>
                      <option value="TM" @if ($user->country == 'TM') selected="selected" @endif>
                        Turkmenistan</option>
                      <option value="TC" @if ($user->country == 'TC') selected="selected" @endif>
                        Turks and Caicos
                        Islands</option>
                      <option value="TV" @if ($user->country == 'TV') selected="selected" @endif>
                        Tuvalu</option>
                      <option value="UG" @if ($user->country == 'UG') selected="selected" @endif>
                        Uganda</option>
                      <option value="UA" @if ($user->country == 'UA') selected="selected" @endif>
                        Ukraine</option>
                      <option value="AE" @if ($user->country == 'AE') selected="selected" @endif>
                        United Arab Emirates
                      </option>
                      <option value="GB" @if ($user->country == 'GB') selected="selected" @endif>
                        United Kingdom</option>
                      <option value="US" @if ($user->country == 'US') selected="selected" @endif>
                        United States of America</option>
                      <option value="UY" @if ($user->country == 'UY') selected="selected" @endif>
                        Uruguay</option>
                      <option value="UZ" @if ($user->country == 'UZ') selected="selected" @endif>
                        Uzbekistan</option>
                      <option value="VU" @if ($user->country == 'VU') selected="selected" @endif>
                        Vanuatu</option>
                      <option value="VE" @if ($user->country == 'VE') selected="selected" @endif>
                        Venezuela</option>
                      <option value="VN" @if ($user->country == 'VN') selected="selected" @endif>
                        Viet Nam</option>
                      <option value="VG" @if ($user->country == 'VG') selected="selected" @endif>
                        Virgin Islands, British
                      </option>
                      <option value="VI" @if ($user->country == 'VI') selected="selected" @endif>
                        Virgin Islands, U.s.
                      </option>
                      <option value="WF" @if ($user->country == 'WF') selected="selected" @endif>
                        Wallis and Futuna
                      </option>
                      <option value="EH" @if ($user->country == 'EH') selected="selected" @endif>
                        Western Sahara</option>
                      <option value="YE" @if ($user->country == 'YE') selected="selected" @endif>
                        Yemen</option>
                      <option value="ZM" @if ($user->country == 'ZM') selected="selected" @endif>
                        Zambia</option>
                      <option value="ZW" @if ($user->country == 'ZW') selected="selected" @endif>
                        Zimbabwe</option>

                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="gender" class="form-label">@lang('user.gender')<span
                        style="color: brown">*</span></label>
                    <select id="gender" required name="gender" class="form-control">
                      <option value="F" @if ($user->gender == 'F') selected @endif>
                        @lang('admin.myinfo.female')</option>
                      <option value="M" @if ($user->gender == 'M') selected @endif>
                        @lang('admin.myinfo.male')</option>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <label for="inputemail" class="form-label">@lang('user.email')<span
                        style="color: brown">*</span></label>
                    <input type="email" class="form-control" id="email" required name="email"
                      value="{{ $user->email }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputphone" class="form-label">@lang('user.telephone')<span
                        style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="telephone" required name="telephone"
                      placeholder="" value="{{ $user->telephone }}">
                  </div>
                  <div class="col-md-6">
                    <label for="inputphone" class="form-label">@lang('user.cell')<span
                        style="color: brown">*</span></label>
                    <input type="text" class="form-control" id="cell" required name="cell" placeholder=""
                      value="{{ $user->cell }}">
                  </div>
                  {{--  --}}
                  {{-- <div class="col-md-12">
                    <label for="walltet" class="form-label">Wallet - USDT TRC20</label>
                    <input type="text" class="form-control" id="wallet" name="wallet"
                      value="{{ empty($user->wallet->first()) ? '' : $user->wallet->first()->wallet }}">
                  </div> --}}
                  {{-- <div class="col-md-6">
                        <label for="image" class="form-label">@lang('user.profile_picture')</label>
                        <input type="file" required name="image" id="image" class="form-control">
                    </div> --}}

                  <div class="col-md-4">
                    <span onclick="authChange()" class="btn btn-primary rounded-pill mb-3 up font"
                      id="change_bt">SAVE</span>
                    <div class="col-md-12" id="password" style="display: none">
                      <label for="password" class="form-label">@lang('user.confirm_password')</label>
                      <input type="password" class="form-control" required name="password" placeholder="">
                    </div>
                    <br>
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary rounded-pill mb-3 up font" id="confirm_password"
                        style="display: none">Confirm</button>
                    </div>
                  </div>
                </form>

                <div class="card-header bbcolorp">
                  <h3 class="card-title up font">Financial Password</h3>
                </div>
                <form class="row gx-3 gy-2 align-items-center p-5" onsubmit="submitPass()"
                  action="{{ route('users.change.financial.password') }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="col-md-4">
                    <input type="password" class="form-control" id="old_password" name="old_password"
                      placeholder="@lang('user.current_password')">
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password"
                        placeholder="@lang('user.new_password')">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password"
                        placeholder="@lang('user.confirm_password')">
                    </div>
                  </div>
                  <div class="col-md-4 mt-5">
                    <button type="submit" class="btn btn-primary rounded-pill up font" id="btnPass">
                      @lang('user.change_password')
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script>
    function authChange() {
      document.querySelector('#password').style.display = 'block';
      document.querySelector('#confirm_password').style.display = 'block';
      document.querySelector('#change_bt').style.display = 'none';
    }

    function submitPass() {
      document.getElementById('btnPass').disabled = true;
    }
  </script>
@endsection
