<?php

namespace App\Http\Controllers;

use App\Models\Rede;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MigraController extends Controller
{
    protected function index()
    {
        $users_old = DB::table('users_old')->select('*')->where('id', '>', 111827)->limit(2500)->get();
        
        
        foreach($users_old as $old){

            $user_busca = User::find($old->id);

            if(empty($user_busca)){

                if($old->id == 1){

                    $user =  User::create([
                        'id'   => $old->id,
                        'name' => $old->first_name ." ". $old->last_name,
                        'email' => $old->email,
                        'login' => $old->username,
                        'telephone' => preg_replace('/[^0-9]/', '', $old->phone_no),
                        'cell' => preg_replace('/[^0-9]/', '', $old->phone_no),
                        'activated' => $old->status,
                        'gender' => 'M',
                        'country' => empty($old->country) ? "no country" : $old->country,
                        'password' => Hash::make($old->show_pass),
                        'financial_password' =>  Hash::make($old->show_pass),
                        'recommendation_user_id' => $old->referral_id,
                
                    ]);

                    $user->rede()->create([
                        "qty"       => 0,
                        "ciclo"     => 1,
                        "saque"     => 0
                    ]);

                }else{

                    $user =  User::create([
                        'id'   => $old->id,
                        'name' => $old->first_name ." ". $old->last_name,
                        'email' => $old->email,
                        'login' => $old->username,
                        'telephone' => preg_replace('/[^0-9]/', '', $old->phone_no),
                        'cell' => preg_replace('/[^0-9]/', '', $old->phone_no),
                        'activated' => $old->status,
                        'gender' => 'M',
                        'country' => empty($old->country) ? "no country" : $old->country,
                        'password' => Hash::make($old->show_pass),
                        'financial_password' =>  Hash::make($old->show_pass),
                        'recommendation_user_id' => $old->referral_id,
                
                    ]);
                    $recommendation = $old->referral_id;
                    $rede_recommedation = Rede::where('user_id', $recommendation)->first();

                    $user->rede()->create([
                        "upline_id" => $rede_recommedation->id,
                        "qty"       => 0,
                        "ciclo"     => 1,
                        "saque"     => 0
                    ]);

                    $rede_recommedation->update([
                        "qty"   => $rede_recommedation->qty + 1
                    ]);
                }
            }
        }
    }
}
