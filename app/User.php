<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App
 * @property int role
 * @property string name
 * @property string username
 * @property string email
 * @property string password
 * @property string bank
 * @property string pin_bank
 * @property string phone
 * @property int id_identity_card
 * @property string identity_card_image
 * @property string identity_card_image_salve
 * @property string image
 * @property int province
 * @property int district
 * @property int sub_district
 * @property string village
 * @property int number_address
 * @property string description_address
 * @property int status
 */
class User extends Authenticate
{
  use HasApiTokens, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'role',
    'name',
    'username',
    'email',
    'password',
    'phone',
    'bank',
    'pin_bank',
    'id_identity_card',
    'identity_card_image',
    'identity_card_image_salve',
    'image',
    'province',
    'district',
    'sub_district',
    'village',
    'number_address',
    'description_address',
    'status',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id', 'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function isOnline(): bool
  {
    return Cache::has('activeUser' . $this->id);
  }
}
