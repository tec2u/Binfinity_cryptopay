<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\IpPool;
use App\Models\IpBlacklist;

class IpBlockController extends Controller
{
    public function verifyCounter($ip, $login, $password)
    {
        $ip_pool = IpPool::where('ip', $ip)->where('login', $login)->where('date', date('d/m/y'))->first();
        if ($ip_pool->counter < 15) {
            $ip_pool->update(['counter', $ip_pool->counter + 1]);
        } else if ($ip_pool->counter == 15) {
            IpBlacklist::insert([
                'ip' => $ip,
                'login' => $login,
                'password' => $password
            ]);
        } else {
            IpPool::insert([
                'ip' => $ip,
                'login' => $login,
                'password' => $password,
                'counter' => 0,
                'date' => date('d/m/y')
            ]);
        }
    }

    public function verifyBlacklist($ip, $login, $password){
        $ip_blacklist = IpBlacklist::where('ip', $ip)->where('login', $login)->first();
        if(isset($ip_blacklist->ip)){
            return 'IP_BLOCK';
        } else {
            $this->verifyCounter($ip, $login, $password);
        }
    }
}
