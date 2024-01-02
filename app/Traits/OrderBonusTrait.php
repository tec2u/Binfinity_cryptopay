<?php

namespace App\Traits;

use App\Models\Banco;
use App\Models\ConfigBonusunilevel;
use App\Models\HistoricScore;
use App\Models\OrderPackage;
use App\Models\User;
use Illuminate\Support\Facades\Route;

trait OrderBonusTrait
{
    function bonusDiretoIndireto_e_Volume($user_id, $price, $order_package_id, $array_unilevel, $array_unilevel_peoples)
    {
        $sair = 1;
        $count = 1;
        $package = OrderPackage::find($order_package_id);
        while ($sair == 1) {
            $user = User::where('id', $user_id)->where('activated', 1)->orderBy('id', 'ASC')->first();
            //dd($user);
            //$result = User::where('id', $user->recommendation_user_id)->get();
            //echo "select * from users where id='".$fato_gerador."' order by id asc limit 1";


            if ($user != null && $user->recommendation_user_id >= 0 && !empty($user->recommendation_user_id)) {
                $result = User::where('id', $user->recommendation_user_id)->first();

                $ativadorcard = OrderPackage::where('status', 1)->where('payment_status', 1)->where('user_id', $result->id)->where('price', 39.90)->orWhere('price', 10.00)->count();
                $valor = 0;
                ####SE A ARRAY COM A CHAVE SENDO O COUNT TIVER VALOR COLOCA O VALOR DIVIDIDO POR 100 PARA GERAR A PORCENTAGEM

                if ($array_unilevel[$count] != "") {
                    if ($array_unilevel_peoples[$count] != "") {
                        if ($result->getDirectsActiveted($result->id) >= $array_unilevel_peoples[$count]) {
                            if ($count == 1) {
                                switch ($result->getDirectsActiveted($result->id)) {

                                    case $result->getDirectsActiveted($result->id) >= 3 && $result->getDirectsActiveted($result->id) < 6 || $ativadorcard > 0:
                                        $array_unilevel[$count] = 20;
                                        break;
                                    case $result->getDirectsActiveted($result->id) >= 0 && $result->getDirectsActiveted($result->id) < 3 || $ativadorcard == 0:
                                        $array_unilevel[$count] = 10;
                                        break;
                                    case $result->getDirectsActiveted($result->id) >= 6:
                                        $array_unilevel[$count] = 25;
                                        break;
                                }
                            }
                            $valor = $array_unilevel[$count] / 100;
                        }
                    }
                }

                $valor = $valor * $price;

                $valorespecial = isset($result->special_comission) && $result->special_comission_active == 1 ? $result->special_comission : 0;
                ###CASO O COUNT FOR 1 ELE É 1( SIGNUP COMISSION ) CASO O COUNT FOR DIFERENTE É 2 ( LEVEL COMISSION )
                if ($count == 1) {
                    $desc = 1;
                } else {
                    $desc = 2;
                }

                if ($valor > 0) {


                    $data = [
                        "price"       => $valor,
                        "description" => "$desc",
                        "status"      => 1,
                        "user_id"     => $result->id,
                        "order_id"    => $order_package_id,
                        "level_from"  => "$count",
                    ];


                    $banco = Banco::create($data);
                }

                if ($valorespecial > 0) {

                    $valorespecialcommition = $valorespecial / 100 * $price;

                    if ($valorespecialcommition > 0) {
                        $data = [
                            "price"       => $valorespecialcommition,
                            "description" => "8",
                            "status"      => 1,
                            "user_id"     => $result->id,
                            "order_id"    => $order_package_id,
                            "level_from"  => "$count",
                        ];

                        $banco = Banco::create($data);
                    }
                }

                $data = [
                    "score"             => $price,
                    "status"            => 1,
                    "description"       => "6",
                    "user_id"           => $result->id,
                    "orders_package_id" => $order_package_id,
                    "user_id_from"      => $package->user->id,
                    "level_from"        => "$count",
                ];


                // $score = HistoricScore::create($data);
                $nivel1 = User::where('id', $user->recommendation_user_id)->first();
                $nivel12 = User::where('recommendation_user_id', $nivel1->recommendation_user_id)->first();
                $user_id = $nivel12->id;
            } else {
                $sair = 0;
            }


            $count++;
        }
    }

