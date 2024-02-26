<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;
use App\Models\NodeOrders;
use App\Models\OrderPackage;
use App\Models\PaymentLog;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WithdrawWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use stdClass;

class WalletController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        $wallets = Wallet::where('user_id', $user->id)->orderBy('id', 'DESC')->get()->groupBy('coin');

        $icons = [
            'BITCOIN' => 'https://cryptologos.cc/logos/bitcoin-btc-logo.png?v=029',
            'TRX' => 'https://cryptologos.cc/logos/tron-trx-logo.png?v=029',
            'ETH' => 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029',
            'USDT_TRC20' => 'https://images.ctfassets.net/77lc1lz6p68d/5Z7vveK1yJ7rDvX9K5ywJa/cfa5f74c313594a5a75652f98678578a/tether-usdt-trc20.svg',
            'USDT_ERC20' => 'https://cryptologos.cc/logos/tether-usdt-logo.png?v=029',
        ];

        $moviment = [];

        $decimals = [
            'BITCOIN' => 6,
            'TRX' => 2,
            'ETH' => 6,
            'USDT_TRC20' => 2,
            'USDT_ERC20' => 2,
        ];

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

            $moviment[$key] = [
                "dep" => number_format($dep, $decimals[$key], '.', ''),
                "saq" => number_format($saq, $decimals[$key], '.', '')
            ];
        }

        return view('wallets.list', compact('wallets', 'icons', 'moviment'));
    }

    public function store(Request $request)
    {
        try {
            //code...

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
                if ($retornoTxt) {
                    $wallet = new Wallet;
                    $wallet->user_id = Auth::id();
                    $wallet->wallet = $this->secured_encrypt($walletGen['address']);
                    $wallet->description = $this->secured_encrypt('wallet');
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

            return redirect()->route('wallets.index');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
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
        $requestFormated = $request->all();

        if (strpos($requestFormated['price_crypto'], ',') !== false) {
            $price_crypto = str_replace(",", "", $requestFormated['price_crypto']);
            return ($price_crypto);
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

            if (!Hash::check($requestFormated['password'], $userAprov->password)) {
                return "User Not Found";
            }

            $wallet = $this->returnWallet($requestFormated["coin"], $userAprov->id);

            if (!$wallet) {
                return false;
            }

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
                    $order->price = $requestFormated['price'];
                    $order->price_crypto = $price_crypto;
                    $order->wallet = $this->secured_decrypt($wallet->address);
                    $order->notify_url = $requestFormated['notify_url'];
                    $order->id_encript = $wallet->id;

                    // return json_encode($order);
                    $postNode = $controller->genUrlCrypto($requestFormated['coin'], $order);

                    return $postNode;
                }
            } else {
                try {
                    //code...
                    $log = new CustomLog;
                    $log->content = "WALLET NOT FOUND IN TXT - $wallet->address";
                    $log->user_id = $userAprov->user_id;
                    $log->operation = "VERIFICATION WALLET IN TXT, NOT FOUND";
                    $log->controller = "app/controller/WalletController";
                    $log->http_code = 200;
                    $log->route = "WALLET DANGER";
                    $log->status = "success";
                    $log->save();
                } catch (\Throwable $th) {
                    //throw $th;
                }

                $walletdel = Wallet::where('id', $wallet->id)->first();
                $walletdel->delete();

                return $this->notify($request);
            }

        }


        return response("OK", 200);
    }

    public function returnWallet($coin, $user_id)
    {
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
                ->where('coin', $coin)
                ->whereNotIn('id', $usedWallets)
                ->get();

            if ($unusedWallets->isNotEmpty()) {

                $selectedWallet = $unusedWallets->random();
                $wallet = $selectedWallet;
            } else {

                return false;
            }

        } else {
            $myWallets = Wallet::where('user_id', $user_id)->where('coin', $coin)->get();

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

        $wallet = WithdrawWallet::where('user_id', $user->id)->where('crypto', $request->coin)->first();

        if (isset($wallet)) {
            $wallet->wallet_address = $request->address;
            $wallet->save();
        } else {
            $nwallet = new WithdrawWallet;
            $nwallet->user_id = $user->id;
            $nwallet->wallet_address = $request->address;
            $nwallet->crypto = $request->coin;
            $nwallet->save();
        }

        return $this->WithdrawWallet();
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

}
