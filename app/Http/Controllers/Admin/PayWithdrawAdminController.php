<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\CustomLogTrait;
use App\Traits\OrderBonusTrait;
use App\Traits\PaymentLogTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayWithdrawAdminController extends Controller
{
    use CustomLogTrait, PaymentLogTrait, OrderBonusTrait;

    public function indexCC($id)
    {
        $withdraw = DB::table('withdraw_requests')
            ->join('wallets', 'withdraw_requests.user_id', '=', 'wallets.user_id')
            ->select('withdraw_requests.value', 'wallets.wallet')
            ->where('withdraw_requests.id', '=', $id)
            ->first();

        $token_CC = DB::table('token_value')
            ->select('value_usd')
            ->where('name', '=', 'CC')
            ->first();

        $amount = $token_CC->value_usd * $withdraw->value;

        $paymentConfig = [
            "api_url" => "https://api.coinbase.com/v2/accounts/{{substituir_pelo_id_da_conta_quando_a_API_for_liberada}}/transactions",
            "api_key" => 'wLs12kYdfad9cREf',
            "api_secret" => 'g2MEq1RakU4mJ4LCPRZRyUY6GSqnNeqA ',
            "timestamp" => time(),
            "method" => "POST",
            "requestPath" => "/v2/accounts/{{substituir_pelo_id_da_conta_quando_a_API_for_liberada}}/transactions"
        ];

        $requestBody = '{
            "type": "send",
            "to": "' . $withdraw->wallet . '",
            "amount": "' . str_replace(',', '.', $amount) . '",
            "currency": "USDT",
            "idem": "' . $id . '"
        }';

        $sig = hash_hmac('sha256', $paymentConfig["timestamp"] . $paymentConfig["method"] . $paymentConfig["requestPath"] . $requestBody, $paymentConfig["api_secret"]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $paymentConfig['api_url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $requestBody,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'CB-ACCESS-SIGN: ' . $sig,
                'CB-ACCESS-TIMESTAMP: ' . $paymentConfig["timestamp"],
                'CB-ACCESS-KEY: ' . $paymentConfig["api_key"],
            ),
        ));

        $raw = json_decode(curl_exec($curl));

        curl_close($curl);

        if (isset($raw->errors)) {
            $list_errors = "";
            foreach ($raw->errors as $error) {
                $list_errors .= " (ID: " . $error->id . " Message: " . $error->message . ")";
            }
            flash(__("admin_alert.paymenterror " . $list_errors))->error();
        } else {
            if ($raw->data->status == "pending") {
                $this->createLog('Update Request: ID ' . $withdraw->id . ' - STATUS ' . $raw->data->status . ' - PROCESSING USER ' . auth()->user()->id, 201, 'success', auth()->user()->id);
                DB::table('withdraw_requests')->where("id", $id)->update(['status' => 1, 'processing_user' => auth()->user()->id, 'payment_code' => $raw->data->resource_path, 'date_payment' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
                flash(__("admin_alert.transactioncreate"))->success();
            } else if ($raw->data->status == "completed") {
                $this->createLog('Update Request: ID ' . $withdraw->id . ' - STATUS ' . $raw->data->status . ' - PROCESSING USER ' . auth()->user()->id, 201, 'success', auth()->user()->id);
                DB::table('withdraw_requests')->where("id", $id)->update(['status' => 2, 'processing_user' => auth()->user()->id, 'payment_code' => $raw->data->resource_path, 'date_payment' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
                flash(__("admin_alert.paymentsucess"))->success();
            }
        }

        return redirect()->route('admin.withdraw.withdrawRequests');
    }

    public function index($id)
    {
        $withdraw = DB::table('withdraw_requests')
            ->join('wallets', 'withdraw_requests.user_id', '=', 'wallets.user_id')
            ->select('withdraw_requests.value', 'wallets.wallet')
            ->where('withdraw_requests.id', '=', $id)
            ->first();

        $amount = $withdraw->value;

        $paymentConfig = [
            "api_url" => "https://api.coinbase.com/v2/accounts/{{substituir_pelo_id_da_conta_quando_a_API_for_liberada}}/transactions",
            "api_key" => 'wLs12kYdfad9cREf',
            "api_secret" => 'g2MEq1RakU4mJ4LCPRZRyUY6GSqnNeqA ',
            "timestamp" => time(),
            "method" => "POST",
            "requestPath" => "/v2/accounts/{{substituir_pelo_id_da_conta_quando_a_API_for_liberada}}/transactions"
        ];

        $requestBody = '{
            "type": "send",
            "to": "' . $withdraw->wallet . '",
            "amount": "' . str_replace(',', '.', $amount) . '",
            "currency": "USDT",
            "idem": "' . $id . '"
        }';

        $sig = hash_hmac('sha256', $paymentConfig["timestamp"] . $paymentConfig["method"] . $paymentConfig["requestPath"] . $requestBody, $paymentConfig["api_secret"]);
        // $sig = hash_hmac('sha256', $paymentConfig["timestamp"] . 'GET' . '/v2/accounts', $paymentConfig["api_secret"]);
        // die(var_dump($paymentConfig).$sig);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $paymentConfig['api_url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $requestBody,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'CB-ACCESS-SIGN: ' . $sig,
                'CB-ACCESS-TIMESTAMP: ' . $paymentConfig["timestamp"],
                'CB-ACCESS-KEY: ' . $paymentConfig["api_key"],
            ),
        ));

        $raw = json_decode(curl_exec($curl));

        curl_close($curl);

        if (isset($raw->errors)) {
            $list_errors = "";
            foreach ($raw->errors as $error) {
                $list_errors .= " (ID: " . $error->id . " Message: " . $error->message . ")";
            }
            flash(__("admin_alert.paymenterror " . $list_errors))->error();
        } else {
            if ($raw->data->status == "pending") {
                $this->createLog('Update Request: ID ' . $withdraw->id . ' - STATUS ' . $raw->data->status . ' - PROCESSING USER ' . auth()->user()->id, 201, 'success', auth()->user()->id);
                DB::table('withdraw_requests')->where("id", $id)->update(['status' => 1, 'processing_user' => auth()->user()->id, 'payment_code' => $raw->data->resource_path, 'date_payment' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
                flash(__("admin_alert.transactioncreate"))->success();
            } else if ($raw->data->status == "completed") {
                $this->createLog('Update Request: ID ' . $withdraw->id . ' - STATUS ' . $raw->data->status . ' - PROCESSING USER ' . auth()->user()->id, 201, 'success', auth()->user()->id);
                DB::table('withdraw_requests')->where("id", $id)->update(['status' => 2, 'processing_user' => auth()->user()->id, 'payment_code' => $raw->data->resource_path, 'date_payment' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
                flash(__("admin_alert.paymentsucess"))->success();
            }
        }

        return redirect()->route('admin.withdraw.withdrawRequests');
    }

    static public function update()
    {
        DB::table('custom_log')->insert(
            [
                'content'   => 'Start Update Crawler',
                'user_id'   => '0',
                'operation' => 'Update Withdraw Request',
                'controller' => 'PayWithdrawAdminController',
                'http_code' => '201',
                'route'     => 'N',
                'status'    => 'success',
            ]
        );
        $withdraws = DB::table('withdraw_requests')
            ->select('withdraw_requests.payment_code', 'withdraw_requests.id')
            ->where('withdraw_requests.payment_code', '<>', '')
            ->where('withdraw_requests.status', '=', '1')
            ->get();

        foreach ($withdraws as $withdraw) {

            $paymentConfig = [
                "api_url" => "https://api.coinbase.com" . $withdraw->payment_code,
                "api_key" => 'wLs12kYdfad9cREf',
                "api_secret" => 'g2MEq1RakU4mJ4LCPRZRyUY6GSqnNeqA ',
                "timestamp" => time(),
                "method" => "GET",
                "requestPath" => $withdraw->payment_code
            ];

            $sig = hash_hmac('sha256', $paymentConfig["timestamp"] . $paymentConfig["method"] . $paymentConfig["requestPath"], $paymentConfig["api_secret"]);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $paymentConfig['api_url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'CB-ACCESS-SIGN: ' . $sig,
                    'CB-ACCESS-TIMESTAMP: ' . $paymentConfig["timestamp"],
                    'CB-ACCESS-KEY: ' . $paymentConfig["api_key"],
                ),
            ));

            $raw = json_decode(curl_exec($curl));

            curl_close($curl);

            if (isset($raw->data)) {
                if ($raw->data->status == "completed") {
                    DB::table('custom_log')->insert(
                        [
                            'content'   => 'Update Withdraw Request: ID ' . $withdraw->id . ' - STATUS ' . $raw->data->status,
                            'user_id'   => '0',
                            'operation' => 'Update Withdraw Request',
                            'controller' => 'PayWithdrawAdminController',
                            'http_code' => '201',
                            'route'     => 'N',
                            'status'    => 'success',
                        ]
                    );
                    DB::table('withdraw_requests')->where("id", $withdraw->id)->update(['status' => 2, 'updated_at' => date("Y-m-d H:i:s"), 'message' => 'Updated by Coinbase API']);
                }
            }
        }

        DB::table('custom_log')->insert(
            [
                'content'   => 'Stop Update Crawler',
                'user_id'   => '0',
                'operation' => 'Update Withdraw Request',
                'controller' => 'PayWithdrawAdminController',
                'http_code' => '201',
                'route'     => 'N',
                'status'    => 'success',
            ]
        );
    }
}
