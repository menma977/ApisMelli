<?php

namespace App\Providers;

use App\Model\Stup;
use App\User;
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
  public function boot(): void
  {
    view()->composer('layouts.sidebar', function ($view) {
      $stup = Stup::where('status', 0)->count();
      $users = User::where('status', 1)->whereNotNull('identity_card_image')->whereNotNull('identity_card_image_salve')->count();
      $view->with('countStup', $stup)->with('users', $users);
    });

    Blade::if('admin', function () {
      return (Auth::user() && Auth::user()->role == 0);
    });

    Blade::if('member', function () {
      return (Auth::user() && Auth::user()->role == 1);
    });
  }
}
