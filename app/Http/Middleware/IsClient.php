<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsClient {
    public function handle($request, Closure $next) {
        $user = Auth::guard('client')->user();
        if($user) {
            return $next($request);
        }
        return route('login');
    }
}
