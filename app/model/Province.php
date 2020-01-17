<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Province
 * @package App\model
 * @property string code
 * @property string name
 * @method static where(string $string, $id)
 */
class Province extends Model
{
    protected $fillable = [
        'code',
        'name',
    ];
}
