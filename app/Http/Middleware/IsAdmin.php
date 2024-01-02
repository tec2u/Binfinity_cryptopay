<?php

namespace App\Http\Middleware;

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
            $user = User::find(auth()->user()->id);
            if($user->getAdessao($user->id) >= 1){
               return redirect()->route('home.home'); 
            }else{
                return redirect()->route('packages.index');
            }
            
        }
        return $next($request);
    }
}
