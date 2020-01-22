<?php

namespace App\Providers;

use App\Model\Stup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view) {
            $stup = Stup::where('status', 0)->count();
            $view->with('countStup', $stup);
        });

        Blade::if('admin', function () {
            return Auth::user() && Auth::user()->rule == 0 ? true : false;
        });

        Blade::if('member', function () {
            return Auth::user() && Auth::user()->rule == 1 ? true : false;
        });
    }
}
