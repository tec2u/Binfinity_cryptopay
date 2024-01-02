<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderPackage;
use App\Traits\OrderBonusTrait;
use App\Traits\PaymentLogTrait;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use PaymentLogTrait,OrderBonusTrait;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notity(Request $request)
    {
        $content = $request->getContent();
        $dados =  json_decode(json_encode($request->all()), false);

        if(!empty($dados)){
            $codepayment = $dados->merchant_id;
            $status = $dados->status_code;

            $id = "";

            $order = OrderPackage::where('transaction_code',$codepayment)->first();

            try {

                if(!empty($order)){
                $data = [
                        "status" => $status == 1 ? 1 : 0,
                        "payment_status" => $status
                    ];
                    $id = $order->id;
                    $order->update($data); 

                    if($status == 1){
                        $this->bonus_compra(0,$order->user_id,$order->price,$order->id);
                        $this->createPaymentLog('Payment processed successfully', 200, 'success',  $id, $content);
                    }
                }
                
                
            } catch (Exception $e) {

                $this->errorPaymentCatch($e->getMessage(), $id);

            }  
        }
        
        
    }
}
