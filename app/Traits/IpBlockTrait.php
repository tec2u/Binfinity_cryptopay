<?php

namespace App\Traits;

use App\Models\IpBlacklist;
use App\Models\IpPool;
use App\Models\IpWhitelist;

trait IpBlockTrait
{
    public function verifyCounter($ip, $login, $password)
    {
        $ip_pool = IpPool::where('ip', $ip)->where('date', date('Y-m-d'))->first();

        if (isset($ip_pool->counter) && $ip_pool->counter < 15) {
            $ip_pool->update(['counter', $ip_pool->counter ++]);
        } else if (isset($ip_pool->counter) && $ip_pool->counter == 15) {
            IpBlacklist::insert([
                'ip' => $ip,
                'login' => $login,
                'password' => $password,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            IpPool::insert([
                'ip' => $ip,
                'login' => $login,
                'password' => $password,
                'counter' => 0,
                'date' => date('Y-m-d')
            ]);
        }
    }

    public function verifyBlacklist($ip, $login, $password){

        $ip_blacklist = IpBlacklist::where('ip', $ip)
        ->where('created_at','>=', date('Y-m-d 00:00:00'))
        ->where('created_at','<=', date('Y-m-d 23:59:59'))
        ->first();

        $ip_whitelist = IpWhitelist::where('ip', $ip)->first();

        if(!isset($ip_whitelist->ip)){

            if(isset($ip_blacklist->ip)){
                return 'IP_BLOCK';
            } else {
                $this->verifyCounter($ip, $login, $password);
            }
        }
    }
}
