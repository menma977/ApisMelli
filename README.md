# APISMELLI Installation


## install laravel/passport

### type ledger
#### 0 = income
#### 1 = outcome
#### 2 = bonus
#### 3 = withdraw

### status ledger
#### 0 = accept
#### 1 = cancel
#### 2 = bonus

### status bee
#### 0 = Orders Accepted
#### 1 = Order Came
#### 2 = Order Processed
#### 3 = Order Canceled
#### 4 = Order Waiting Date
#### 5 = Pin Take By Username
#### 6 = Not use
#### 7 = Order Sell

### status bee History
#### 0 = Wait To Procuress
#### 1 = Have By Username
#### 2 = Sell
#### 3 = Buy by Username
#### 4 = Cancel

```shell
php artisan migrate
php artisan passport:install
```

```php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
}
```

```php
use Laravel\Passport\Passport;

protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
 ];
 
 public function boot()
{
    $this->registerPolicies();

    Passport::routes();
}
```

### config/auth.php
#### TokenGuard
```js
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
```

[passport link](https://laravel.com/docs/master/passport)

[chart link](https://dev.to/arielsalvadordev/use-laravel-charts-in-laravel-5bbm)
