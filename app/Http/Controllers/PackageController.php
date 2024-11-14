<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;
use App\Models\Documents;
use App\Models\NodeOrders;
use App\Models\Package;
use App\Models\PaymentLog;
use App\Models\PriceCoin;
use App\Models\SystemConf;
use App\Models\WalletName;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\OrderPackage;
use App\Models\User;
use Exception;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use stdClass;

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

        //$packageid=$_GET['id'];
        //dd($packageid);

        // $controller = new CronPagamento;
        // $controller->index();

        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $orderpackage = OrderPackage::find($packageid);

        // dd($orderpackage);

        // YZPVFNYyKjsoZKjR0kRCsQ==1kya9pQ2C4ykWAiM

        $myWallets = Wallet::where('user_id', Auth::id())->get();
        $wallet = null;

        if (count($myWallets) > 0) {
            # code...
            $ids = [];
            foreach ($myWallets as $w) {
                array_push($ids, $w->id);
            }

            $idSorteado = $ids[array_rand($ids)];

            $wallet = Wallet::where('id', $idSorteado)->first();

        }

        if (isset($orderpackage->wallet)) {
            $wallett = Wallet::where('id', $orderpackage->wallet)->first();
            if (isset($wallett)) {
                $wallet = $wallett;
            }
        }
        $moedas = null;
        $value_btc = null;

        if (isset($orderpackage->price_crypto)) {
            $value_btc = $orderpackage->price_crypto;
        } else {


            $price_order = $orderpackage->price;



            $btc = :where('name', "BTC")->first()->one_in_usd;
            $trc20 = PriceCoin::where('name', "TRC20")->first()->one_in_usd;
            $erc20 = PriceCoin::where('name', "ERC20")->first()->one_in_usd;
            $trx = PriceCoin::where('name', "TRX")->first()->one_in_usd;
            $eth = PriceCoin::where('name', "ETH")->first()->one_in_usd;
            $sol = PriceCoin::where('name', "SOL")->first()->one_in_usd;
            $bnb = PriceCoin::where('name', "BNB")->first()->one_in_usd;

            $moedas = [
                 "BITCOIN" => number_format($price_order / $btc, 5),
                 "ETH" => number_format($price_order / $eth, 4),
                 "USDT_ERC20" => number_format($price_order / $erc20, 2),
                "TRX" => number_format($price_order / $trx, 2),
                "USDT_TRC20" => number_format($price_order / $trc20, 2),
                "SOL" => number_format($price_order / $sol, 3),
                "BNB" => number_format($price_order / $bnb, 4),
            ];

        }

        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;
        $Walletcontroller = new WalletController;
        $wallet->address = $Walletcontroller->secured_decrypt($wallet->address);


        return view('package.packagepay', compact('moedas', 'packages', 'adesao', 'user', 'orderpackage', 'value_btc', 'wallet'));
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
            ->where('package_id', '=', 20)
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

        foreach ($orderpackages as $order) {
            $nodeOrders = NodeOrders::where('id_user', $id_user)
                ->where('id_order', $order->id)
                ->where('notify_url', route('notify.payment'))
                ->where('type', 1)->
                orderBy('id', 'desc')->first();

            $order->name = "Deposit";

            if (isset($nodeOrders)) {
                $order->name = $nodeOrders->coin;
                $order->coin = $nodeOrders->coin;
                $order->pstatus = $nodeOrders->status;
                $order->price_crypto = $nodeOrders->price_crypto * 1;
                $order->price_crypto_paid = $nodeOrders->price_crypto_payed * 1;
                $order->hash = $nodeOrders->hash;

                if (isset($nodeOrders->id_encript)) {
                    $wallet = Wallet::where('id', $nodeOrders->id_encript)->first();

                    if (isset($wallet)) {
                        if (isset($wallet->id_name)) {
                            $name = WalletName::where('id', $wallet->id_name)->first();

                            if (isset($name)) {
                                $order->name = $name->name;
                            } else {
                                $order->name = $wallet->id_name;
                            }
                        }
                    }
                }
            }

        }


        // dd($orderpackages);

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

    function filterWallet($mt)
    {
        $node = env('SERV_NODE');
        $urls = [
            "USDT_TRC20" => "api/create/wallet/tron",
            "BITCOIN" => "api/create/wallet/btc",
            "USDT_ERC20" => "api/create/wallet/ethereum",
            "TRX" => "api/create/wallet/tron",
            "ETH" => "api/create/wallet/ethereum",
            "SOL" => "api/create/wallet/sol",
            "BNB" => "api/create/wallet/bnb"
        ];

        $urlTotal = env('SERV_NODE') . '/' . $urls[$mt];
        // dd($urlTotal);

        $client = new Client();

        $response = $client->request('GET', $urlTotal, [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());

        if ($mt == "USDT_ERC20" || $mt == "ETH") {
            return [
                "privateKey" => $result->privateKey,
                "address" => $result->address,
                "mnemonic" => $result->mnemonic->phrase,
            ];
        }

        if ($mt == "BITCOIN") {
            return [
                "privateKey" => $result->Key,
                "address" => $result->Address,
                "mnemonic" => $result->Mnemonic,
            ];
        }

        if ($mt == "SOL") {
            return [
                "privateKey" => $result->key,
                "address" => $result->address,
                "mnemonic" => $result->address,
            ];
        }

        if ($mt == "TRX" || $mt == "USDT_TRC20") {
            return [
                "privateKey" => $result->privateKey,
                "address" => $result->address->base58,
                "addressHex" => $result->address->hex,
                "mnemonic" => "",
            ];
        }

        if ($mt == "BNB") {
            return [
                "privateKey" => $result->key,
                "address" => $result->address,
                "mnemonic" => $result->address,
            ];
        }
    }

    public function payCrypto(Request $request)
    {
        $system = SystemConf::first();
        if (isset($system)) {
            if ($system->all == 0 || $system->all == 1 && $system->internal == 0) {
                return redirect()->back();
            }
        }

        $order = OrderPackage::where('id', $request->id)->first();

        $Walletcontroller = new WalletController;

        $wallet = $Walletcontroller->returnWallet($request->method, Auth::id());

        if (!$wallet) {
            return redirect()->back();
        }

        $walletExists = $Walletcontroller->walletTxtWexists(Auth::id(), $Walletcontroller->secured_decrypt($wallet->address));

        // dd($walletExists);

        if (isset($walletExists) && json_decode($walletExists)) {
            $jsonW = json_decode($walletExists);
            if (isset($jsonW->address)) {

                if (strlen($request->price) < 7) {
                    $price = floatval(str_replace(',', '.', $request->price));
                } else {
                    $valorSemSeparadorMilhar = str_replace('.', '', $request->price);
                    $price = str_replace(',', '.', $valorSemSeparadorMilhar);
                }

                $price = $request->price;


                $order->wallet = $wallet->id;

                if (strpos($request->{$request->method}, ',') !== false) {
                    $order->price_crypto = str_replace(",", "", $request->{$request->method});
                } else {
                    $order->price_crypto = $request->{$request->method};
                }

                // dd($wallet);

                $order->save();

                $orderr = new stdClass();
                $orderr->id = $order->id;
                $orderr->id_user = $order->user_id;
                $orderr->price = $order->price;
                $orderr->price_crypto = $order->price_crypto;
                $orderr->wallet = $wallet->address;
                $orderr->notify_url = route('notify.payment');
                $orderr->id_encript = $wallet->id;

                $postNode = $this->genUrlCrypto($request->method, $orderr);


                $order = OrderPackage::where('id', $request->id)->first();
                $order->id_node_order = $postNode->id;
                $order->transaction_wallet = $postNode->merchant_id;
                $order->save();
            }
        } else {
            try {
                $userAprov = User::where('id', Auth::id())->first();
                $url = env('SERV_TXT');
                $json = [
                    "action" => "saveLog",
                    "content" => "(INTERN) Email: $userAprov->email - Coin: " . $request->method . " - Wallet: $wallet->address - PriceCrypto: " . $request->{$request->method} . " - priceDol: " . $order->price,
                    "operation" => "Wallet not found",
                    "user_id" => $userAprov->id
                ];

                $response = Http::post("$url/", $json);

                if ($response->successful()) {
                    $content = $response->body();
                    if (isset($content)) {
                    }

                } else {
                    $status = $response->status();
                    $content = $response->body();
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

            $walletdel = Wallet::where('id', $wallet->id)->first();
            $walletdel->delete();

            return redirect()->back();
        }




        // dd($postNode);

        return redirect()->back();

    }

    public function genUrlCrypto($method, $order)
    {
        // dd($order);
        $node = env('SERV_NODE');
        $paymentConfig = [
            // "api_url" => "http://127.0.0.1:3000/api/create/order"
            "api_url" => "$node/api/create/order"
        ];

        $system = SystemConf::first();
        if (isset($system)) {
            if ($system->all == 0 || $system->all == 1 && $system->node == 0) {
                return false;
            }
        }


        $curl = curl_init();

        if (isset($order->notify_url)) {
            $url = $order->notify_url;
        } else {
            $url = route('notify.payment');
        }

        $receiver_address = $order->receiver_address ?? null;
        $crypto_bought = $order->crypto_bought ?? null;
        $crypto_name_purchased = $order->crypto_name_purchased ?? null;
        $custom_data1 = $order->custom_data1 ?? null;
        $custom_data2 = $order->custom_data2 ?? null;

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
                "id_order": "' . $order->id . '",
                "id_user": "' . $order->id_user . '",
                "id_encript": "' . $order->id_encript . '",
                "price": "' . $order->price . '",
                "price_crypto": "' . $order->price_crypto . '",
                "wallet": "' . $order->wallet . '",
                "custom_data1": "' . $custom_data1 . '",
                "custom_data2": "' . $custom_data2 . '",
                "validity": "' . 60 . '",
                "coin": "' . $method . '",
                "receiver_address": "' . $receiver_address . '",
                "crypto_bought": "' . $crypto_bought . '",
                "crypto_name_purchased": "' . $crypto_name_purchased . '",
                "notify_url" : "' . $url . '"

            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $raw = json_decode(curl_exec($curl));

        curl_close($curl);

         return($raw);

        if ($raw) {
            return $raw;
        } else {
            return false;
        }
    }

    public function notify(Request $request)
    {
        $requestFormated = $request->all();

        // crypto
        if (isset($requestFormated["id"]) && !isset($requestFormated["node"])) {

            $payment = OrderPackage::where('transaction_wallet', $requestFormated["id"])
                ->orWhere('transaction_wallet', $requestFormated["merchant_id"])
                ->first();

            if (!isset($payment)) {
                return false;
            }

            if (strtolower($requestFormated["status"]) == 'paid') {
                $payment->payment_status = 1;
                $payment->status = 1;
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

        } else if (isset($requestFormated["node"])) {
            $payment = OrderPackage::where('transaction_wallet', $requestFormated["id"])
                ->orWhere('transaction_wallet', $requestFormated["merchant_id"])
                ->Where('id', $requestFormated["id_order"])
                ->first();

            if (!isset($payment) || $payment->id != $requestFormated["id_order"]) {
                return false;
            }

            if (
                strtolower($requestFormated["status"]) == 'paid'
                || strtolower($requestFormated["status"]) == 'overpaid'
                || strtolower($requestFormated["status"]) == 'underpaid'
            ) {
                // price_crypto_payed
                $payment->payment = $requestFormated["status"];
                if (isset($requestFormated["price_crypto_payed"])) {
                    // $payment->price_crypto_paid = $requestFormated["price_crypto_payed"];
                }
                $payment->payment_status = 1;
                $payment->status = 1;
            }

            if (strtolower($requestFormated["status"]) == 'cancelled' || strtolower($requestFormated["status"]) == 'expired') {
                $payment->payment = $requestFormated["status"];
                $payment->payment_status = 2;
                $payment->status = 0;
            }

            $payment->save();

            if ($payment->package_id == 20 && strtolower($requestFormated["status"]) == 'paid' || strtolower($requestFormated["status"]) == 'overpaid') {
                // $this->sendPostPayOrder($payment->id);
            }

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
