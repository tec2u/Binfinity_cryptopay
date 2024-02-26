<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class CronWalletController extends Controller
{
    public function index()
    {
        $log = new CustomLog;
        $log->content = "rodou cron";
        $log->user_id = 1;
        $log->operation = "CRON";
        $log->controller = "app/controller/WalletController";
        $log->http_code = 200;
        $log->route = "cron";
        $log->status = "success";
        $log->save();


        $wallets = Wallet::all();

        foreach ($wallets as $wallet) {
            $user = User::where('id', $wallet->user_id)->first();
            $this->verifica($wallet, $user);
        }

    }

    public function verifica($wallet, $userAprov)
    {
        $Walletcontroller = new WalletController;

        try {
            $walletExists = $Walletcontroller->walletTxtWexists($userAprov->id, $Walletcontroller->secured_decrypt($wallet->address));
            if (isset($walletExists) && json_decode($walletExists)) {
                $jsonW = json_decode($walletExists);
                if (isset($jsonW->address)) {
                    return true;
                }
            } else {
                $walletdel = Wallet::where('id', $wallet->id)->first();
                $walletdel->delete();

                $log = new CustomLog;
                $log->content = "WALLET NOT FOUND IN TXT - $wallet->address";
                $log->user_id = $userAprov->id;
                $log->operation = "VERIFICATION WALLET IN TXT, NOT FOUND";
                $log->controller = "app/controller/WalletController";
                $log->http_code = 200;
                $log->route = "WALLET DANGER";
                $log->status = "success";
                $log->save();
            }

        } catch (\Throwable $th) {
            $log = new CustomLog;
            $log->content = "Erro cron";
            $log->user_id = 1;
            $log->operation = "erro cron";
            $log->controller = "app/controller/WalletController";
            $log->http_code = 200;
            $log->route = "erro cron";
            $log->status = "success";
            $log->save();
        }
    }


}
