<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Binary extends Model
{
    protected $fillable = [
        'sponsor',
        'user',
    ];
}
