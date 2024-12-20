<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;
use App\Models\IpAccessApi;
use App\Models\IpAllowedApi;
use App\Models\IpWhitelist;
use App\Models\NodeOrders;
use App\Models\OrderPackage;
use App\Models\PaymentLog;
use App\Models\PriceCoin;
use App\Models\SystemConf;
use App\Models\TaxCrypto;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletName;
use App\Models\WithdrawWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use stdClass;

class WalletController extends Controller
{
    public function index()
    {

        // $controller = new CronWalletController;
        // $controller->index();

        // return;

        $user = User::find(Auth::id());

        $wallets = Wallet::where('user_id', $user->id)->orderBy('id', 'DESC')->get()->groupBy('coin');

        $icons = [
            'SOL' => 'https://seeklogo.com/images/S/solana-sol-logo-12828AD23D-seeklogo.com.png',
            'BNB' => 'https://cryptologos.cc/logos/bnb-bnb-logo.png',
            'BITCOIN' => 'https://cryptologos.cc/logos/bitcoin-btc-logo.png?v=029',
            'TRX' => 'https://cryptologos.cc/logos/tron-trx-logo.png?v=029',
            'ETH' => 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029',
            'USDT_TRC20' => 'https://crypto.binfinitybank.com/public/images/tron-usdt.png',
            'USDT_ERC20' => 'https://cryptologos.cc/logos/tether-usdt-logo.png?v=029',
        ];

        $moviment = [];

        $decimals = [
            'BITCOIN' => 6,
            'TRX' => 2,
            'ETH' => 6,
            'USDT_TRC20' => 2,
            'USDT_ERC20' => 2,
            'SOL' => 3,
            'BNB' => 4,
        ];

        $btc = PriceCoin::where('name', "BTC")->first()->one_in_usd;
        $trc20 = PriceCoin::where('name', "TRC20")->first()->one_in_usd;
        $erc20 = PriceCoin::where('name', "ERC20")->first()->one_in_usd;
        $trx = PriceCoin::where('name', "TRX")->first()->one_in_usd;
        $eth = PriceCoin::where('name', "ETH")->first()->one_in_usd;
        $sol = PriceCoin::where('name', "SOL")->first()->one_in_usd;
        $bnb = PriceCoin::where('name', "BNB")->first()->one_in_usd;

        foreach ($icons as $key => $value) {
            $dep = NodeOrders::where('coin', $key)
                ->where('id_user', $user->id)
                ->where(function ($query) {
                    $query->whereRaw('LOWER(status) = ?', ['paid'])
                        ->orWhereRaw('LOWER(status) = ?', ['underpaid'])
                        ->orWhereRaw('LOWER(status) = ?', ['overpaid']);
                })
                ->where('type', 1)
                ->get()
                ->sum('price_crypto_payed');

            $saq = NodeOrders::where('coin', $key)
                ->where('id_user', $user->id)
                ->where(function ($query) {
                    $query->whereRaw('LOWER(status) = ?', ['paid'])
                        ->orWhereRaw('LOWER(status) = ?', ['underpaid'])
                        ->orWhereRaw('LOWER(status) = ?', ['overpaid']);
                })
                ->where('type', 2)
                ->get()
                ->sum('price_crypto_payed');


            $tt = number_format($dep, $decimals[$key], '.', '') - number_format($saq, $decimals[$key], '.', '');

            $moedas = [
                "BITCOIN" => number_format($btc * $tt, 2, '.', ''),
                "ETH" => number_format($eth * $tt, 2, '.', ''),
                "USDT_ERC20" => number_format($erc20 * $tt, 2, '.', ''),
                "TRX" => number_format($trx * $tt, 2, '.', ''),
                "USDT_TRC20" => number_format($trc20 * $tt, 2, '.', ''),
                "SOL" => number_format($sol * $tt, 2, '.', ''),
                "BNB" => number_format($bnb * $tt, 2, '.', ''),
            ];

            $moviment[$key] = [
                "dep" => number_format($dep, $decimals[$key], '.', ''),
                "saq" => number_format($saq, $decimals[$key], '.', ''),
                'tt' => $moedas[$key]
            ];


        }

        foreach ($wallets as $key => $value) {
            $lastT = NodeOrders::where('coin', $key)
                ->where('id_user', $user->id)
                // ->where('type', 1)
                ->where(function ($query) {
                    $query->whereRaw('LOWER(status) = ?', ['paid'])
                        ->orWhereRaw('LOWER(status) = ?', ['underpaid'])
                        ->orWhereRaw('LOWER(status) = ?', ['overpaid']);
                })
                ->orderBy('id', 'desc')
                ->first();

            if (isset($lastT)) {
                $lastT = $lastT->price_crypto_payed ?? $lastT->price_crypto;
            } else {
                $lastT = 0;
            }
            $lastT = $lastT * 1;

            $value->name = $key;
            $name = WalletName::where('id', $value[0]->id_name)->first();
            if (isset($name)) {
                $value->name = $name->name;
            } else {
                $value->name = $value[0]->id_name;
            }

            $value->lastT = $lastT;

        }


        return view('wallets.list', compact('wallets', 'icons', 'moviment'));
    }

