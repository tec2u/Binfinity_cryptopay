<?php

namespace App\Http\Controllers;

use App\Models\NodeOrders;
use App\Models\OrderPackage;
use App\Models\PaymentLog;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use stdClass;

class WalletController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        $wallets = Wallet::where('user_id', $user->id)->orderBy('id', 'DESC')->get();

        return view('wallets.list', compact('wallets'));
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::id());

        $wallets = Wallet::where('user_id', $user->id)->where('coin', $request->coin)->get();

        if (count($wallets) >= 10) {
            return $this->index();
        }

        while (count($wallets) <= 10) {
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
    }

    public function notify(Request $request)
    {
        $requestFormated = $request->all();

        // crypto
        if (isset($requestFormated["login"])) {


            $log = new PaymentLog;
            $log->content = "status";
            $log->order_package_id = 1;
            $log->operation = "payment package";
            $log->controller = "packageController";
            $log->http_code = "200";
            $log->route = "/packages/packagepay/notify";
            $log->status = "success";
            $log->json = json_encode($request->all());
            $log->save();

            $userAprov = User::where('email', $requestFormated['login'])->orWhere('login', $requestFormated['login'])->first();

            if (!Hash::check($requestFormated['password'], $userAprov->password)) {
                return false;
            }

            // return $requestFormated;

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
                return false;
            }

            // return $wallet;

            $controller = new PackageController;

            $order = new stdClass();
            $order->id = $requestFormated['id_order'];
            $order->id_user = $userAprov->id;
            $order->price_crypto = $requestFormated['price_crypto'];
            $order->wallet = $wallet->address;
            $order->notify_url = $requestFormated['notify_url'];

            $postNode = $controller->genUrlCrypto('USDT_TRC20', $order);

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
}
