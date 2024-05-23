<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;
use App\Models\NodeOrders;
use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\PriceCoin;
use App\Models\SystemConf;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Http;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use stdClass;

class InvoiceController extends Controller
{


    public function orderId($id)
    {

        $order = NodeOrders::where('id_order', $id)->get();
        if (count($order) > 0) {
            $Walletcontroller = new WalletController;
            $dec = $Walletcontroller->secured_decrypt($order[0]->wallet);
            if (isset($dec) && $dec) {
                $order[0]->wallet = $Walletcontroller->secured_decrypt($order[0]->wallet);
            }
            return view('invoice.invoice_step2', compact('order'));
        } else {
            abort(404);
        }

    }

    public function index($id)
    {

        //dd($id);
        $order = NodeOrders::where('id', $id)->get();
        if (count($order) > 0) {
            $Walletcontroller = new WalletController;
            $dec = $Walletcontroller->secured_decrypt($order[0]->wallet);
            if (isset($dec) && $dec) {
                $order[0]->wallet = $Walletcontroller->secured_decrypt($order[0]->wallet);
            }
            return view('invoice.invoice_step2', compact('order'));
        } else {
            return $this->orderId($id);
        }

    }

    public function create(Request $request)
    {
        $valorCookie = null;
        $userCookie = null;
        if ($request->cookie('financial')) {
            $valorCookie = $request->cookie('financial');
            $userCookie = User::where('id', $valorCookie)->first();
        }

        return view('invoice.invoice_step1', compact('userCookie'));

    }

    public function store(Request $request)
    {
        try {

            $system = SystemConf::first();
            if (isset($system)) {
                if ($system->all == 0 || $system->all == 1 && $system->external == 0) {
                    return redirect()->back()->with('error', "System disabled");
                }
            }

            $regras = [
                'value' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'] // Aceita números decimais até duas casas decimais
            ];

            $validator = Validator::make($request->all(), $regras);

            if ($validator->fails()) {
                return redirect()->back()->with('error', "Value invalid");
            }

            $metodos = [
                "BITCOIN",
                "ETH",
                "TRX",
                "USDT_TRC20",
                "USDT_ERC20",
                "SOL"
            ];

            if (!in_array(strtoupper($request->method), $metodos)) {
                return redirect()->back()->with('error', "Method not allowed");
            }
            //code...

            $package = Package::where('id', 20)->first();

            $user = User::where('login', $request->login)->first();


            if (!isset($user) || !Hash::check($request->password, $user->financial_password) && !$request->cookie('financial')) {
                return redirect()->back()->with('error', "User Not found");
            }

            if (!isset($package)) {
                return redirect()->back()->with('error', "Invoice Not Available");

            }


            $price_order = $request->value;


            $btc = PriceCoin::where('name', "BTC")->first()->one_in_usd;
            $trc20 = PriceCoin::where('name', "TRC20")->first()->one_in_usd;
            $erc20 = PriceCoin::where('name', "ERC20")->first()->one_in_usd;
            $trx = PriceCoin::where('name', "TRX")->first()->one_in_usd;
            $eth = PriceCoin::where('name', "ETH")->first()->one_in_usd;
            $sol = PriceCoin::where('name', "SOL")->first()->one_in_usd;

            $moedas = [
                "BITCOIN" => number_format($price_order / $btc, 5),
                "ETH" => number_format($price_order / $eth, 4),
                "USDT_ERC20" => number_format($price_order / $erc20, 2),
                "TRX" => number_format($price_order / $trx, 2),
                "USDT_TRC20" => number_format($price_order / $trc20, 2),
                "SOL" => number_format($price_order / $sol, 3),
            ];


            $Walletcontroller = new WalletController;

            $wallet = $Walletcontroller->returnWallet($request->method, $user->id);
            if (!$wallet) {
                return redirect()->back()->with('error', "Wallet invalid");
            }

            $walletExists = $Walletcontroller->walletTxtWexists($user->id, $Walletcontroller->secured_decrypt($wallet->address));

            if (isset($walletExists) && json_decode($walletExists)) {
                $jsonW = json_decode($walletExists);
                if (isset($jsonW->address)) {
                    $newOrder = new OrderPackage;
                    $newOrder->user_id = $user->id;
                    $newOrder->reference = $package->name;
                    $newOrder->payment_status = 0;
                    $newOrder->transaction_code = 0;
                    $newOrder->package_id = $package->id;
                    $newOrder->price = $request->value;
                    $newOrder->amount = 1;
                    $newOrder->transaction_wallet = 0;
                    $newOrder->printscreen = '-';
                    $newOrder->pass = '-';
                    $newOrder->server = '-';
                    $newOrder->user = '-';
                    $newOrder->price_crypto = $moedas[$request->method];
                    $newOrder->wallet = $wallet->id;
                    $newOrder->save();


                    $controller = new PackageController;

                    $orderr = new stdClass();
                    $orderr->id = $newOrder->id;
                    $orderr->id_user = $newOrder->user_id;
                    $orderr->price = $newOrder->price;

                    // $orderr->price_crypto = $newOrder->price_crypto;

                    if (strpos($moedas[$request->method], ',') !== false) {
                        $orderr->price_crypto = str_replace(",", "", $moedas[$request->method]);
                    } else {
                        $orderr->price_crypto = $moedas[$request->method];
                    }

                    $orderr->wallet = $wallet->address;
                    $orderr->notify_url = route('notify.payment');
                    $orderr->id_encript = $wallet->id;

                    $postNode = $controller->genUrlCrypto($request->method, $orderr);

                    $ord = OrderPackage::where('id', $newOrder->id)->first();
                    $ord->transaction_wallet = $postNode->merchant_id;
                    $ord->id_node_order = $postNode->id;
                    $ord->save();

                    if (!$request->cookie('financial')) {
                        $valorCookie = $user->id;
                        return redirect()->route('invoice.index', $postNode->id)->withCookie(cookie('financial', $valorCookie, 1440)); // 1440 minutos = 24 horas
                    }

                    return redirect()->route('invoice.index', $postNode->id);
                }
            } else {
                try {
                    $userAprov = $user;
                    $url = env('SERV_TXT');
                    $json = [
                        "action" => "saveLog",
                        "content" => "(INVOICE) Email: $userAprov->email - Coin: " . $request->method . " - Wallet: $wallet->address - PriceCrypto: " . $moedas[$request->method] . " - priceDol: " . $request->value,
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
                    //code...
                } catch (\Throwable $th) {
                    //throw $th;
                }

                $walletdel = Wallet::where('id', $wallet->id)->first();
                $walletdel->delete();

                return redirect()->back()->with('error', "Wallet invalid");
            }

        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->with('error', "Error while processing");
        }
    }

    public function verify(Request $request)
    {
        $regras = [
            'id' => ['required', 'numeric'] // Aceita números decimais até duas casas decimais
        ];

        $validator = Validator::make($request->all(), $regras);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $nodeOrder = NodeOrders::where('id', $request->id)->first();

        if (!isset($nodeOrder)) {
            return redirect()->back();
        }

        $client = new Client();
        $node = env('SERV_NODE');
        $client->request('GET', "$node/api/verify/order/" . $request->id, [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return redirect()->back();
    }



}
