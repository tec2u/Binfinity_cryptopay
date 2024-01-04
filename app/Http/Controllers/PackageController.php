<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;
use App\Models\Documents;
use App\Models\Package;
use App\Models\PaymentLog;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\OrderPackage;
use App\Models\User;
use Exception;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id); //verifica se ja tem adesão para liberar os outros produtos
        //$adesao = true;
        $packages = Package::orderBy('id', 'DESC')->where('activated', 1)->paginate(9);
        // if ($user->contact_id == NULL) {
        //     $complete_registration = "Please complete your registration to purchase:<br>";
        //     $array_att = array('last_name' => 'Last Name', 'address1' => 'Address 1', 'address2' => 'Address 2', 'postcode' => 'Postcode', 'state' => 'State', 'wallet' => 'Wallet');
        //     foreach ($user->getAttributes() as $key => $value) {
        //        if ($value == NULL && array_search($key, array('last_name', 'address1', 'address2', 'postcode', 'state', 'wallet'))) {
        //           $complete_registration .= "&nbsp;&nbsp;&bull;" . $array_att[$key] . "<br>";
        //        }
        //     }
        //     flash($complete_registration)->error();
        //  }

        return view('package.produtos', compact('packages', 'adesao', 'user'));
    }

    public function packagesActivator()
    {
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1; //verifica se ja tem adesão para liberar os outros produtos
        //$adesao = true;
        $packages = Package::orderBy('id', 'DESC')->where('activated', 1)->where('type', 'activator')->paginate(9);
        // if ($user->contact_id == NULL) {
        //     $complete_registration = "Please complete your registration to purchase:<br>";
        //     $array_att = array('last_name' => 'Last Name', 'address1' => 'Address 1', 'address2' => 'Address 2', 'postcode' => 'Postcode', 'state' => 'State', 'wallet' => 'Wallet');
        //     foreach ($user->getAttributes() as $key => $value) {
        //        if ($value == NULL && array_search($key, array('last_name', 'address1', 'address2', 'postcode', 'state', 'wallet'))) {
        //           $complete_registration .= "&nbsp;&nbsp;&bull;" . $array_att[$key] . "<br>";
        //        }
        //     }
        //     flash($complete_registration)->error();
        //  }

        return view('package.produtos', compact('packages', 'adesao', 'user'));
    }
    public function packageuserpass($packageid)
    {
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;

        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $orderpackage = OrderPackage::find($packageid);

        return view('package.packageuserpass', compact('packages', 'adesao', 'user', 'orderpackage'));
    }
    public function packageupdatelink($packageid)
    {
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;

        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $orderpackage = OrderPackage::find($packageid);

        return view('package.packageupdatelink', compact('packages', 'adesao', 'user', 'orderpackage'));
    }
    public function packagepay($packageid)
    {
        // YZPVFNYyKjsoZKjR0kRCsQ==1kya9pQ2C4ykWAiM


        $client = new Client();

        $response = $client->request('GET', 'https://api.coingecko.com/api/v3/simple/price', [
            'query' => [
                'ids' => 'bitcoin',
                'vs_currencies' => 'usd',
                'include_last_updated_at' => true,
            ],
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = $response->getBody()->getContents();

        // dd($result);

        $user   = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;

        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $orderpackage  = OrderPackage::find($packageid);
        $price_order   = $orderpackage->price;
        $bitcoin       = $result->bitcoin['usd'];
        $value_btc     = $price_order / $bitcoin;

        return view('package.packagepay', compact('packages', 'adesao', 'user', 'orderpackage', 'value_btc'));
    }
    public function change_userpassword(Request $request, $packageid)
    {
        // dd($_POST);
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;
        $data = $request->only([
            'image'
        ]);
        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $path = public_path('images/printscreen/');
        !is_dir($path) &&
            mkdir($path, 0777, true);


        $orderpackage = OrderPackage::find($packageid);

        if (isset($request->image)) {
            if ($request->file('image')->isValid()) {
                $rules = [
                    'image' => 'image|mimes:jpeg,png,webp|max:10240',
                ];
                $validator = \Validator::make($request->all(), $rules);

                if (!$validator->fails()) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move($path, $imageName);
                    $orderpackage->printscreen = $imageName;
                } else {
                    return redirect()->back()->with('error', 'The image is invalid. Please try again.');
                }
            }

        }

        $orderpackage->user = $_POST['login_number'];
        $orderpackage->pass = $_POST['login_password'];
        $orderpackage->server = $_POST['server'];

        $orderpackage->update();

        return view('package.change_userpassword', compact('packages', 'adesao', 'user'));
    }
    public function change_link($packageid)
    {
        // dd($_POST);
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;

        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $orderpackage = OrderPackage::find($packageid);
        $orderpackage->link = $_POST['link'];
        $orderpackage->update();

        return view('package.change_link', compact('packages', 'adesao', 'user'));
    }


    public function detail($packageid)
    {

        $package = Package::where('id', '=', $packageid)
            ->first();

        return view('package.produto', compact('package'));
    }

    public function package()
    {
        $id_user = Auth::id();
        $orderpackages = OrderPackage::orderBy('id', 'DESC')
            ->where('hide', false)
            ->where('package_id', '<>', 20)
            ->where('user_id', $id_user)->paginate(9);

        return view('userpackageinfo', compact('orderpackages'));
    }
    public function packageprofit()
    {
        $id_user = Auth::id();
        $orderpackages = OrderPackage::orderBy('id', 'DESC')
            ->where('hide', false)
            ->where('package_id', 20)
            ->where('user_id', $id_user)->paginate(9);

        return view('userpackageprofitinfo', compact('orderpackages'));
    }

    public function hide($id)
    {
        try {
            $orderpackage = OrderPackage::find($id);
            $orderpackage->hide = true;
            $orderpackage->update();
            flash(__('package.your_order_has_been_hidden'))->success();
            return redirect()->back();
        } catch (Exception $e) {
            flash(__('package.unable_to_hide_your_order'))->error();
            return redirect()->back();
        }
    }

    public function payCrypto(Request $request)
    {
        if ($request->method != 'BTC' && $request->method != 'TRC20') {
            return redirect()->back();
        }

        /*   if (strlen($request->price) < 7) {
              $price = floatval(str_replace(',', '.', $request->price));
          } else {
              $valorSemSeparadorMilhar = str_replace('.', '', $request->price);
              $price = str_replace(',', '.', $valorSemSeparadorMilhar);
          } */
        $id_user = Auth::id();
        $price = $request->price;

        $payment = $this->genUrlCrypto($price, $request->method);
        // dd($payment);
        if (isset($payment) and $payment != false) {

            $order = OrderPackage::where('id', $request->id)->first();
            $order->transaction_code   = $payment->invoice_id;
            $order->transaction_wallet = $payment->id;
            $order->save();

            $wallet = new Wallet;
            $wallet->user_id     = $id_user;
            $wallet->wallet      = "asd";
            $wallet->description = "description";
            $wallet->description = $request->coin;

            $wallet->save();

            return redirect()->away($payment->url);
        } else {
            return redirect()->back();
        }
    }

    public function genUrlCrypto($price, $method)
    {
        $name = "AI-NEXT-LEVEL";

        if ($method == 'BTC') {
            $paymentConfig = [
                "api_url" => "https://coinremitter.com/api/v3/BTC/create-invoice",
                "api_key" => '$2y$10$Jn8TvSVsYN6mSJTIK/EieOKJyTzSM6ZxXUpq/WPMsIprA2eNApc8a',
                "password" => "18102023",
                "currency" => "USD",
                "expire_time" => "60"
            ];
        } else if ($method == 'TRC20') {
            $paymentConfig = [
                "api_url" => "https://coinremitter.com/api/v3/USDTTRC20/create-invoice",
                //  "api_key" => '$2y$10$xvuOi9NUWBzpELE0he8/w.WKhTqHDuckVfkDz6/ZMR2RgVmPchWeS',
                // "password" => "AI@NextLevel23",
                "api_key" => '$2y$10$WBnWO29RL.heTCySoIYDt.vBZC07zKSH.tJpIu4gHextS7ux.8e1q',
                "password" => "RcBryv2ZQjS9S5@",
                "currency" => "USD",
                "expire_time" => "60"
            ];
        }

        $curl = curl_init();

        $url = "https://ai-nextlevel.com/packages/packagepay/notify";

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $paymentConfig['api_url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "api_key": "' . $paymentConfig['api_key'] . '",
                "password": "' . $paymentConfig['password'] . '",
                "amount": "' . $price . '",
                "name": "' . $name . '",
                "currency": "' . $paymentConfig['currency'] . '",
                "expire_time": "' . $paymentConfig['expire_time'] . '",
                "notify_url" : "' . $url . '"

            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $raw = json_decode(curl_exec($curl));

        /*        $log = new CustomLog;
               $log->content = $raw;
               $log->user_id = "-1";
               $log->operation = "New Profit Order Pmt";
               $log->controller = "app/controller/admin/PackageController";
               $log->http_code = 200;
               $log->route = "PackageController";
               $log->status = "SUCCESS";
               $log->save(); */

        curl_close($curl);

        if ($raw->flag === 1) {
            return $raw->data;
        } else {
            return false;
        }
    }

    public function notify(Request $request)
    {
        $requestFormated = $request->all();

        // crypto
        if (isset($requestFormated["id"])) {

            $payment = OrderPackage::where('transaction_wallet', $requestFormated["id"])
                ->orWhere('transaction_wallet', $requestFormated["merchant_id"])
                ->first();

            if (!isset($payment)) {
                return false;
            }

            if (strtolower($requestFormated["status"]) == 'paid') {
                $payment->payment_status = 1;
                $payment->status = 1;

                if ($payment->package_id == 20) {
                    $this->sendPostPayOrder($payment->id);
                }
            }

            if (strtolower($requestFormated["status"]) == 'cancelled' || strtolower($requestFormated["status"]) == 'expired') {
                $payment->payment_status = 2;
                $payment->status = 0;
            }

            $payment->save();

            $log = new PaymentLog;
            $log->content = $requestFormated["status"];
            $log->order_package_id = $payment->id;
            $log->operation = "payment package";
            $log->controller = "packageController";
            $log->http_code = "200";
            $log->route = "/packages/packagepay/notify";
            $log->status = "success";
            $log->json = json_encode($request->all());
            $log->save();

        }

        if (isset($requestFormated["teste"])) {
            if (isset($requestFormated["idpedido"])) {
                $payment = OrderPackage::where('id', $requestFormated["idpedido"])->first();
                return response()->json($payment);
            } else {
                $payment = OrderPackage::where('payment_status', 1)->latest()->first();
                return response()->json($payment);
            }
        }


        return response("OK", 200);
    }

    public function sendPostPayOrder($id_order)
    {

        $client = new \GuzzleHttp\Client();
        $Orderpackage = OrderPackage::find($id_order);

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json'
        ];

        $data = [
            "type" => "bonificacao",
            "param" => "GeraBonusPedidoInterno",
            "idpedido" => "$id_order",
            "prod" => 1
        ];

        $url = 'https://ai-nextlevel.com/public/compensacao/bonificacao.php';

        try {
            $resposta = $client->post($url, [
                'form_params' => $data,
                // 'headers' => $headers,

            ]);

            $statusCode = $resposta->getStatusCode();
            $body = $resposta->getBody()->getContents();

            parse_str($body, $responseData);

            $log = new CustomLog;
            $log->content = json_encode($responseData);
            $log->user_id = $Orderpackage->user_id;
            $log->operation = $data['type'] . "/" . $data['param'] . "/" . $data['idpedido'];
            $log->controller = "app/controller/admin/PackageAdminController";
            $log->http_code = 200;
            $log->route = "payd order by admin";
            $log->status = "SUCCESS";
            $log->save();

        } catch (\Throwable $th) {
            return false;
        }



    }

    public function invoice($id)
    {
        if (!$id) {
            abort(404);
        }

        $order = OrderPackage::where('id', $id)->where('package_id', 20)->first();

        if (!$order) {
            abort(404);
        }

        if ($order->payment_status != 1) {
            abort(404);
        }

        // dd($order);

        $id_user = $order->user_id;
        $user = User::where('id', '=', $id_user)->first();
        // dd($user);

        $data = [
            'client_name' => $user->name . ' ' . $user->last_name ?? '',
            'client_email' => $user->email,
            'client_tel' => $user->cell ?? '',
            'package_name' => $order->reference,
            'package_price' => $order->price,
            'order_id' => $order->id
        ];

        return view('pdf.orderslipProduct', compact('data'));
    }

    public function processBuying()
    {
        return view('processBuying.form');
    }

    public function processBuyingCreate(Request $request)
    {
        // dd($request);
        $id_package = $request->package_id;

        $package = Package::where('id', $id_package)->first();

        $user = User::find(Auth::id());

        $path = public_path('images/printscreen/');
        !is_dir($path) &&
            mkdir($path, 0777, true);

        if (isset($request->image)) {
            if ($request->file('image')->isValid()) {
                $rules = [
                    'image' => 'file|mimes:jpeg,jpg,png,webp,doc,docx,pdf|max:10240',
                ];
                $validator = \Validator::make($request->all(), $rules);

                if (!$validator->fails()) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move($path, $imageName);
                } else {
                    return redirect()->back()->with('error', 'The image is invalid. Please try again.');
                }
            }

        }

        $newOrder = new OrderPackage;
        $newOrder->user_id = $user->id;
        $newOrder->reference = $package->name;
        $newOrder->payment_status = 0;
        $newOrder->transaction_code = 0;
        $newOrder->package_id = $package->id;
        $newOrder->price = $package->price;
        $newOrder->amount = 1;
        $newOrder->transaction_wallet = 0;
        $newOrder->wallet = 0;
        $adesao = !$user->getAdessao($user->id) >= 1;
        $newOrder->printscreen = $imageName ?? '';
        $newOrder->pass = $request->login_password;
        $newOrder->server = $request->server_address;
        $newOrder->user = $request->login_number;
        $newOrder->save();

        return redirect()->route('packages.packagelog')->with('success', '');
    }

    public function baixaPdf($nome)
    {
        $docs = Documents::all();

        foreach ($docs as $item) {
            $texto = $item->title;
            if (strpos($texto, '|') !== false) {
                $partes = explode('|', $texto);
                $palavraAntesDoPipe = $partes[0];
                if ($palavraAntesDoPipe == $nome) {
                    $file = storage_path("app/public/{$item->path}");
                    if (file_exists($file)) {
                        $headers = [
                            'Content-Type' => 'application/pdf',
                        ];
                        $fileName = "$nome.pdf";

                        return response()->download($file, $fileName, $headers);
                    } else {
                        abort(404);
                    }
                }
            }
        }

        abort(404);
    }
}
