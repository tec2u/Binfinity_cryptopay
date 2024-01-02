<?php

namespace App\Traits;

use App\Models\PaymentLog;
use Illuminate\Support\Facades\Route;

trait PaymentLogTrait
{
    protected function errorPaymentCatch($message, $order_package = ""){ ///Função que gera os logs de erros vindos do catch

        $this->createPaymentLog($message, 500, 'error', $order_package);

    }

    protected function getRouteActionpayment(){

        $RouteAction = explode("App\Http\Controllers\\",Route::currentRouteAction());
        $explodeAction = explode("@",$RouteAction[1]);

        return $explodeAction;
    }

    protected function createPaymentLog($message, $http_code, $status, $order_package = "", $json = ""){

        $explodeAction = $this->getRouteActionpayment();
        $controller = $explodeAction[0];
        $operation = $explodeAction[1];

        $infoLog = [
            'content'           => $message,
            'order_package_id'  => $order_package ,
            'operation'         => $operation,
            'controller'        => $controller,
            'http_code'         => $http_code,
            'route'             => Route::currentRouteName(),
            'status'            => $status,
            'json'              => $json
        ];
        PaymentLog::create($infoLog);
    }
}
