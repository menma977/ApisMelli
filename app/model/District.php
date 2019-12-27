<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'code',
        'name',
    ];
}
