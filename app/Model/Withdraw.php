<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Withdraw
 * @package App\model
 * @property int user
 * @property string total
 * @property int status
 */
class Withdraw extends Model
{
    protected $fillable = [
        'user',
        'total',
        'status',
    ];
}
