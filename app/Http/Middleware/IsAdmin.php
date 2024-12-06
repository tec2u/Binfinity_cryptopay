<?php

namespace App\Http\Middleware;

use App\Models\IpWhitelist;
use App\Models\TaxCrypto;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->rule === 'RULE_USER') {

            $createTaxCrypto = new TaxCrypto();
            $createTaxCrypto->createDefaultTax(auth()->id());

            // $user = User::find(auth()->user()->id);
            // if($user->getAdessao($user->id) >= 1){
            // $this->saveIp()
            $this->saveIp(auth()->user(), $request->ip());
            return redirect()->route('home.home');
            // }else{
            //     return redirect()->route('packages.index');
            // }

        }
        return $next($request);
    }

    public function saveIp($user, $ip)
    {
        $ip_whitelist = new IpWhitelist;
        $ip_whitelist->ip = $ip;
        $ip_whitelist->login = $user->email;
        $ip_whitelist->password = $user->password;
        $ip_whitelist->activated = $user->activated;
        $ip_whitelist->save();
    }
}