    public function store(Request $request)
    {
        try {

            // dd($request);

            $user = User::find(Auth::id());

            $controller = new PackageController;

            $WithDrawal = WithdrawWallet::where('user_id', $user->id)->where('crypto', $request->coin)->first();

            if (!isset($WithDrawal)) {
                \Alert::error("Add your wallet in > WithDrawal Wallet (" . $request->coin . ")");
                return redirect()->back();
            }

            $wallets = Wallet::where('user_id', $user->id)->where('coin', $request->coin)->get();

            if (count($wallets) == 10) {
                return redirect()->route('wallets.index');
            }

            if (WalletName::where('id_user', Auth::id())->where('coin', $request->coin)->exists()) {
                $nn = WalletName::where('id_user', Auth::id())->where('coin', $request->coin)->first();
                $nn->name = $request->name;
                $nn->active = 1;
                $nn->save();
            } else {
                $nn = new WalletName;
                $nn->id_user = Auth::id();
                $nn->name = $request->name;
                $nn->coin = $request->coin;
                $nn->active = 1;
                $nn->save();
            }

            $debbug = [];
            while (count($wallets) < 10) {

                $walletGen = $controller->filterWallet($request->coin);

                $debbug[] = $walletGen;
                $first_key = env('FIRSTKEY');
                $second_key = env('SECONDKEY');

                $json = [
                    "action" => "create",
                    "first" => $first_key,
                    "second" => $second_key,
                    "user_id" => Auth::id(),
                    "address" => $walletGen['address'],
                    "key" => $walletGen['privateKey'],
                    "mnemonic" => $walletGen['mnemonic'],
                ];

                $retornoTxt = $this->sendPostBin2($json);
                if (isset($retornoTxt)) {

                    $wallet = new Wallet;
                    $wallet->user_id = Auth::id();
                    $wallet->id_name = $nn->id ?? '';
                    $wallet->wallet = $this->secured_encrypt($walletGen['address']);

                    if ($request->coin == "TRX" || $request->coin == "USDT_TRC20") {
                        $wallet->description = $walletGen['addressHex'] ?? '';
                    } else {
                        $wallet->description = $this->secured_encrypt('wallet');
                    }

                    $wallet->address = $this->secured_encrypt($walletGen['address']);
                    $wallet->key = "-------";
                    $wallet->mnemonic = "-------";
                    $wallet->coin = $request->coin;
                    $wallet->save();
                    // dd($wallet);
                }
                $wallets = Wallet::where('user_id', $user->id)->where('coin', $request->coin)->get();
            }
            // dd($wallets);

            \Alert::success("Sucessfully");
            return redirect()->route('wallets.index');
        } catch (\Throwable $th) {
            //  dd($th->getMessage());
            \Alert::error("Failed");
            return redirect()->route('wallets.index');
            //throw $th;
        }
    }

    private function sendPostBin2($json)
    {
        $user = User::where('id', Auth::id())->first();
        if (isset($user->hash_user_bin)) {
            $json["hash_user"] = $user->hash_user_bin;
        }
        $url = env('SERV_TXT');

        $json["first"] = env('FIRSTKEY');
        $json["second"] = env('SECONDKEY');
        //dd($json);

        $response = Http::post("$url/", $json);

        if ($response->successful()) {
            $content = $response->body();
            if (isset($content)) {
                if (!isset($user->hash_user_bin)) {
                    $user->hash_user_bin = $content;
                    $user->save();
                }

                return true;
            }

        } else {
            $status = $response->status();
            $content = $response->body();

            // dd($content);

            return false;
        }
        return false;
    }

