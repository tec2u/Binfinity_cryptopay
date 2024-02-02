<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
