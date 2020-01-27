<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubDistrict
 * @package App\model
 * @property string code
 * @property string name
 * @method static where(string $string, $id)
 */
class SubDistrict extends Model
{
  protected $fillable = [
    'code',
    'name',
  ];
}
