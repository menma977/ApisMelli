<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string code
 * @property float|int credit
 * @property string description
 * @property float debit
 * @property int user
 * @property int ledger_type
 * @method static where(string $string, $id)
 */
class Ledger extends Model
{
    protected $fillable = [
        'code',
        'description',
        'debit',
        'credit',
        'user',
        'ledger_type',
    ];
}
