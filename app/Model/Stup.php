<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Stup
 * @package App\Model
 * @property int user
 * @property int total
 * @property int status
 */
class Stup extends Model
{
  protected $fillable = [
    'user',
    'total',
    'code',
    'status',
  ];
}
