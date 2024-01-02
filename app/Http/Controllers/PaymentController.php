<?php

namespace App\Http\Controllers;

use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\CustomLogTrait;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\ClubSwanController;

class PaymentController extends Controller
{
    use CustomLogTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /* public function index($package, $value)
     {
         $package = Package::find($package);
         $price = ($value < $package->price) ? $package->price : $value;
         $name = substr(str_replace(' ', '', $package->name), 0, 15);
         //$wallet = Wallet::where('user_id',auth()->user()->id)->first();
         // if(empty($wallet)){
         //     flash("Please register your wallet to complete the order")->warning();
         //     return redirect()->route('packages.detail', ['id' => $package->id]);
         // }
         try {
             $paymentConfig = [
                 "api_url" => "https://coinremitter.com/api/v3/USDTTRC20/create-invoice",
                 "api_key" => '',
                 "password" => "",
                 "currency" => "USD",
                 "expire_time" => "30"
             ];
            
             $codepayment = '0'; //$raw->data->id;
             $invoiceid = '0'; //$raw->data->invoice_id;
             $wallet_OP = '0'; //$raw->data->address;
             $this->createOrder($package, $codepayment, $invoiceid, $wallet_OP, '0');
             $coin = '0'; //$raw->data->coin;
             $paymentInfo = [
                 "coin" => '0', //$raw->data->coin,
                 "value" => '0', //strval($raw->data->total_amount->$coin),
                 "USD" => '0', //strval($raw->data->total_amount->USD),
                 "address" => '0', //$raw->data->address
             ];
             return view('payment', compact('paymentInfo'));
         } catch (Exception $e) {
             $this->errorCatch($e->getMessage(), auth()->user()->id);
             flash(__('backoffice_alert.unable_to_process_your_order'))->error();
             return redirect()->route('packages.detail', ['id' => $package->id]);
         }
     }
     public function indexUSDTERC($package, $value)
     {
         $package = Package::find($package);
         $price = ($value < $package->price) ? $package->price : $value;
         $name = substr(str_replace(' ', '', $package->name), 0, 15);
         //$wallet = Wallet::where('user_id',auth()->user()->id)->first();
         // if(empty($wallet)){
         //     flash("Please register your wallet to complete the order")->warning();
         //     return redirect()->route('packages.detail', ['id' => $package->id]);
         // }
         try {
             $paymentConfig = [
                 "api_url" => "https://coinremitter.com/api/v3/USDTERC20/create-invoice",
                 "api_key" => '',
                 "password" => "",
                 "currency" => "USD",
                 "expire_time" => "30"
             ];
            
             $codepayment = '0'; //$raw->data->id;
             $invoiceid = '0'; //$raw->data->invoice_id;
             $wallet_OP = '0'; //$raw->data->address;
             $this->createOrder($package, $codepayment, $invoiceid, $wallet_OP, '0');
             $coin = '0'; //$raw->data->coin;
             $paymentInfo = [
                 "coin" => '0', //$raw->data->coin,
                 "value" => '0', //strval($raw->data->total_amount->$coin),
                 "USD" => '0', //strval($raw->data->total_amount->USD),
                 "address" => '0', //$raw->data->address
             ];
             return view('payment', compact('paymentInfo'));
         } catch (Exception $e) {
             $this->errorCatch($e->getMessage(), auth()->user()->id);
             flash(__('backoffice_alert.unable_to_process_your_order'))->error();
             return redirect()->route('packages.detail', ['id' => $package->id]);
         }
     }
     public function indexBTC($package, $value)
     {
         $package = Package::find($package);
         $price = ($value < $package->price) ? $package->price : $value;
         $name = substr(str_replace(' ', '', $package->name), 0, 15);
         //$wallet = Wallet::where('user_id',auth()->user()->id)->first();
         // if(empty($wallet)){
         //     flash("Please register your wallet to complete the order")->warning();
         //     return redirect()->route('packages.detail', ['id' => $package->id]);
         // }
         try {
             $paymentConfig = [
                 "api_url" => "https://coinremitter.com/api/v3/BTC/create-invoice",
                 "api_key" => '',
                 "password" => "",
                 "currency" => "USD",
                 "expire_time" => "30"
             ];
            
             $codepayment = '0'; //$raw->data->id;
             $invoiceid = '0'; //$raw->data->invoice_id;
             $wallet_OP = '0'; //$raw->data->address;
             $this->createOrder($package, $codepayment, $invoiceid, $wallet_OP, '0');
             $coin = '0'; //$raw->data->coin;
             $paymentInfo = [
                 "coin" => '0', //$raw->data->coin,
                 "value" => '0', //strval($raw->data->total_amount->$coin),
                 "USD" => '0', //strval($raw->data->total_amount->USD),
                 "address" => '0', //$raw->data->address
             ];
             return view('payment', compact('paymentInfo'));
         } catch (Exception $e) {
             $this->errorCatch($e->getMessage(), auth()->user()->id);
             flash(__('backoffice_alert.unable_to_process_your_order'))->error();
             return redirect()->route('packages.detail', ['id' => $package->id]);
         }
     }
     public function indexPost(Request $request)
     {
         $paymentConfig = [
             "api_url" => "https://coinremitter.com/api/v3/BTC/create-invoice",
             "api_key" => '',
             "password" => ""
         ];
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
             CURLOPT_POSTFIELDS => '{
                 "api_key": "' . $paymentConfig['api_key'] . '",
                 "password": "' . $paymentConfig['password'] . '",
                 "amount": "' . $request->value . '",
                 "name": "' . $request->package . '",
                 "currency": "' . $request->currency . '",
                 "expire_time": "' . $request->expire_time . '"
             }',
             CURLOPT_HTTPHEADER => array(
                 'Content-Type: application/json'
             ),
         ));
         $raw = json_decode(curl_exec($curl));
         curl_close($curl);
         $paymentInfo = [
             "USD" => '0', //strval($raw->data->total_amount->USD),
             "BTC" => '0', //strval($raw->data->total_amount->BTC),
             "EUR" => '0', //strval($raw->data->total_amount->EUR),
             "address" => '0', //$raw->data->address
         ];
         return view('payment', compact('paymentInfo'));
     }*/
    public function subscriptionClub($package)
    {

        $package = Package::find($package);
        $price = $package->price;
        $name = substr(str_replace(' ', '', $package->name), 0, 15);
        $user = User::find(auth()->user()->id);


        $this->createOrder($package, '0', '0', '0', '0');

        flash(__('ORDER CREATED SUCCESFULLY'))->success();
        return redirect()->route('packages.packagelog', ['id' => $package->id]);


    }
    public function createOrder($package, $payment, $invoiceid, $wallet, $subId)
    {
        $user = User::find(auth()->user()->id);
        $user->orderPackage()->create([
            "reference" => $package->name,
            "payment_status" => 0,
            "transaction_code" => $payment,
            "package_id" => $package->id,
            "price" => $package->price,
            "amount" => 1,
            "transaction_wallet" => $invoiceid,
            "wallet" => $wallet,
            "server" => ''

        ]);
    }
}
