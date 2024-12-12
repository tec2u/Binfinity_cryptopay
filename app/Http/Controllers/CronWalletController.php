<?php

namespace App\Http\Controllers;

use App\Models\CustomLog;
use App\Models\PriceCoin;
use App\Models\User;
use App\Models\Wallet;
use Http;
use Illuminate\Http\Request;

class CronWalletController extends Controller
{
    public function index()
    {

        try {
            $api_key = 'ca699a34-d3c2-4efc-81e9-6544578433f8';

            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $api_key,
                'Content-Type' => 'application/json',
            ])->get('https://pro-api.coinmarketcap.com/v2/cryptocurrency/quotes/latest?symbol=btc,eth,trx,erc20,USDT,SOL,BNB');

            $data = $response->json();
            // dd($data);
            $btc = $data['data']['BTC'][0]['quote']['USD']['price'];
            $trc20 = 1;
            $erc20 = 1;
            $trx = $data['data']['TRX'][0]['quote']['USD']['price'];
            $eth = $data['data']['ETH'][0]['quote']['USD']['price'];
            $sol = $data['data']['SOL'][0]['quote']['USD']['price'];
            $bnb = $data['data']['BNB'][0]['quote']['USD']['price'];

            $coins = [
                "BTC" => $btc,
                "TRC20" => $trc20,
                "ERC20" => $erc20,
                "TRX" => $trx,
                "ETH" => $eth,
                "SOL" => $sol,
                "BNB" => $bnb,
            ];

            foreach ($coins as $coin => $value) {
                $coinSave = PriceCoin::where('name', $coin)->first();
                if (isset($coinSave)) {
                    $coinSave->one_in_usd = $value;
                    $coinSave->save();
                } else {
                    $coinSave = new PriceCoin;
                    $coinSave->name = $coin;
                    $coinSave->one_in_usd = $value;
                    $coinSave->save();
                }
            }
        } catch (\Throwable $th) {

        }
    }

}
