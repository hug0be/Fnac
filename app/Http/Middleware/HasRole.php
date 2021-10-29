<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role) {
        $user = Auth::guard('employe')->user();
        if ($user->hasRole('admin') || $user->hasRole($role)) {
            return $next($request);
        }
        return redirect('/employe/login')->withErrors(['role'=>'Cette page nécessite le rôle '.$role]);
    }

}
