<?php

namespace App\Http\Controllers;

use App\Models\Rede;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Hash;

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
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 422);
        }

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

    public function register(Request $request)
    {
        try {

            $validatedData = Validator::make($request->all(), [
                'name' => 'required|string|string',
                'login' => 'required|string|string',
                'email' => 'required|string|email',
                'password' => 'required|string',
                'cell' => 'required',
                'country' => 'required|string',
                'city' => 'required|string',
                'last_name' => 'required|string',
                'recommendation_user_id' => 'required',
            ]);

            if ($validatedData->fails()) {
                return response()->json(['error' => $validatedData->errors()], 422);
            }

            $exists = User::where('email', $request->email)->orWhere('login', $request->login)->first();

            if (isset ($exists)) {
                return response()->json(['Error' => "User already exists"]);
            }

            $user_rec = User::where('id', $request->recommendation_user_id)->orWhere('login', $request->recommendation_user_id)->first();

            if (!isset ($user_rec)) {
                return response()->json(['Error' => "Referral invalid"]);
            }

            $recommendation = $user_rec != null ? $user_rec->id : '3';


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'login' => $request->login,
                'activated' => 0,
                'password' => Hash::make($request->password),
                'financial_password' => Hash::make($request->password),
                'recommendation_user_id' => $recommendation,
                'special_comission' => 1,
                'special_comission_active' => 0,
                'cell' => $request->cell,
                'country' => $request->country,
                'city' => $request->city,
                'last_name' => $request->last_name,
                // 'telephone' => $data['telephone'],
                // 'gender'   => $data['gender'],
                // 'address1' => $data['address1'],
                // 'address2' => $data['address2'],
                // 'postcode' => $data['postcode'],
                // 'state'    => $data['state'],
                // 'birthday' => date('Y-m-d', strtotime($data['birthday'])),
                // 'id_card' => $data['id_card']
            ]);


            $rede_recommedation = Rede::where('user_id', $recommendation)->first();

            $user->rede()->create([
                "upline_id" => $rede_recommedation->id,
                "qty" => 0,
                "ciclo" => 1,
                "saque" => 0
            ]);

            $rede_recommedation->update([
                "qty" => $rede_recommedation->qty + 1
            ]);


            return $this->login($request);

        } catch (\Throwable $th) {
            return response()->json(['Error' => "Failed to create User"]);
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
