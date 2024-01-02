<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\SearchRequest;
use App\Http\Controllers\Controller;
use App\Models\OrderPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;
use App\Traits\CustomLogTrait;
use Illuminate\Support\Facades\DB;


class UsersByCountryController extends Controller
{

    public function index()
    {
    $country_search = User::select('country',DB::raw('count(*) as amount'))
                        ->groupBy('country')
                        ->orderBy('amount','DESC')
                        
                        ->get();
   
                        

     foreach ($country_search as $key => $value) {

            $country_sigla = $value['country'];
        
            if($value['country'] == 'AX'){$value['country']='AlandIslands';}
            if($value['country'] == 'AL'){$value['country']='Albania';}
            if($value['country'] == 'DZ'){$value['country']='Algeria';}
            if($value['country'] == 'AS'){$value['country']='AmericanSamoa';}
            if($value['country'] == 'AD'){$value['country']='Andorra';}
            if($value['country'] == 'AO'){$value['country']='Angola';}
            if($value['country'] == 'AI'){$value['country']='Anguilla';}
            if($value['country'] == 'AQ'){$value['country']='Antarctica';}
            if($value['country'] == 'AG'){$value['country']='Antigua and Barbuda';}
            if($value['country'] == 'AR'){$value['country']='Argentina';}
            if($value['country'] == 'AM'){$value['country']='Armenia';}
            if($value['country'] == 'AW'){$value['country']='Aruba';}
            if($value['country'] == 'AU'){$value['country']='Australia';}
            if($value['country'] == 'AT'){$value['country']='Austria';}
            if($value['country'] == 'AZ'){$value['country']='Azerbaijan';}
            if($value['country'] == 'BS'){$value['country']='Bahamas';}
            if($value['country'] == 'BH'){$value['country']='Bahrain';}
            if($value['country'] == 'BD'){$value['country']='Bangladesh';}
            if($value['country'] == 'BB'){$value['country']='Barbados';}
            if($value['country'] == 'BY'){$value['country']='Belarus';}
            if($value['country'] == 'BE'){$value['country']='Belgium';}
            if($value['country'] == 'BZ'){$value['country']='Belize';}
            if($value['country'] == 'BJ'){$value['country']='Benin';}
            if($value['country'] == 'BM'){$value['country']='Bermuda';}
            if($value['country'] == 'BT'){$value['country']='Bhutan';}
            if($value['country'] == 'BO'){$value['country']='Bolivia';}
            if($value['country'] == 'BQ'){$value['country']='Bonaire, Sint Eustatiusand Saba';}
            if($value['country'] == 'BA'){$value['country']='Bosniaand Herzegovina';}
            if($value['country'] == 'BW'){$value['country']='Botswana';}
            if($value['country'] == 'BV'){$value['country']='BouvetIsland';}
            if($value['country'] == 'BR'){$value['country']='Brazil';}
            if($value['country'] == 'IO'){$value['country']='British Indian OceanTerritory';}
            if($value['country'] == 'BN'){$value['country']='BruneiDarussalam';}
            if($value['country'] == 'BG'){$value['country']='Bulgaria';}
            if($value['country'] == 'BF'){$value['country']='Burkina Faso';}
            if($value['country'] == 'BI'){$value['country']='Burundi';}
            if($value['country'] == 'KH'){$value['country']='Cambodia';}
            if($value['country'] == 'CM'){$value['country']='Cameroon';}
            if($value['country'] == 'CA'){$value['country']='Canada';}
            if($value['country'] == 'CV'){$value['country']='CapeVerde';}
            if($value['country'] == 'KY'){$value['country']='Cayman Islands';}
            if($value['country'] == 'CF'){$value['country']='Central African Republic';}
            if($value['country'] == 'TD'){$value['country']='Chad';}
            if($value['country'] == 'CL'){$value['country']='Chile';}
            if($value['country'] == 'CN'){$value['country']='China';}
            if($value['country'] == 'CX'){$value['country']='Christmas Island';}
            if($value['country'] == 'CC'){$value['country']='Cocos(Keeling) Islands';}
            if($value['country'] == 'CO'){$value['country']='Colombia';}
            if($value['country'] == 'KM'){$value['country']='Comoros';}
            if($value['country'] == 'CG'){$value['country']='Congo';}
            if($value['country'] == 'CD'){$value['country']='Congo, DemocraticRepublic of the Congo';}
            if($value['country'] == 'CK'){$value['country']='CookIslands';}
            if($value['country'] == 'CR'){$value['country']='CostaRica';}
            if($value['country'] == 'CI'){$value['country']='CoteDIvoire';}
            if($value['country'] == 'HR'){$value['country']='Croatia';}
            if($value['country'] == 'CU'){$value['country']='Cuba';}
            if($value['country'] == 'CW'){$value['country']='Curacao';}
            if($value['country'] == 'CY'){$value['country']='Cyprus';}
            if($value['country'] == 'CZ'){$value['country']='CzechRepublic';}
            if($value['country'] == 'DK'){$value['country']='Denmark';}
            if($value['country'] == 'DJ'){$value['country']='Djibouti';}
            if($value['country'] == 'DM'){$value['country']='Dominica';}
            if($value['country'] == 'DO'){$value['country']='Dominican Republic';}
            if($value['country'] == 'EC'){$value['country']='Ecuador';}
            if($value['country'] == 'EG'){$value['country']='Egypt';}
            if($value['country'] == 'SV'){$value['country']='ElSalvador';}
            if($value['country'] == 'GQ'){$value['country']='Equatorial Guinea';}
            if($value['country'] == 'ER'){$value['country']='Eritrea';}
            if($value['country'] == 'EE'){$value['country']='Estonia';}
            if($value['country'] == 'ET'){$value['country']='Ethiopia';}
            if($value['country'] == 'FK'){$value['country']='Falkland Islands(Malvinas)';}
            if($value['country'] == 'FO'){$value['country']='FaroeIslands';}
            if($value['country'] == 'FJ'){$value['country']='Fiji';}
            if($value['country'] == 'FI'){$value['country']='Finland';}
            if($value['country'] == 'FR'){$value['country']='France';}
            if($value['country'] == 'GF'){$value['country']='French Guiana';}
            if($value['country'] == 'PF'){$value['country']='French Polynesia';}
            if($value['country'] == 'TF'){$value['country']='French SouthernTerritories';}
            if($value['country'] == 'GA'){$value['country']='Gabon';}
            if($value['country'] == 'GM'){$value['country']='Gambia';}
            if($value['country'] == 'GE'){$value['country']='Georgia';}
            if($value['country'] == 'DE'){$value['country']='Germany';}
            if($value['country'] == 'GH'){$value['country']='Ghana';}
            if($value['country'] == 'GI'){$value['country']='Gibraltar';}
            if($value['country'] == 'GR'){$value['country']='Greece';}
            if($value['country'] == 'GL'){$value['country']='Greenland';}
            if($value['country'] == 'GD'){$value['country']='Grenada';}
            if($value['country'] == 'GP'){$value['country']='Guadeloupe';}
            if($value['country'] == 'GU'){$value['country']='Guam';}
            if($value['country'] == 'GT'){$value['country']='Guatemala';}
            if($value['country'] == 'GG'){$value['country']='Guernsey';}
            if($value['country'] == 'GN'){$value['country']='Guinea';}
            if($value['country'] == 'GW'){$value['country']='Guinea-Bissau';}
            if($value['country'] == 'GY'){$value['country']='Guyana';}
            if($value['country'] == 'HT'){$value['country']='Haiti';}
            if($value['country'] == 'HM'){$value['country']='HeardIsland and McdonaldIslands';}
            if($value['country'] == 'VA'){$value['country']='HolySee (Vatican CityState)';}
            if($value['country'] == 'HN'){$value['country']='Honduras';}
            if($value['country'] == 'HK'){$value['country']='Hong Kong';}
            if($value['country'] == 'HU'){$value['country']='Hungary';}
            if($value['country'] == 'IS'){$value['country']='Iceland';}
            if($value['country'] == 'IN'){$value['country']='India';}
            if($value['country'] == 'ID'){$value['country']='Indonesia';}
            if($value['country'] == 'IR'){$value['country']='Iran, Islamic Republicof';}
            if($value['country'] == 'IQ'){$value['country']='Iraq';}
            if($value['country'] == 'IE'){$value['country']='Ireland';}
            if($value['country'] == 'IM'){$value['country']='Isle of Man';}
            if($value['country'] == 'IL'){$value['country']='Israel';}
            if($value['country'] == 'IT'){$value['country']='Italy';}
            if($value['country'] == 'JM'){$value['country']='Jamaica';}
            if($value['country'] == 'JP'){$value['country']='Japan';}
            if($value['country'] == 'JE'){$value['country']='Jersey';}
            if($value['country'] == 'JO'){$value['country']='Jordan';}
            if($value['country'] == 'KZ'){$value['country']='Kazakhstan';}
            if($value['country'] == 'KE'){$value['country']='Kenya';}
            if($value['country'] == 'KI'){$value['country']='Kiribati';}
            if($value['country'] == 'KP'){$value['country']='Korea, DemocraticPeoples Republic of';}
            if($value['country'] == 'KR'){$value['country']='Korea, Republic of';}
            if($value['country'] == 'XK'){$value['country']='Kosovo';}
            if($value['country'] == 'KW'){$value['country']='Kuwait';}
            if($value['country'] == 'KG'){$value['country']='Kyrgyzstan';}
            if($value['country'] == 'LA'){$value['country']='LaoPeoples DemocraticRepublic';}
            if($value['country'] == 'LV'){$value['country']='Latvia';}
            if($value['country'] == 'LB'){$value['country']='Lebanon';}
            if($value['country'] == 'LS'){$value['country']='Lesotho';}
            if($value['country'] == 'LR'){$value['country']='Liberia';}
            if($value['country'] == 'LY'){$value['country']='Libyan Arab Jamahiriya';}
            if($value['country'] == 'LI'){$value['country']='Liechtenstein';}
            if($value['country'] == 'LT'){$value['country']='Lithuania';}
            if($value['country'] == 'LU'){$value['country']='Luxembourg';}
            if($value['country'] == 'MO'){$value['country']='Macao';}
            if($value['country'] == 'MK'){$value['country']='Macedonia, the FormerYugoslav Republic of';}
            if($value['country'] == 'MG'){$value['country']='Madagascar';}
            if($value['country'] == 'MW'){$value['country']='Malawi';}
            if($value['country'] == 'MY'){$value['country']='Malaysia';}
            if($value['country'] == 'MV'){$value['country']='Maldives';}
            if($value['country'] == 'ML'){$value['country']='Mali';}
            if($value['country'] == 'MT'){$value['country']='Malta';}
            if($value['country'] == 'MH'){$value['country']='Marshall Islands';}
            if($value['country'] == 'MQ'){$value['country']='Martinique';}
            if($value['country'] == 'MR'){$value['country']='Mauritania';}
            if($value['country'] == 'MU'){$value['country']='Mauritius';}
            if($value['country'] == 'YT'){$value['country']='Mayotte';}
            if($value['country'] == 'MX'){$value['country']='Mexico';}
            if($value['country'] == 'FM'){$value['country']='Micronesia, FederatedStates of';}
            if($value['country'] == 'MD'){$value['country']='Moldova, Republic of';}
            if($value['country'] == 'MC'){$value['country']='Monaco';}
            if($value['country'] == 'MN'){$value['country']='Mongolia';}
            if($value['country'] == 'ME'){$value['country']='Montenegro';}
            if($value['country'] == 'MS'){$value['country']='Montserrat';}
            if($value['country'] == 'MA'){$value['country']='Morocco';}
            if($value['country'] == 'MZ'){$value['country']='Mozambique';}
            if($value['country'] == 'MM'){$value['country']='Myanmar';}
            if($value['country'] == 'NA'){$value['country']='Namibia';}
            if($value['country'] == 'NR'){$value['country']='Nauru';}
            if($value['country'] == 'NP'){$value['country']='Nepal';}
            if($value['country'] == 'NL'){$value['country']='Netherlands';}
            if($value['country'] == 'AN'){$value['country']='Netherlands Antilles';}
            if($value['country'] == 'NC'){$value['country']='NewCaledonia';}
            if($value['country'] == 'NZ'){$value['country']='NewZealand';}
            if($value['country'] == 'NI'){$value['country']='Nicaragua';}
            if($value['country'] == 'NE'){$value['country']='Niger';}
            if($value['country'] == 'NG'){$value['country']='Nigeria';}
            if($value['country'] == 'NU'){$value['country']='Niue';}
            if($value['country'] == 'NF'){$value['country']='Norfolk Island';}
            if($value['country'] == 'MP'){$value['country']='Northern MarianaIslands';}
            if($value['country'] == 'NO'){$value['country']='Norway';}
            if($value['country'] == 'OM'){$value['country']='Oman';}
            if($value['country'] == 'PK'){$value['country']='Pakistan';}
            if($value['country'] == 'PW'){$value['country']='Palau';}
            if($value['country'] == 'PS'){$value['country']='Palestinian Territory,Occupied';}
            if($value['country'] == 'PA'){$value['country']='Panama';}
            if($value['country'] == 'PG'){$value['country']='Papua New Guinea';}
            if($value['country'] == 'PY'){$value['country']='Paraguay';}
            if($value['country'] == 'PE'){$value['country']='Peru';}
            if($value['country'] == 'PH'){$value['country']='Philippines';}
            if($value['country'] == 'PN'){$value['country']='Pitcairn';}
            if($value['country'] == 'PL'){$value['country']='Poland';}
            if($value['country'] == 'PT'){$value['country']='Portugal';}
            if($value['country'] == 'PR'){$value['country']='Puerto Rico';}
            if($value['country'] == 'QA'){$value['country']='Qatar';}
            if($value['country'] == 'RE'){$value['country']='Reunion';}
            if($value['country'] == 'RO'){$value['country']='Romania';}
            if($value['country'] == 'RU'){$value['country']='Russian Federation';}
            if($value['country'] == 'RW'){$value['country']='Rwanda';}
            if($value['country'] == 'BL'){$value['country']='Saint Barthelemy';}
            if($value['country'] == 'SH'){$value['country']='Saint Helena';}
            if($value['country'] == 'KN'){$value['country']='Saint Kitts and Nevis';}
            if($value['country'] == 'LC'){$value['country']='Saint Lucia';}
            if($value['country'] == 'MF'){$value['country']='Saint Martin';}
            if($value['country'] == 'PM'){$value['country']='Saint Pierre andMiquelon';}
            if($value['country'] == 'VC'){$value['country']='Saint Vincent and theGrenadines';}
            if($value['country'] == 'WS'){$value['country']='Samoa';}
            if($value['country'] == 'SM'){$value['country']='SanMarino';}
            if($value['country'] == 'ST'){$value['country']='SaoTome and Principe';}
            if($value['country'] == 'SA'){$value['country']='Saudi Arabia';}
            if($value['country'] == 'SN'){$value['country']='Senegal';}
            if($value['country'] == 'RS'){$value['country']='Serbia';}
            if($value['country'] == 'CS'){$value['country']='Serbia and Montenegro';}
            if($value['country'] == 'SC'){$value['country']='Seychelles';}
            if($value['country'] == 'SL'){$value['country']='Sierra Leone';}
            if($value['country'] == 'SG'){$value['country']='Singapore';}
            if($value['country'] == 'SX'){$value['country']='Sint Maarten';}
            if($value['country'] == 'SK'){$value['country']='Slovakia';}
            if($value['country'] == 'SI'){$value['country']='Slovenia';}
            if($value['country'] == 'SB'){$value['country']='Solomon Islands';}
            if($value['country'] == 'SO'){$value['country']='Somalia';}
            if($value['country'] == 'ZA'){$value['country']='South Africa';}
            if($value['country'] == 'GS'){$value['country']='South Georgia and theSouth Sandwich Islands';}
            if($value['country'] == 'SS'){$value['country']='South Sudan';}
            if($value['country'] == 'ES'){$value['country']='Spain';}
            if($value['country'] == 'LK'){$value['country']='SriLanka';}
            if($value['country'] == 'SD'){$value['country']='Sudan';}
            if($value['country'] == 'SR'){$value['country']='Suriname';}
            if($value['country'] == 'SJ'){$value['country']='Svalbard and Jan Mayen';}
            if($value['country'] == 'SZ'){$value['country']='Swaziland';}
            if($value['country'] == 'SE'){$value['country']='Sweden';}
            if($value['country'] == 'CH'){$value['country']='Switzerland';}
            if($value['country'] == 'SY'){$value['country']='Syrian Arab Republic';}
            if($value['country'] == 'TW'){$value['country']='Taiwan, Province ofChina';}
            if($value['country'] == 'TJ'){$value['country']='Tajikistan';}
            if($value['country'] == 'TZ'){$value['country']='Tanzania, UnitedRepublic of';}
            if($value['country'] == 'TH'){$value['country']='Thailand';}
            if($value['country'] == 'TL'){$value['country']='Timor-Leste';}
            if($value['country'] == 'TG'){$value['country']='Togo';}
            if($value['country'] == 'TK'){$value['country']='Tokelau';}
            if($value['country'] == 'TO'){$value['country']='Tonga';}
            if($value['country'] == 'TT'){$value['country']='Trinidad and Tobago';}
            if($value['country'] == 'TN'){$value['country']='Tunisia';}
            if($value['country'] == 'TR'){$value['country']='Turkey';}
            if($value['country'] == 'TM'){$value['country']='Turkmenistan';}
            if($value['country'] == 'TC'){$value['country']='Turks and CaicosIslands';}
            if($value['country'] == 'TV'){$value['country']='Tuvalu';}
            if($value['country'] == 'UG'){$value['country']='Uganda';}
            if($value['country'] == 'UA'){$value['country']='Ukraine';}
            if($value['country'] == 'AE'){$value['country']='United Arab Emirates';}
            if($value['country'] == 'GB'){$value['country']='United Kingdom';}
            if($value['country'] == 'US'){$value['country']='United States of America';}
            if($value['country'] == 'UY'){$value['country']='Uruguay';}
            if($value['country'] == 'UZ'){$value['country']='Uzbekistan';}
            if($value['country'] == 'VU'){$value['country']='Vanuatu';}
            if($value['country'] == 'VE'){$value['country']='Venezuela';}
            if($value['country'] == 'VN'){$value['country']='Viet Nam';}
            if($value['country'] == 'VG'){$value['country']='Virgin Islands, British';}
            if($value['country'] == 'VI'){$value['country']='Virgin Islands, U.s.';}
            if($value['country'] == 'WF'){$value['country']='Wallis and Futuna';}
            if($value['country'] == 'EH'){$value['country']='Western Sahara';}
            if($value['country'] == 'YE'){$value['country']='Yemen';}
            if($value['country'] == 'ZM'){$value['country']='Zambia';}
            if($value['country'] == 'ZW'){$value['country']='Zimbabwe';}
    
       
        

        $labelsChart[$key] = $value['country'];
        $dataChart[$key] = $value['amount'];

        $data[$key]=["country"=>$value['country'],
                     "amount"=>$value['amount'],
                    "flag"=>"https://flagcdn.com/w20/".strtolower($country_sigla).".jpg"];
    } 

   
    

  // $data=array_reverse($data);
    
    
    return view('admin.reports.UsersByCountry', compact('data','labelsChart','dataChart'));
    
    }
 


}