    static function bonusDiretoIndireto_e_VolumeStatic($user_id, $price, $order_package_id, $array_unilevel, $array_unilevel_peoples)
    {
        $sair = 1;
        $count = 1;
        $package = OrderPackage::find($order_package_id);
        while ($sair == 1) {
            $user = User::where('id', $user_id)->where('activated', 1)->orderBy('id', 'ASC')->first();
            //dd($user);
            //$result = User::where('id', $user->recommendation_user_id)->get();
            //echo "select * from users where id='".$fato_gerador."' order by id asc limit 1";


            if ($user != null && $user->recommendation_user_id >= 0 && !empty($user->recommendation_user_id)) {
                $result = User::where('id', $user->recommendation_user_id)->first();

                $ativadorcard = OrderPackage::where('status', 1)->where('payment_status', 1)->where('user_id', $result->id)->where('price', 39.90)->orWhere('price', 10.00)->count();
                $valor = 0;
                ####SE A ARRAY COM A CHAVE SENDO O COUNT TIVER VALOR COLOCA O VALOR DIVIDIDO POR 100 PARA GERAR A PORCENTAGEM

                if ($array_unilevel[$count] != "") {
                    if ($array_unilevel_peoples[$count] != "") {
                        if ($result->getDirectsActiveted($result->id) >= $array_unilevel_peoples[$count]) {
                            if ($count == 1) {
                                switch ($result->getDirectsActiveted($result->id)) {

                                    case $result->getDirectsActiveted($result->id) >= 3 && $result->getDirectsActiveted($result->id) < 6 || $ativadorcard > 0:
                                        $array_unilevel[$count] = 20;
                                        break;
                                    case $result->getDirectsActiveted($result->id) >= 0 && $result->getDirectsActiveted($result->id) < 3 || $ativadorcard == 0:
                                        $array_unilevel[$count] = 10;
                                        break;
                                    case $result->getDirectsActiveted($result->id) >= 6:
                                        $array_unilevel[$count] = 25;
                                        break;
                                }
                            }
                            $valor = $array_unilevel[$count] / 100;
                        }
                    }
                }

                $valor = $valor * $price;

                $valorespecial = isset($result->special_comission) && $result->special_comission_active == 1 ? $result->special_comission : 0;
                ###CASO O COUNT FOR 1 ELE É 1( SIGNUP COMISSION ) CASO O COUNT FOR DIFERENTE É 2 ( LEVEL COMISSION )
                if ($count == 1) {
                    $desc = 1;
                } else {
                    $desc = 2;
                }

                if ($valor > 0) {


                    $data = [
                        "price"       => $valor,
                        "description" => "$desc",
                        "status"      => 1,
                        "user_id"     => $result->id,
                        "order_id"    => $order_package_id,
                        "level_from"  => "$count",
                    ];


                    $banco = Banco::create($data);
                }

                if ($valorespecial > 0) {

                    $valorespecialcommition = $valorespecial / 100 * $price;

                    if ($valorespecialcommition > 0) {
                        $data = [
                            "price"       => $valorespecialcommition,
                            "description" => "8",
                            "status"      => 1,
                            "user_id"     => $result->id,
                            "order_id"    => $order_package_id,
                            "level_from"  => "$count",
                        ];

                        $banco = Banco::create($data);
                    }
                }

                $data = [
                    "score"             => $price,
                    "status"            => 1,
                    "description"       => "6",
                    "user_id"           => $result->id,
                    "orders_package_id" => $order_package_id,
                    "user_id_from"      => $package->user->id,
                    "level_from"        => "$count",
                ];


                // $score = HistoricScore::create($data);
                $nivel1 = User::where('id', $user->recommendation_user_id)->first();
                $nivel12 = User::where('recommendation_user_id', $nivel1->recommendation_user_id)->first();
                $user_id = $nivel12->id;
            } else {
                $sair = 0;
            }


            $count++;
        }
    }

    protected function bonus_compra($contador, $indicador, $package_valor, $order_id, array $lista = array())
    {
        if ($contador < 15) {

            $user = User::where('id', $indicador)->first();
            $result = User::where('id', $user->recommendation_user_id)->get();
            $valorBonus = 0;
            foreach ($result as $row) {
                $var = $row->id;

                $lista[] = $var;
                $contador++;

                switch ($contador) {

                    case 1:
                        $valorBonus = $package_valor * 0.10;
                        break;

                    case 2:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 3:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 4:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 5:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 6:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 7:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 8:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 9:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 10:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 11:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 12:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 13:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 14:
                        $valorBonus = $package_valor * 0.0005;
                        break;

                    case 15:
                        $valorBonus = $package_valor * 0.0005;
                        break;
                }


                $user = User::find($var);

                if ($contador == 1) {
                    $data = [
                        "price"       => $valorBonus,
                        "description" => "Referral Bonus",
                        "status"      => 0,
                        "order_id"    => $order_id
                    ];
                } else {
                    $data = [
                        "price"       => $valorBonus,
                        "description" => "Unilevel Bonus #$contador",
                        "status"      => 0,
                        "order_id"    => $order_id
                    ];
                }


                $banco = $user->banco()->create($data);

                $this->bonus_compra($contador, $row->id, $package_valor, $order_id, $lista);
            }
        }
    }
}
