============================================
APISMELLI Installation
-------------------------------------------

install laravel/passport
============================================
php artisan migrate
php artisan passport:install
-------------------------------------------

===========================================
?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
}
-------------------------------------------

===========================================
use Laravel\Passport\Passport;

protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
 ];
 
 public function boot()
{
    $this->registerPolicies();

    Passport::routes();
}
-------------------------------------------

===========================================
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
-------------------------------------------

passport link
https://laravel.com/docs/master/passport

chart link
https://dev.to/arielsalvadordev/use-laravel-charts-in-laravel-5bbm
