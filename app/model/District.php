<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class District
 * @package App\model
 * @property string code
 * @property string name
 */
class District extends Model
{
    protected $fillable = [
        'code',
        'name',
    ];
}
