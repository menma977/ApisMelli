<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App
 * @property int rule
 * @property string name
 * @property string username
 * @property string email
 * @property string password
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
 * @method static find(false|string $id)
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rule',
        'name',
        'username',
        'email',
        'password',
        'phone',
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
}
