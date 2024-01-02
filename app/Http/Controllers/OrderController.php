<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use App\Models\Banco;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index() {


        $package_valor = 200.00; // Valor pago do package
        $user = 17; // User que comprou o pacote 
        $parent = User::where('recommendation_user_id', $user)->get();

        $order = Order::find(2);
        /**Bonus Compra */
        echo "<br><br>";
        $valorBonus = 200;
        $id_user = $this->bonus_compra(0,$order->user_id,$valorBonus,$order->id);
        echo "<br><br>";

        /**Bonus Carreira */
        echo "<br><br>";
        $id_user = 1;
        $id_user = $this->carreira_bonus($id_user);
        echo "<br><br>";

        return view('teste', compact('parent'));
    }

    /**
     *  @param  int  $id
     * 
     */

    function bonus_compra($contador,$indicador,$package_valor,$order_id,array $lista = array())
    {
        if($contador < 16)
        {   

            $user = User::where('id', $indicador)->first();
            $result = User::where('id', $user->recommendation_user_id)->get();
            foreach ($result as $row)
            { 
                $package_valor = 200;
                $var = $row->id;
                // dd($var);
                $lista[] = $var;
                $contador++;
                echo "<br>Id: ".$var." numero: ".$contador."<br>";

                switch ($contador) {

                    case 1:
                        $valorBonus = $package_valor * 0.10;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 2:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;
        
                    case 3:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;
        
                    case 4:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 5:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 6:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 7:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 8:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 9:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 10:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 11:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 12:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 13:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    case 14:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus." contador : ".$contador."<br>";
                    break;

                    
                }

               
                $user = User::find($var);
                
                if ($contador == 1){
                    $data = [
                    "price"       => $valorBonus,
                    "description" => "Referral Bonus",
                    "status"      => 0,
                    "order_id"    => $order_id
                    ];  

                }else{
                    $data = [
                        "price"       => $valorBonus,
                        "description" => "Unilevel Bonus #$contador",
                        "status"      => 0,
                        "order_id"    => $order_id[0]
                    ];  
                }

               
                $banco = $user->banco()->create($data);
                
                $this->bonus_compra($contador,$row->id,$order_id,$lista);
                //return $lista;

            }

        }
    
    }

    public function carreira_bonus ($id_user){

        /**
         * Subir carreira, para subir carreira vai precisa contar a rede depois a quantidade de pontos de
         * que tem, se bater ele ganha uma bonificação de rede e sobe a carreira
         *
         */
        $contador = 1;
        if($contador < 16)
        {   

            $result = User::where('id', $id_user)->get();
            foreach ($result as $row)
            { 
                $package_valor = 200;
                $var = $row->id;
                // dd($var);
                $lista[] = $var;
                $contador++;

                
                $this->carreira_bonus($row->recommendation_user_id);
                return $contador;

            }

        }
    }

}
