<?php

namespace App\Http\Controllers;

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

            $WithDrawal = WithdrawWallet::where('user_id', $user->id)->where('crypto', $request->coin)->first();

            if (!isset($WithDrawal)) {
                \Alert::error("Add your wallet in > WithDrawal Wallet (" . $request->coin . ")");
                return redirect()->back();
            }


            $wallets = Wallet::where('user_id', $user->id)->where('coin', $request->coin)->get();

            if (count($wallets) == 10) {
                return $this->index();
            }

            while (count($wallets) < 10) {
                $controller = new PackageController;

                $walletGen = $controller->filterWallet($request->coin);

                $wallet = new Wallet;
                $wallet->user_id = Auth::id();
                $wallet->wallet = $walletGen['address'];
                $wallet->description = 'wallet';
                $wallet->address = $walletGen['address'];
                $wallet->key = $walletGen['privateKey'];
                $wallet->mnemonic = $walletGen['mnemonic'];
                $wallet->coin = $request->coin;
                $wallet->save();

                $wallets = Wallet::where('user_id', $user->id)->where('coin', $request->coin)->get();
            }

            return $this->index();
        } catch (\Throwable $th) {
            return $this->index();
            //throw $th;
        }
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

            $orders9 = NodeOrders::where('coin', $requestFormated['coin'])
                ->where('id_user', $userAprov->id)
                ->orderBy('id', 'desc')
                ->limit(9)
                ->get();

            if (count($orders9) > 0) {



                $usedWallets = $orders9->pluck('wallet')->toArray();

                $unusedWallets = Wallet::where('user_id', $userAprov->id)
                    ->where('coin', $requestFormated['coin'])
                    ->whereNotIn('address', $usedWallets)
                    ->get();


                if ($unusedWallets->isNotEmpty()) {

                    $selectedWallet = $unusedWallets->random();
                    $wallet = $selectedWallet;
                } else {

                    return "Wallet Not found";
                }

            } else {
                $myWallets = Wallet::where('user_id', $userAprov->id)->where('coin', $requestFormated['coin'])->get();

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
                    return "Wallet Not found";
                }
            }


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
            $order->wallet = $wallet->address;
            $order->notify_url = $requestFormated['notify_url'];

            $postNode = $controller->genUrlCrypto($requestFormated['coin'], $order);

            return $postNode;


        }


        return response("OK", 200);
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
}
