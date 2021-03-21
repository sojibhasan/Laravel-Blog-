<?php

namespace App\Http\Middleware;

use Closure;

class SupperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $userRoles = auth()->user()->role;

        if($userRoles == 1){
            return $next($request);
        }
        
        return redirect()->route('dashboard');
    }
}
