<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * @package App\Model
 *
 * @property integer status
 * @property string rbg
 * @property string description
 * @property string full_description
 * @property boolean read
 */
class Notification extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   *
   * * Status
   * * * 0: Danger -> #007bff
   * * * 0: Warning -> #ffc107
   * * * 0: Info -> #17a2b8
   */
  protected $fillable = [
    'status',
    'rbg',
    'description',
    'full_description',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id',
    'read',
  ];
}
