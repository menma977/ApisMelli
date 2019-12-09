<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class BuyHistory extends Model
{
    protected $fillable = [
        'user_id',
        'code',
    ];
}
