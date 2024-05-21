<?php

namespace App\Traits;

use App\Models\SystemConf;
use App\Models\User;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\PersonalAccessToken;

trait ApiUser
{
    private function getUser($request)
    {
        try {
            //code...
            $system = SystemConf::first();
            if (isset($system)) {
                if ($system->all == 0 || $system->all == 1 && $system->app == 0) {
                    return response()->json(['error' => "System disabled"]);
                }
            }

            $token = $request->header('Authorization');

            // Verificar se o token está no formato correto
            if (strpos($token, 'Bearer ') !== 0) {
                return false;
            }

            $token = substr($token, 7);

            $tkn = PersonalAccessToken::where('token', $token)->first();

            $agora = Carbon::now();
            $expiracao = Carbon::parse($tkn->expires_at);

            if (!$tkn) {
                return false;
            }

            if ($agora->gt($expiracao)) {
                return false;
            }

            $user = User::where('id', $tkn->tokenable_id)->first();

            if (!$user) {
                return false;
            }

            $tkn->last_used_at = Carbon::now()->format('Y-m-d H:i:s');
            $tkn->save();

            if ($user->activated == 0) {
                return response()->json(['error' => 'Account awaiting approval'], 401);
            }

            return $user;

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error in process token'], 401);
        }
    }
}
