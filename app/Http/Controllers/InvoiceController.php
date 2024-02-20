<?php

namespace App\Http\Controllers;

use App\Models\NodeOrders;
use App\Models\OrderPackage;
use App\Models\Package;
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

        //dd($id);
        $order = NodeOrders::where('id_order', $id)->get();
        if (count($order) > 0) {
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
                "USDT_ERC20"
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

            if ($request->method == 'USDT_TRC20' || $request->method == 'USDT_ERC20') {
                $trc20 = 1;
                $erc20 = 1;

                $price_order = $request->value;

                $moedas = [
                    "USDT_ERC20" => number_format($price_order / $erc20, 2),
                    "USDT_TRC20" => number_format($price_order / $trc20, 2),
                ];
            } else {
                $api_key = 'ca699a34-d3c2-4efc-81e9-6544578433f8';

                $response = Http::withHeaders([
                    'X-CMC_PRO_API_KEY' => $api_key,
                    'Content-Type' => 'application/json',
                ])->get('https://pro-api.coinmarketcap.com/v2/cryptocurrency/quotes/latest?symbol=btc,eth,trx,erc20,USDT');

                $data = $response->json();
                // dd($data['data']['TRX'][0]['quote']['USD']['price']);

                // $bitcoin = $result->bitcoin->usd;
                $price_order = $request->value;
                // $value_btc = $price_order / $bitcoin;

                $btc = $data['data']['BTC'][0]['quote']['USD']['price'];
                // $erc20 = $data['data']['ERC20'][0]['quote']['USD']['price'];
                // $trc20 = $data['data']['USDT'][0]['quote']['USD']['price'];
                $trc20 = 1;
                $erc20 = 1;
                $trx = $data['data']['TRX'][0]['quote']['USD']['price'];
                $eth = $data['data']['ETH'][0]['quote']['USD']['price'];

                $moedas = [
                    "BITCOIN" => number_format($price_order / $btc, 5),
                    "ETH" => number_format($price_order / $eth, 4),
                    "USDT_ERC20" => number_format($price_order / $erc20, 2),
                    "TRX" => number_format($price_order / $trx, 2),
                    "USDT_TRC20" => number_format($price_order / $trc20, 2),
                ];
            }

            // dd($moedas);

            $orders9 = NodeOrders::where('coin', $request->method)
                ->where('id_user', $user->id)
                ->orderBy('id', 'desc')
                ->limit(9)
                ->get();


            if (count($orders9) > 0) {
                // dd($orders9);
                $usedWallets = $orders9->pluck('wallet')->toArray();

                $unusedWallets = Wallet::where('user_id', $user->id)
                    ->where('coin', $request->method)
                    ->whereNotIn('address', $usedWallets)
                    ->get();


                if ($unusedWallets->isNotEmpty()) {

                    $selectedWallet = $unusedWallets->random();
                    $wallet = $selectedWallet;
                } else {
                    return redirect()->back()->with('error', "Wallet Not found");
                }
            } else {
                $myWallets = Wallet::where('user_id', $user->id)->where('coin', $request->method)->get();

                $wallet = null;

                if (count($myWallets) > 0) {
                    # code...
                    $ids = [];
                    foreach ($myWallets as $w) {
                        array_push($ids, $w->id);
                    }

                    $idSorteado = $ids[array_rand($ids)];

                    $wallet = Wallet::where('id', $idSorteado)->first();
                } else {
                    return redirect()->back()->with('wallet', "Wallet Not found");
                }
            }


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



            $orderr = new stdClass();
            $orderr->id = $newOrder->id;
            $orderr->id_user = $newOrder->user_id;
            $orderr->price = $newOrder->price;
            $orderr->price_crypto = $newOrder->price_crypto;
            $orderr->wallet = $wallet->address;
            $orderr->notify_url = route('notify.payment');

            $controller = new PackageController;

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


        } catch (\Throwable $th) {
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

        $response = $client->request('GET', "https://walletprivate.onrender.com/api/verify/order/" . $request->id, [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());
        // dd($result);
        return redirect()->back();
    }

}
