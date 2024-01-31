<?php

namespace App\Http\Controllers;

use App\Models\OrderPackage;
use App\Models\Wallet;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CronPagamento extends Controller
{
    private $host = '127.0.0.1:3000';
    public function index()
    {
        try {
            //code...

            $orders = OrderPackage::where('payment_status', '0')->where('price_crypto', '<>', null)->get();
            foreach ($orders as $order) {

                $wallet = Wallet::where('id', $order->wallet)->first();
                // dd($wallet);
                if (isset($wallet)) {
                    // $this->ethereum($order, $wallet);
                    // die();
                    if (isset($order->hash)) {
                        if ($wallet->coin == 'BITCOIN') {
                            $this->hashBtc($order, $wallet);
                        } else if ($wallet->coin == 'USDT_TRC20' || $wallet->coin == 'TRX') {
                            // dd('oi');
                            $this->hashTrx($order, $wallet);
                        }
                    } else {
                        if ($wallet->coin == 'BITCOIN') {
                            // dd('oi');
                            $this->btc($order, $wallet);
                        } else if ($wallet->coin == 'USDT_TRC20') {
                            $this->trc20($order, $wallet);
                        } else if ($wallet->coin == 'TRX') {
                            $this->trx($order, $wallet);

                        } else if ($wallet->coin == 'ETH' || $wallet->coin == 'USDT_ERC20') {
                            $this->ethereum($order, $wallet);
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            // dd($th);
        }
    }

    public function ethereum($order, $wallet)
    {
        $client = new Client();

        $response = $client->request('GET', "$this->host/api/query/wallet/ethereum/balance/$wallet->address", [
            // $response = $client->request('GET', "$this->host/api/query/wallet/ethereum/balance/0x3EAAC143280052435078a3F5a17F88B61279CF9B", [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());
        // dd($result);
        if (isset($result->result)) {
            foreach ($result->result as $item) {
                $timestamp = $item->timeStamp;
                $data = Carbon::createFromTimestamp($timestamp);

                $updated_at = Carbon::parse($order->updated_at);
                $diffInHours = $data->diffInHours($updated_at);

                if ($diffInHours <= 1) {
                    if ($item->to == strtolower($wallet->address)) {
                        $unidadesEm1ETH = 1000000000000000000;
                        $valorEmETH = $item->value / $unidadesEm1ETH;

                        if ($valorEmETH == $order->price_crypto) {
                            $order->payment_status = 1;
                            $order->status = 1;
                            $order->hash = $item->hash;
                            $order->save();
                        }
                    }
                }
            }
        }
    }

    public function trx($order, $wallet)
    {
        $client = new Client();

        $response = $client->request('GET', "$this->host/api/query/wallet/tron/balance/$wallet->address", [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());


        if (isset($result->data)) {
            foreach ($result->data->data as $tx) {
                if ($tx->ret[0]->contractRet == "SUCCESS") {
                    if ($tx->raw_data->contract[0]->type == 'TriggerSmartContract') {

                    } else {
                        // TRX
                        $adresssHex = $tx->raw_data->contract[0]->parameter->value->to_address;

                        $response2 = $client->request('GET', "$this->host/api/transform/from/hex/wallet/tron/$adresssHex", [
                            'headers' => [
                                'Accept' => 'application/json',
                            ],
                        ]);

                        $result2 = json_decode($response2->getBody()->getContents());

                        $adressBase58 = $result2;
                        // dd($adressBase58);

                        $timestamp = $tx->raw_data->timestamp;
                        $data = Carbon::createFromTimestamp($timestamp);

                        $updated_at = Carbon::parse($order->updated_at);
                        $diffInHours = $data->diffInHours($updated_at);

                        if ($diffInHours <= 1) {

                            $sun = $order->price_crypto * 1000000;

                            if ($adressBase58 == $wallet->address) {
                                // dd($tx);
                                if ($sun == $tx->raw_data->contract[0]->parameter->value->amount) {
                                    $order->payment_status = 1;
                                    $order->status = 1;
                                    $order->hash = $tx->txID;
                                    $order->save();
                                }
                            }
                        }
                    }
                }
            }
        }

    }

    public function trc20($order, $wallet)
    {
        $client = new Client();

        $response = $client->request('GET', "$this->host/api/query/wallet/trc20/balance/$wallet->address", [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());


        if (isset($result->data)) {
            foreach ($result->data->data as $tx) {
                if (isset($tx->transaction_id)) {

                    $timestamp = $tx->block_timestamp;
                    $data = Carbon::createFromTimestamp($timestamp);

                    $updated_at = Carbon::parse($order->updated_at);
                    $diffInHours = $data->diffInHours($updated_at);

                    if ($diffInHours <= 1) {

                        $sun = $order->price_crypto * (10 ** $tx->token_info->decimals);

                        if ($tx->to == $wallet->address) {
                            // dd($tx);
                            if ($sun == $tx->value) {
                                $order->payment_status = 1;
                                $order->status = 1;
                                $order->hash = $tx->transaction_id;
                                $order->save();
                            }
                        }
                    }

                }
            }
        }
    }

    public function btc($order, $wallet)
    {
        $client = new Client();

        $response = $client->request('GET', "$this->host/api/query/wallet/btc/balance/$wallet->address", [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());

        if (isset($result->txs)) {
            foreach ($result->txs as $tx) {
                // dd($tx);
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

    public function hashBtc($order, $wallet)
    {
        $client = new Client();

        $response = $client->request('GET', "$this->host/api/query/wallet/btc/hash/$order->hash", [
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
    }

    public function hashTrx($order, $wallet)
    {
        $client = new Client();
        $response = $client->request('GET', "$this->host/api/query/wallet/tron/hash/$order->hash", [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());


        // dd($result->raw_data->contract[0]->parameter->value);

        if (isset($result->txID)) {

            $adresssHex = $result->raw_data->contract[0]->parameter->value->to_address;

            $response2 = $client->request('GET', "$this->host/api/transform/from/hex/wallet/tron/$adresssHex", [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            $result2 = json_decode($response2->getBody()->getContents());

            $adressBase58 = $result2;

            if ($result->txID == $order->hash) {
                $timestamp = $result->raw_data->timestamp;
                $data = Carbon::createFromTimestamp($timestamp);

                $updated_at = Carbon::parse($order->updated_at);
                $diffInHours = $data->diffInHours($updated_at);

                if ($diffInHours <= 1) {
                    $sun = $order->price_crypto * 1000000;

                    if ($adressBase58 == $wallet->address) {
                        if ($sun == $result->raw_data->contract[0]->parameter->value->amount) {
                            $order->payment_status = 1;
                            $order->status = 1;
                            $order->save();
                        }
                    }

                } else {
                    // dd('oi');
                }
            }
        }
    }
}
