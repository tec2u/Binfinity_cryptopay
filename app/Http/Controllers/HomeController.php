<?php

namespace App\Http\Controllers;

use App\Models\Banco;

use App\Models\Package;
use App\Models\User;

use App\Models\OrderPackage;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;


class HomeController extends Controller
{
   // /**
   //  * Create a new controller instance.
   //  *
   //  * @return void
   //  */
   // public function __construct()
   // {
   //    $this->middleware('auth');
   // }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {
      $id_user = Auth::id();
      $packages = OrderPackage::where('user_id', $id_user)->where('payment_status', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
      $orderpackages = OrderPackage::where('user_id', $id_user)->orderBy('id', 'DESC')->limit(5)->get();
      $user = User::where('id', $id_user)->first();

      $current_package = OrderPackage::where('user_id', $id_user)->first();
      $pacote = $user->orderPackage->first();


      $recomendation = User::where('recommendation_user_id', $user->id)->where('activated', 0)->get();

      $inactiverights = count($recomendation);

      if (empty($pacote)) {
         $name = '';
      } else {
         $name = $pacote->reference;
      }

      $from = date('Y-m-d');
      $to = date('Y-m-d', strtotime("-30 days", strtotime($from)));


      $bonususer = Banco::where('user_id', $user->id)
         ->whereIn('description', [1, 2, 4, 5])
         ->where('created_at', '>=', "$to 00:00:00")
         ->where('created_at', '<=', "$from 23:59:59")
         ->selectRaw('sum(price) as total')
         ->first();

      if (empty($bonususer)) {
         $totalbanco = 0;
      } else {
         $totalbanco = $bonususer->total;
      }

      $bonusdaily = Banco::where('user_id', $user->id)
         ->whereIn('description', [6])
         ->where('created_at', '>=', "$to 00:00:00")
         ->where('created_at', '<=', "$from 23:59:59")
         ->groupBy('user_id')
         ->selectRaw('sum(price) as total, user_id')
         ->first();

      if (empty($bonusdaily)) {
         $bonusdaily = 0;
      } else {
         $bonusdaily = $bonusdaily->total;
      }


      $data = array();
      $datasaida = array();
      $label = array();

      $from = date('Y-m-d');
      $toinicio = date('Y-m-d', strtotime("-30 days", strtotime($from)));
      $saque = 0;
      for ($i = 1; $i < 31; $i++) {

         $to = date('Y-m-d', strtotime("+$i days", strtotime($toinicio)));
         $bonususer = Banco::where('user_id', $user->id)
            ->whereIn('description', [1, 2, 4, 5])
            ->where('created_at', '>=', "$to 00:00:00")
            ->where('created_at', '<=', "$to 23:59:59")
            ->groupBy('created_at')
            ->selectRaw('sum(price) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as created_at')
            ->orderby('created_at')
            ->first();

         $bonussaida = Banco::where('user_id', $user->id)
            ->where('created_at', '>=', "$to 00:00:00")
            ->where('created_at', '<=', "$to 23:59:59")
            ->where('description', '=', 99)
            ->groupBy('created_at')
            ->selectRaw('sum(price) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as created_at')
            ->orderby('created_at')
            ->first();

         if (empty($bonususer)) {
            $total = 0;
         } else {
            $total = $bonususer->total;
         }

         if (empty($bonussaida)) {
            $totalsaida = 0;
         } else {
            $totalsaida = abs($bonussaida->total);
         }

         $saque += $totalsaida;

         $labelbonus = array(
            date('m-d-Y', strtotime($to))
         );

         $databonus = array(
            $total
         );

         $databonussaida = array(
            $totalsaida
         );

         $data = array_merge($data, $databonus);
         $datasaida = array_merge($datasaida, $databonussaida);
         $label = array_merge($labelbonus, $label);
      }
      $datasaida = json_encode($datasaida);
      $label = json_encode(array_reverse($label));
      $data = json_encode($data);

      Alert::success(__('backoffice_alert.home_welcome') . " " . $user->login . "!");

      $url_image_popup = asset('/images/logo_tiger.jpeg');

      // if ($user->contact_id == NULL) {
      //    $complete_registration = "Please complete your registration:<br>";
      //    $array_att = array('last_name' => 'Last Name', 'address1' => 'Address 1', 'address2' => 'Address 2', 'postcode' => 'Postcode', 'state' => 'State', 'wallet' => 'Wallet');
      //    foreach ($user->getAttributes() as $key => $value) {
      //       if ($value == NULL && array_search($key, array('last_name', 'address1', 'address2', 'postcode', 'state', 'wallet'))) {
      //          $complete_registration .= "&nbsp;&nbsp;&bull;" . $array_att[$key] . "<br>";
      //       }
      //    }
      //    flash($complete_registration)->error();
      // }

      $n_pago = false;
      foreach ($orderpackages as $order) {
         if ($order->payment_status == 0) {
            $n_pago = true;
         }
      }


      return view('home', compact('n_pago', 'packages', 'orderpackages', 'name', 'user', 'data', 'label', 'datasaida', 'totalbanco', 'bonusdaily', 'saque', 'inactiverights'));
   }

   public function welcome()
   {
      $packages = Package::where('type', 'packages')->where('activated', 1)->orderBy('price')->get();

      return view('welcome.welcome', compact('packages'));
   }

   public function fees()
   {
      $packages = Package::where('type', 'packages')->where('activated', 1)->orderBy('price')->get();
      return view('welcome.fees', compact('packages'));
   }

   public function sendEmailContact(Request $request)
   {
      if (isset($request->name) && isset($request->email) && isset($request->message)) {
         $this->sendEmailBrevo($request->name, $request->email, $request->message, "gabriel.almeiidda@gmail.com");
      }

      return redirect()->back();
   }

   public function sendEmailBrevo($nome, $email, $message, $receiver)
   {
      $client = new Client();

      $url = 'https://api.brevo.com/v3/smtp/email';

      $headers = [
         'Accept' => 'application/json',
         'api-key' => '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',
         'Content-Type' => 'application/json',
      ];

      $data = [
         'sender' => [
            'name' => "$nome",
            'email' => "$email",
         ],
         'to' => [
            [
               'email' => "$receiver",
               'name' => "Binfinitybank",
            ],
         ],
         'subject' => 'Contact binfinitybank',
         'htmlContent' => "<html>
                              <head>
                              </head>
                              <body>
                                 <div style='background-color:transparent;width:100%;'>
                                 <img src='https://cryptopay.binfinitybank.com.br/assetsWelcomeNew/images/logo2.png' alt='Binfinitybank Logo' width='300'
                                    style='height:auto;display:block;' />
                                 </div>
                                 <strong>Name:</strong>
                                 <p>
                                    $nome
                                 </p>
                                 <br/>
                                 <strong>Email:</strong>
                                 <p> 
                                    $email
                                 </p>
                                 <br/>
                                 <strong>Message:</strong>
                                 <p>
                                    $message
                                 </p>
                              </body>
                           </html>",
      ];

      try {
         $response = $client->post($url, [
            'headers' => $headers,
            'json' => $data,
         ]);

         return $response;
      } catch (\Throwable $th) {

      }
   }
}
