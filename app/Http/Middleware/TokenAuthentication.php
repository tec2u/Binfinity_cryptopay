<?php

namespace App\Http\Middleware;

use App\Models\IpAccessApi;
use Carbon\Carbon;
use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class TokenAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        try {
            //code...
            if (!$request->hasHeader('Authorization')) {
                return response()->json(['error' => 'Token required'], 401);
            }

            $token = $request->bearerToken();

            // $token = $request->header('Authorization');

            // if (strpos($token, 'Bearer ') !== 0) {
            //     return response()->json(['error' => 'Token invalid'], 401);
            // }

            // $token = substr($token, 7);

            $tkn = PersonalAccessToken::where('token', $token)->first();

            if (!$tkn) {
                return response()->json(['error' => 'Token invalid'], 401);
            }

            $agora = Carbon::now();
            $expiracao = Carbon::parse($tkn->expires_at);

            if ($agora->gt($expiracao)) {
                return response()->json(['error' => 'Token expired'], 401);
            }

            $user = User::where('id', $tkn->tokenable_id)->first();

            if (!$user) {
                return response()->json(['error' => 'Token invalid'], 401);
            }

            $ip = $request->ip();
            $requestFormated = $request->all();

            $ipRequest = new IpAccessApi;
            $ipRequest->ip = $ip;
            $ipRequest->operation = "api/app/validate/token";
            $ipRequest->request = json_encode(["token" => $token, "request" => $requestFormated]);
            $ipRequest->save();

            return $next($request);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error in process token'], 401);
        }
    }
}
