<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class District
 * @package App\model
 * @property string code
 * @property string name
 * @method static where(string $string, $id)
 */
class District extends Model
{
  protected $fillable = [
    'code',
    'name',
  ];
}
