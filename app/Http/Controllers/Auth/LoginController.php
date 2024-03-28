<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            //code...

            $user = Socialite::driver('google')->user();
            // dd($user);

            $master = User::where('login', 'master')->first();

            $exists = User::where('email', $user->email)->first();

            if (!isset($exists)) {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'login' => $user->email,
                    'activated' => 0,
                    'password' => Hash::make($user->email),
                    'financial_password' => Hash::make($user->email),
                    'recommendation_user_id' => $master->id,
                    'special_comission' => 1,
                ]);

                $user = User::find($createUser->id);
                Auth::login($user);
                return redirect()->intended('home');

            } else {
                Auth::login($exists);
                return redirect()->intended('home');
            }
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->to('/login');
        }

    }
}
