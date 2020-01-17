<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bee
 * @package App\model
 * @property int user
 * @property string qr
 * @property string code
 */
class Bee extends Model
{
    protected $fillable = [
        'user',
        'qr',
        'code',
    ];
}
