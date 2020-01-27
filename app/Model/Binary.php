<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Binary
 * @package App\model
 * @property int sponsor
 * @property int user
 * @method static where(string $string, $id)
 */
class Binary extends Model
{
  protected $fillable = [
    'sponsor',
    'user',
  ];
}
