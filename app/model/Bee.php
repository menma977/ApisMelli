<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Bee extends Model
{
    protected $fillable = [
        'pin',
        'code',
        'buy',
        'sell',
        'status',
    ];
}
