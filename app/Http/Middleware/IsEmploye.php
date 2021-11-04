<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsEmploye {
    public function handle($request, Closure $next) {
        $user = Auth::guard('employe')->user();
        if($user) {
            return $next($request);
        }
        return redirect()->route('emp.login');
    }
}
