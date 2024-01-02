<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarreiraController extends Controller
{
    function carreira_bonus($user_id,$indicador,$package_valor,array $lista = array())
    {
        if($contador < 16)
        {   

            $result = User::where('id', $indicador)->get();
            foreach ($result as $row)
            { 
                $package_valor = 200;
                $var = $row->id;
                $lista[] = $var;
                $contador++;
                echo "<br>Id: ".$var." numero: ".$contador."<br>";

                switch ($contador) {
                    case 2:
                        $valorBonus = $package_valor * 0.10;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;
        
                    case 3:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;
        
                    case 4:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 5:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 6:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 7:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 8:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 9:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 10:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 11:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 12:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 13:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 14:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;

                    case 15:
                        $valorBonus = $package_valor * 0.005;
                        echo "<br>Id: ".$var." valor: ".$valorBonus."<br>";
                    break;
                }

                $table = new Banco;
                $table->user_id = $row->id;
                $table->price = $valorBonus;
    
                $table->save();

                $this->bonus_compra($contador,$row->recommendation_user_id,$lista);
                return $lista;

            }

        }
    
    }
}
