<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Bee extends Model
{
    protected $fillable = [
        'user',
        'qr',
        'code',
    ];
}
