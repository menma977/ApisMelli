<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
   */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = '/home';

  /**
   * Login username to be used by the controller.
   *
   * @var string
   */
  protected $username;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');

    $this->username = $this->findUsername();
  }

  /**
   * Get the login username to be used by the controller.
   *
   * @return string
   */
  public function findUsername(): string
  {
    $login = request()->input('username');
    $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    request()->merge([$fieldType => $login]);
    return $fieldType;
  }

  /**
   * Get username property.
   *
   * @return string
   */
  public function username(): string
  {
    return $this->username;
  }

  protected function credentials(Request $request)
  {
    return array_merge($request->only($this->username(), 'password'), ['status' => [1, 2]]);
  }

  protected function sendFailedLoginResponse(Request $request)
  {
    $errors = [$this->username() => trans('auth.failed')];
    $user = User::where($this->username(), $request->{$this->username()})->first();

    if ($user && Hash::check($request->password, $user->password) && $user->status == 0) {
      $errors = [$this->username() => trans('Akun Anda telah ditangguhkan. silakan hubungi admin')];
    }

    if ($request->expectsJson()) {
      return response()->json($errors, 422);
    } else {
      return redirect()->back()->withInput($request->only($this->username(), 'remember'))->withErrors($errors);
    }
  }
}
