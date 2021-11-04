<?php

namespace App\Providers;

use App\Models\Console;
use App\Models\Rayon;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Carbon::setLocale('fr');
        View::share('rayons', Rayon::all());
        View::share('consoles', Console::all());
        View::share('client', Auth::user() ? Auth::user() : null);

        Blade::if('admin', function () {
            return Auth::guard('employe')->check() && Auth::guard('employe')->user()->hasRole('admin');
        });
        Blade::if('employe', function () {
            return Auth::guard('employe')->check();
        });
        Blade::if('role', function ($roles) {
            if (!Auth::guard('employe')->check()) return false;
            $emp = Auth::guard('employe')->user();
            foreach($roles as $role) {
                if($emp->hasRole($role)) return True;
            }
            return false;
        });
        
    }
}