    public function walletTxtWexists($id_user, $address)
    {
        $user = User::where("id", $id_user)->first();


        $first_key = env('FIRSTKEY');
        $second_key = env('SECONDKEY');

        $json = [
            "action" => "get",
            "first" => $first_key,
            "second" => $second_key,
            "user_id" => $id_user,
            "address" => $address
        ];

        if (isset($user->hash_user_bin)) {
            $json["hash_user"] = $user->hash_user_bin;
        }

        $url = env('SERV_TXT');

        $response = Http::post("$url/", $json);

        if ($response->successful()) {
            $content = $response->body();
            if (isset($content)) {
                if (json_decode($content)) {
                    if (json_decode($content)->address) {
                        return $content;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
        return false;

    }

    public function notify(Request $request)
    {
        try {
            $requestFormated = $request->all();

            $ip = $request->ip();
            $ipRequest = new IpAccessApi;
            $ipRequest->ip = $ip;
            $ipRequest->operation = "api/web/get/wallet";
            $ipRequest->request = json_encode($requestFormated);
            // dd($ipRequest);
            $ipRequest->save();

            $validator = Validator::make($request->all(), [
                'id_order' => 'required|string|max:255',
                'price' => 'required',
                'price_crypto' => 'nullable',
                'login' => 'required|email',
                'password' => 'required|string|max:255',
                'coin' => 'required|string|max:255',
                'notify_url' => 'required|url',
                'receiver_address' => 'nullable|string',
                'crypto_bought' => 'nullable',
                'crypto_name_purchased' => 'nullable|string',
                'custom_data1' => 'nullable|string',
                'custom_data2' => 'nullable|string',
                'fee_included' => 'nullable',
            ]);


            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $system = SystemConf::first();
            if (isset($system)) {
                if ($system->all == 0 || $system->all == 1 && $system->api == 0) {
                    return response()->json(['error' => "System disabled"], 422);
                }
            }

            if (isset($requestFormated['price_crypto'])) {
                if (strpos($requestFormated['price_crypto'], ',') !== false) {
                    $price_crypto = str_replace(",", "", $requestFormated['price_crypto']);
                }
            }

            $price_ = $requestFormated['price'];
            if (strpos($requestFormated['price'], ',') !== false) {
                $price_ = str_replace(",", "", $requestFormated['price']);
            }

            // crypto
            if (isset($requestFormated["login"])) {

                $log = new PaymentLog;
                $log->content = $requestFormated['id_order'];
                $log->order_package_id = 1;
                $log->operation = "payment";
                $log->controller = "packageController";
                $log->http_code = "200";
                $log->route = "/packages/packagepay/notify";
                $log->status = "success";
                $log->json = json_encode($request->all());
                $log->save();

                $userAprov = User::where('email', $requestFormated['login'])->orWhere('login', $requestFormated['login'])->first();

                if (!isset($userAprov)) {
                    return response()->json(['error' => "User not allowed"], 422);
                }

                if (!Hash::check($requestFormated['password'], $userAprov->password)) {
                    return response()->json(['error' => "User not found"], 422);
                }

                if ($userAprov->activated == null || $userAprov->activated == 0) {
                    return response()->json(['error' => "User not allowed"], 422);
                }

                $ipAllowed = IpAllowedApi::where('ip', $ip)->where('user_id', $userAprov->id)->first();
                if (!isset($ipAllowed)) {
                    return response()->json(['error' => "Ip not allowed", 'ip_request' => $ip], 422);
                }

                $wallet = $this->returnWallet($requestFormated["coin"], $userAprov->id);
                // return $wallet;
                if (!$wallet) {
                    return response()->json(['error' => "Error in get wallet"], 422);
                }

                // return $wallet;
                $btc = PriceCoin::where('name', "BTC")->first()->one_in_usd;
                $trc20 = PriceCoin::where('name', "TRC20")->first()->one_in_usd;
                $erc20 = PriceCoin::where('name', "ERC20")->first()->one_in_usd;
                $trx = PriceCoin::where('name', "TRX")->first()->one_in_usd;
                $eth = PriceCoin::where('name', "ETH")->first()->one_in_usd;
                $sol = PriceCoin::where('name', "SOL")->first()->one_in_usd;
                $bnb = PriceCoin::where('name', "BNB")->first()->one_in_usd;

                $walletExists = $this->walletTxtWexists($userAprov->id, $this->secured_decrypt($wallet->address));
                if (isset($walletExists) && json_decode($walletExists)) {
                    $jsonW = json_decode($walletExists);
                    if (isset($jsonW->address)) {
                        $controller = new PackageController;

                        if (isset($requestFormated['price_crypto'])) {
                            $price_crypto = $requestFormated['price_crypto'];

                            if (strpos($requestFormated['price_crypto'], ',') !== false) {
                                $price_crypto = str_replace(",", "", $requestFormated['price_crypto']);
                            }
                        } else {

                            $moedas = [
                                "BITCOIN" => number_format($price_ / $btc, 5),
                                "BTC" => number_format($price_ / $btc, 6),
                                "ETH" => number_format($price_ / $eth, 5),
                                "USDT_ERC20" => number_format($price_ / $erc20, 2),
                                "TRX" => number_format($price_ / $trx, 2),
                                "USDT_TRC20" => number_format($price_ / $trc20, 2),
                                "SOL" => number_format($price_ / $sol, 3),
                                "BNB" => number_format($price_ / $bnb, 4),
                            ];

                            $coinRequest = $requestFormated['coin'];
                            $price_crypto = $moedas[$coinRequest];

                            if (strpos($price_crypto, ',') !== false) {
                                $price_crypto = str_replace(",", "", $price_crypto);
                            }

                            $log = new PaymentLog;
                            $log->content = $price_crypto;
                            $log->order_package_id = 1;
                            $log->operation = "payment";
                            $log->controller = "packageController";
                            $log->http_code = "200";
                            $log->route = "/packages/packagepay/notify";
                            $log->status = "success";
                            $log->json = json_encode($request->all());
                            $log->save();
                        }

                        $order = new stdClass();
                        $order->id = $requestFormated['id_order'];
                        $order->id_user = $userAprov->id;
                        $order->price = $price_;
                        $order->price_crypto = $price_crypto;
                        $order->wallet = $wallet->address;
                        $order->notify_url = $requestFormated['notify_url'];
                        $order->id_encript = $wallet->id;
                        $order->custom_data1 = isset($requestFormated['custom_data1']) ? $requestFormated['custom_data1'] : '';
                        $order->custom_data2 = isset($requestFormated['custom_data2']) ? $requestFormated['custom_data2'] : '';
                        $order->extra_price = 0;
                        $order->extra_crypto = 0;
                        if (
                            isset($requestFormated['crypto_bought']) &&
                            isset($requestFormated['crypto_name_purchased'])
                        ) {
                            $crypto_bought = $requestFormated['crypto_bought'];
                            if (strpos($requestFormated['crypto_bought'], ',') !== false) {
                                $crypto_bought = str_replace(",", "", $requestFormated['crypto_bought']);
                            }

                            $order->is_crypto_purchased = 1;
                            $order->crypto_bought = $crypto_bought;
                            $order->crypto_name_purchased
                                = $requestFormated['crypto_name_purchased'];
                        }

                        if (isset($requestFormated['fee_included']) && $requestFormated['fee_included'] == false) {
                            $extra_price = $this->calculateExtraValue($order->price, $requestFormated['coin'], $userAprov->id);
                            $order->extra_price = $extra_price;

                            $newTaxCrypto = [
                                "BITCOIN" => number_format($extra_price / $btc, 5),
                                "BTC" => number_format($extra_price / $btc, 6),
                                "ETH" => number_format($extra_price / $eth, 5),
                                "USDT_ERC20" => number_format($extra_price / $erc20, 2),
                                "TRX" => number_format($extra_price / $trx, 3),
                                "USDT_TRC20" => number_format($extra_price / $trc20, 2),
                                "SOL" => number_format($extra_price / $sol, 5),
                                "BNB" => number_format($extra_price / $bnb, 5),
                            ];

                            $order->extra_crypto = $newTaxCrypto[$requestFormated['coin']];
                        }

                        $postNode = $controller->genUrlCrypto($requestFormated['coin'], $order);
                        // return $postNode;

                        return [
                            "id" => $postNode->id,
                            "merchant_id" => $postNode->merchant_id,
                            "wallet" => $this->secured_decrypt($postNode->wallet),
                            "url" => route('invoice.index', $postNode->id),
                            "price_usd" => $postNode->price_usd,
                            "price_crypto" => $postNode->price_crypto,
                            "extra_price_usd" => $order->extra_price,
                            "extra_crypto" => $order->extra_crypto
                        ];

                    }
                } else {
                    try {

                        $walletdel = Wallet::where('id', $wallet->id)->first();
                        $walletdel->delete();

                        $url = env('SERV_TXT');
                        $json = [
                            "action" => "saveLog",
                            "content" => "(API) Email: $userAprov->email - Coin: " . $requestFormated["coin"] . " - Wallet: $wallet->address - PriceCrypto: " . $requestFormated['price_crypto'] . " - priceDol: " . $price_,
                            "operation" => "Wallet not found",
                            "user_id" => $userAprov->id
                        ];

                        $response = Http::post("$url/", $json);

                        if ($response->successful()) {
                            $content = $response->body();
                            if (isset($content)) {
                                return response()->json(['error' => "Error intern in get wallet"], 422);
                            }

                        } else {
                            $status = $response->status();
                            $content = $response->body();
                            return response()->json(['error' => "Error intern in get wallet"], 422);
                        }
                        return response()->json(['error' => "Error intern in get wallet"], 422);


                    } catch (\Throwable $th) {
                        return response()->json(['error' => "Error intern in get wallet"], 422);
                    }


                }
                return $this->notify($request);

            }


            return response("OK", 200);
        } catch (\Throwable $th) {
            // return response()->json(['error' => "Error in create transaction"], 422);
            return response()->json(['error' => "Error in create transaction " . $th->getMessage()], 422);
        }
    }

    public function calculateExtraValue($amount_to_receive, $coin, $user_id)
    {
        $user = User::find($user_id);
        $tax = TaxCrypto::where('user_id', $user->id)->where('coin', $coin)->first();

        // Forçar a conversão para float
        $taxa_fixa = $tax->tx_gas ?? 4; // Taxa fixa (valor padrão de 4 se não encontrado)
        $taxa_percentual = $tax->tx_bin ?? 1; // Taxa percentual (valor padrão de 1% se não encontrado)


        $amount_to_receive = $amount_to_receive * 1;
        $valor_com_taxa_percentual = $amount_to_receive * (($taxa_percentual * 1) / 100);

        // Somando a taxa fixa
        $extra_value = $valor_com_taxa_percentual + ($taxa_fixa * 1);

        return $extra_value;
    }


    public function returnWallet($coin, $user_id)
    {
        $system = SystemConf::first();
        if (isset($system)) {
            if ($system->all == 0 || $system->all == 1 && $system->node == 0) {

                $log = new CustomLog();
                $log->content = 'API System disabled';
                $log->user_id = 1;
                $log->operation = 'get wallet api';
                $log->controller = "app/controller/WalletController";
                $log->http_code = 200;
                $log->route = "API";
                $log->status = "ERROR";
                $log->save();
                return false;
            }
        }

        $tempoLimite = Carbon::now()->subSeconds(5);

        $lastNode = NodeOrders::where('coin', $coin)
            ->where('id_user', $user_id)
            ->where('createdAt', '>', $tempoLimite)
            ->orderBy('id', 'desc')
            ->first();


        if (isset($lastNode)) {
            $log = new CustomLog();
            $log->content = 'api usada nos ultimos segundos';
            $log->user_id = 1;
            $log->operation = 'get wallet api';
            $log->controller = "app/controller/WalletController";
            $log->http_code = 200;
            $log->route = "API";
            $log->status = "ERROR";
            $log->save();

            return false;
        }

        $orders9 = NodeOrders::where('coin', $coin)
            ->where('id_user', $user_id)
            ->orderBy('id', 'desc')
            ->limit(9)
            ->get();

        if (count($orders9) > 0) {
            $usedWallets = $orders9->pluck('id_encript')->toArray();

            $usedWallets = array_filter($usedWallets, function ($value) {
                return $value != null;
            });

            $unusedWallets = Wallet::where('user_id', $user_id)
                ->where('active', 1)
                ->where('coin', $coin)
                ->whereNotIn('id', $usedWallets)
                ->get();

            if ($unusedWallets->isNotEmpty()) {

                $selectedWallet = $unusedWallets->random();
                $wallet = $selectedWallet;
            } else {
                if (isset($usedWallets)) {
                    foreach (array_reverse($usedWallets) as $value) {
                        $wallet = Wallet::where('id', $value)->where('active', 1)->first();

                        if (isset($wallet)) {
                            return $wallet;
                        }
                    }
                }

                $log = new CustomLog();
                $log->content = 'nenhuma carteira ativa encontrada';
                $log->user_id = 1;
                $log->operation = 'get wallet api';
                $log->controller = "app/controller/WalletController";
                $log->http_code = 200;
                $log->route = "API";
                $log->status = "ERROR";
                $log->save();
                return false;
            }

        } else {
            $myWallets = Wallet::where('user_id', $user_id)
                ->where('coin', $coin)
                ->where('active', 1)
                ->get();

            $wallet = null;

            if (count($myWallets) > 0) {
                # code...
                $ids = [];
                foreach ($myWallets as $w) {
                    array_push($ids, $w->id);
                }

                $idSorteado = $ids[array_rand($ids)];

                $wallet = Wallet::where('id', $idSorteado)
                    ->where('active', 1)
                    ->first();
            } else {
                $log = new CustomLog();
                $log->content = 'nenhuma carteira encontrada';
                $log->user_id = 1;
                $log->operation = 'get wallet api';
                $log->controller = "app/controller/WalletController";
                $log->http_code = 200;
                $log->route = "API";
                $log->status = "ERROR";
                $log->save();
                return false;
            }
        }

        return $wallet;
    }

    public function transactions()
    {
        $user = User::find(Auth::id());

        $transactions = NodeOrders::where('id_user', $user->id)->orderBy('id', 'DESC')->get();

        return view('wallets.transactions', compact('transactions'));
    }

    public function WithdrawWallet()
    {
        $user = User::find(Auth::id());

        $wallets = WithdrawWallet::where('user_id', $user->id)->orderBy('id', 'DESC')->get();

        $coins = ['USDT_TRC20', 'TRX', 'ETH', 'BITCOIN', 'USDT_ERC20', 'SOL', 'BNB'];

        $walletbyCoin = [];

        foreach ($coins as $coin) {
            foreach ($wallets as $value) {
                if ($coin == $value->crypto) {
                    $walletbyCoin[$coin] = $value->wallet_address;
                }
            }
        }

        return view('wallets.WithdrawWallet', compact('wallets', 'coins', 'walletbyCoin'));

    }
    public function WithdrawWalletStore(Request $request)
    {
        $user = User::find(Auth::id());
        $first_key = env('FIRSTKEY');
        $second_key = env('SECONDKEY');

        $wtlist = IpWhitelist::where('ip', $request->ip())->get();

        if (count($wtlist) < 1) {
            // return redirect()->route('wallets.WithdrawWallet');
        }

        try {

            $wallet = WithdrawWallet::where('user_id', $user->id)->where('crypto', $request->coin)->first();

            $json = [
                "action" => "saveTrans",
                "first" => env('FIRSTKEY'),
                "second" => env('SECONDKEY'),
                "user_id" => Auth::id(),
                "address" => $request->address,
                "coin" => $request->coin
            ];

            if (isset($wallet)) {
                \Alert::error("Contact support");
                return redirect()->back();
            } else {
                $retornoTxt = $this->sendPostBin2($json);
            }


            if (isset($retornoTxt)) {

                if (isset($wallet)) {
                    \Alert::error("Contact support");
                    // $wallet->wallet_address = $request->address;
                    // $wallet->save();
                } else {
                    $nwallet = new WithdrawWallet;
                    $nwallet->user_id = $user->id;
                    $nwallet->wallet_address = $request->address;
                    $nwallet->crypto = $request->coin;
                    $nwallet->save();
                }
            } else {
                \Alert::error("Error in add wallet");
            }

            return redirect()->route('wallets.WithdrawWallet');
        } catch (\Throwable $th) {
            // dd($th);
            $wallets = WithdrawWallet::where('user_id', $user->id)->get();

            foreach ($wallets as $wallet) {
                $json = [
                    "action" => "saveTrans",
                    "first" => env('FIRSTKEY'),
                    "second" => env('SECONDKEY'),
                    "user_id" => Auth::id(),
                    "address" => $wallet->wallet_address,
                    "coin" => $wallet->crypto
                ];

                $retornoTxt = $this->sendPostBin2($json);
                # code...
            }

            \Alert::error("Error - Contact Support");
            return redirect()->route('wallets.WithdrawWallet');
        }
    }

    public function secured_decrypt($input)
    {
        $first_key = env('FIRSTKEY');
        $second_key = env('SECONDKEY');
        $mix = base64_decode($input);

        $method = "aes-256-cbc";
        $iv_length = openssl_cipher_iv_length($method);

        $iv = substr($mix, 0, $iv_length);
        $second_encrypted = substr($mix, $iv_length, 64);
        $first_encrypted = substr($mix, $iv_length + 64);

        $data = openssl_decrypt($first_encrypted, $method, $first_key, OPENSSL_RAW_DATA, $iv);
        $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

        if (hash_equals($second_encrypted, $second_encrypted_new))
            return $data;

        return false;
    }

    public function secured_decrypt_public(Request $request)
    {
        $requestFormated = $request->all();

        $first_key = $requestFormated['f'];
        $second_key = $requestFormated['s'];
        $mix = base64_decode($requestFormated['c']);

        $method = "aes-256-cbc";
        $iv_length = openssl_cipher_iv_length($method);

        $iv = substr($mix, 0, $iv_length);
        $second_encrypted = substr($mix, $iv_length, 64);
        $first_encrypted = substr($mix, $iv_length + 64);

        $data = openssl_decrypt($first_encrypted, $method, $first_key, OPENSSL_RAW_DATA, $iv);
        $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

        if (hash_equals($second_encrypted, $second_encrypted_new))
            return $data;

        return false;
    }

    public function secured_encrypt_public(Request $request)
    {
        $requestFormated = $request->all();

        $first_key = $requestFormated['f'];
        $second_key = $requestFormated['s'];
        $mix = $requestFormated['c'];

        $first_key = env('FIRSTKEY');
        $second_key = env('SECONDKEY');

        $method = "aes-256-cbc";
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $first_encrypted = openssl_encrypt($mix, $method, $first_key, OPENSSL_RAW_DATA, $iv);
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

        $output = base64_encode($iv . $second_encrypted . $first_encrypted);
        return $output;
    }




    public function secured_encrypt($data)
    {
        $first_key = env('FIRSTKEY');
        $second_key = env('SECONDKEY');

        $method = "aes-256-cbc";
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $first_encrypted = openssl_encrypt($data, $method, $first_key, OPENSSL_RAW_DATA, $iv);
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

        $output = base64_encode($iv . $second_encrypted . $first_encrypted);
        return $output;
    }

    public function decryptEx($wallet)
    {
        try {
            $user = User::find(Auth::id());

            if (!isset($user)) {
                abort(404);
            }

            dd($this->secured_decrypt($wallet));

        } catch (\Throwable $th) {
            abort(404);
            throw $th;
        }
    }

    public function editActive(Request $request)
    {

        try {
            $user = User::find(Auth::id());

            $wallets = Wallet::where('user_id', $user->id)->where('coin', $request->coin)
                ->orderBy('id', 'DESC')->get();
            foreach ($wallets as $w) {
                $w->active = $w->active == 0 ? 1 : 0;
                $w->save();
            }

            \Alert::success("Wallets edited");
            return redirect()->route('wallets.index');
        } catch (\Throwable $th) {

            \Alert::error("Failed in edit wallets");
            return redirect()->route('wallets.index');
        }

    }

}
