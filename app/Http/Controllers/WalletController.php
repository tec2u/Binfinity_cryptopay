<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;
use App\Models\IpAccessApi;
use App\Models\IpAllowedApi;
use App\Models\IpWhitelist;
use App\Models\NodeOrders;
use App\Models\OrderPackage;
use App\Models\PaymentLog;
use App\Models\SystemConf;
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
            // 'BITCOIN' => 'https://cryptologos.cc/logos/bitcoin-btc-logo.png?v=029',
            'TRX' => 'https://cryptologos.cc/logos/tron-trx-logo.png?v=029',
            // 'ETH' => 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029',
            'USDT_TRC20' => 'https://crypto.binfinitybank.com/public/images/tron-usdt.png',
            // 'USDT_ERC20' => 'https://cryptologos.cc/logos/tether-usdt-logo.png?v=029',
        ];

        $moviment = [];

        $decimals = [
            'BITCOIN' => 6,
            'TRX' => 2,
            'ETH' => 6,
            'USDT_TRC20' => 2,
            'USDT_ERC20' => 2,
        ];

        $api_key = 'ca699a34-d3c2-4efc-81e9-6544578433f8';

        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $api_key,
            'Content-Type' => 'application/json',
        ])->get('https://pro-api.coinmarketcap.com/v2/cryptocurrency/quotes/latest?symbol=btc,eth,trx,erc20,USDT');

        $data = $response->json();


        $btc = $data['data']['BTC'][0]['quote']['USD']['price'];
        $trc20 = 1;
        $erc20 = 1;
        $trx = $data['data']['TRX'][0]['quote']['USD']['price'];
        $eth = $data['data']['ETH'][0]['quote']['USD']['price'];

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

            while (count($wallets) < 10) {

                $walletGen = $controller->filterWallet($request->coin);

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
                    $nn = new WalletName;
                    $nn->id_user = Auth::id();
                    $nn->name = $request->name;
                    $nn->coin = $request->coin;
                    $nn->active = 1;
                    $nn->save();

                    $wallet = new Wallet;
                    $wallet->user_id = Auth::id();
                    $wallet->name = $nn->id ?? '';
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
            // dd($th->getMessage());
            \Alert::success("Failed");
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
        // dd($json);

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
        $validator = Validator::make($request->all(), [
            'id_order' => 'required|string|max:255',
            'price' => 'required',
            'price_crypto' => 'required',
            'login' => 'required|email',
            'password' => 'required|string|max:255',
            'coin' => 'required|string|max:255',
            'notify_url' => 'required|url'
        ]);

        $requestFormated = $request->all();

        if ($validator->fails()) {
            return false;
        }

        $ip = $request->ip();
        $ipRequest = new IpAccessApi;
        $ipRequest->ip = $ip;
        $ipRequest->operation = "api/web/get/wallet";
        $ipRequest->request = json_encode($requestFormated);
        $ipRequest->save();

        $system = SystemConf::first();
        if (isset($system)) {
            if ($system->all == 0 || $system->all == 1 && $system->api == 0) {
                return false;
            }
        }

        $ipAllowed = IpAllowedApi::where('ip', $ip)->first();
        if (!isset($ipAllowed)) {
            return false;
        }


        if (strpos($requestFormated['price_crypto'], ',') !== false) {
            $price_crypto = str_replace(",", "", $requestFormated['price_crypto']);
        }

        $price_ = $requestFormated['price'];
        if (strpos($requestFormated['price'], ',') !== false) {
            $price_ = str_replace(",", "", $requestFormated['price']);
        }

        // return ($request);

        // crypto
        if (isset($requestFormated["login"])) {

            $log = new PaymentLog;
            $log->content = "status";
            $log->order_package_id = $requestFormated['id_order'];
            $log->operation = "payment package";
            $log->controller = "packageController";
            $log->http_code = "200";
            $log->route = "/packages/packagepay/notify";
            $log->status = "success";
            $log->json = json_encode($request->all());
            $log->save();

            $userAprov = User::where('email', $requestFormated['login'])->orWhere('login', $requestFormated['login'])->first();

            if (!isset($userAprov)) {
                return false;
            }

            if (!Hash::check($requestFormated['password'], $userAprov->password)) {
                return "User Not Found";
            }

            if ($userAprov->activated == null || $userAprov->activated == 0) {
                return false;
            }

            if ($userAprov->id != $ipAllowed->user_id) {
                return false;
            }

            $wallet = $this->returnWallet($requestFormated["coin"], $userAprov->id);
            // return $wallet;
            if (!$wallet) {
                return false;
            }

            // return $wallet;

            $walletExists = $this->walletTxtWexists($userAprov->id, $this->secured_decrypt($wallet->address));
            if (isset($walletExists) && json_decode($walletExists)) {
                $jsonW = json_decode($walletExists);
                if (isset($jsonW->address)) {
                    $controller = new PackageController;

                    $price_crypto = $requestFormated['price_crypto'];

                    if (strpos($requestFormated['price_crypto'], ',') !== false) {
                        $price_crypto = str_replace(",", "", $requestFormated['price_crypto']);
                    }

                    $order = new stdClass();
                    $order->id = $requestFormated['id_order'];
                    $order->id_user = $userAprov->id;
                    $order->price = $price_;
                    $order->price_crypto = $price_crypto;
                    $order->wallet = $wallet->address;
                    $order->notify_url = $requestFormated['notify_url'];
                    $order->id_encript = $wallet->id;

                    // return json_encode($order);
                    $postNode = $controller->genUrlCrypto($requestFormated['coin'], $order);
                    // return $postNode;

                    return [
                        "id" => $postNode->id,
                        "merchant_id" => $postNode->merchant_id,
                        "wallet" => $this->secured_decrypt($postNode->wallet)
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
                            return $content;
                        }

                    } else {
                        $status = $response->status();
                        $content = $response->body();
                        return false;
                    }
                    return;


                } catch (\Throwable $th) {
                    // throw $th;
                }


            }
            return $this->notify($request);

        }


        return response("OK", 200);
    }

    public function returnWallet($coin, $user_id)
    {
        $system = SystemConf::first();
        if (isset($system)) {
            if ($system->all == 0 || $system->all == 1 && $system->node == 0) {
                return false;
            }
        }

        $tempoLimite = Carbon::now()->subSeconds(10);

        $lastNode = NodeOrders::where('coin', $coin)
            ->where('id_user', $user_id)
            ->where('createdAt', '>', $tempoLimite)
            ->orderBy('id', 'desc')
            ->first();


        if (isset($lastNode)) {
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

        $coins = ['USDT_TRC20', 'TRX', 'ETH', 'BITCOIN', 'USDT_ERC20'];

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
            return redirect()->route('wallets.WithdrawWallet');
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
