<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Province
 * @package App\model
 * @property string code
 * @property string name
 */
class Province extends Model
{
    protected $fillable = [
        'code',
        'name',
    ];
}
