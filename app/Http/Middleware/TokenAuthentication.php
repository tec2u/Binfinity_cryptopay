<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class TokenAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar se o cabeçalho Authorization está presente
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['error' => 'Token required'], 401);
        }

        // Obter o token do cabeçalho Authorization
        $token = $request->header('Authorization');

        // Verificar se o token está no formato correto
        if (strpos($token, 'Bearer ') !== 0) {
            return response()->json(['error' => 'Token invalid'], 401);
        }

        // Extrair o token
        $token = substr($token, 7);

        // Verificar se o token existe no banco de dados
        $tkn = PersonalAccessToken::where('token', $token)->first();

        // Verificar se o token é válido
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

        return $next($request);
    }
}
