<?php

namespace App\Http\Controllers;

use App\Models\OrderPackage;
use App\Models\Wallet;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CronPagamento extends Controller
{
    public function index()
    {
        try {
            //code...

            $orders = OrderPackage::where('payment_status', '0')->where('price_crypto', '<>', null)->get();

            foreach ($orders as $order) {

                $wallet = Wallet::where('id', $order->wallet)->first();
                if (isset($wallet)) {
                    # code...
                    if (isset($order->hash)) {
                        $client = new Client();

                        $response = $client->request('GET', "https://wallet-4lev.onrender.com/api/query/wallet/btc/hash/$order->hash", [
                            'headers' => [
                                'Accept' => 'application/json',
                            ],
                        ]);

                        $result = json_decode($response->getBody()->getContents());

                        if (isset($result->hash)) {
                            if ($result->hash == $order->hash) {
                                $timestamp = $result->time;
                                $data = Carbon::createFromTimestamp($timestamp);

                                $updated_at = Carbon::parse($order->updated_at);
                                $diffInHours = $data->diffInHours($updated_at);

                                if ($diffInHours <= 1) {
                                    $satoshis = $order->price_crypto * 100000000;

                                    if ($result->out[0]->addr == $wallet->address) {
                                        if ($satoshis == $result->out[0]->value) {
                                            $order->payment_status = 1;
                                            $order->status = 1;
                                            $order->save();
                                        }
                                    }

                                }
                            }
                        }
                        // dd($result);
                    }

                    $client = new Client();

                    $response = $client->request('GET', "https://wallet-4lev.onrender.com/api/query/wallet/btc/balance/$wallet->address", [
                        'headers' => [
                            'Accept' => 'application/json',
                        ],
                    ]);

                    $result = json_decode($response->getBody()->getContents());

                    if (isset($result->txs)) {
                        foreach ($result->txs as $tx) {
                            $timestamp = $tx->time;
                            $data = Carbon::createFromTimestamp($timestamp);

                            $updated_at = Carbon::parse($order->updated_at);
                            $diffInHours = $data->diffInHours($updated_at);

                            if ($diffInHours <= 1) {
                                $satoshis = $order->price_crypto * 100000000;

                                if ($tx->out[0]->addr == $wallet->address) {
                                    if ($satoshis == $tx->out[0]->value) {
                                        $order->payment_status = 1;
                                        $order->status = 1;
                                        $order->hash = $tx->hash;
                                        $order->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
