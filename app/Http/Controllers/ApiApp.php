<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class ApiApp extends Controller
{
    private function getUser($request)
    {
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

        return $user;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $accessToken = $user->createToken('Login', ['*'], Carbon::now()->addDay());

            $token = $accessToken->plainTextToken;

            $parteAntesDoPipe = strstr($token, '|', true); // Obtém a parte antes do primeiro '|'

            if ($parteAntesDoPipe !== false) {
                $ttk = PersonalAccessToken::where('id', $parteAntesDoPipe)->first();
                if (!isset ($ttk)) {
                    return response()->json(['error' => 'Error in generate token'], 401);
                }

                return response()->json(['token' => $ttk->token], 200);

            } else {
                return response()->json(['error' => 'Error in generate token'], 401);
            }

        } else {

            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function teste(Request $request)
    {
        $user = $this->getUser($request);
        if ($user == false) {
            return response()->json(['Error' => "Invalid token"]);
        }

        return response()->json(['user' => $user]);
    }
}
