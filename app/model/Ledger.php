<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

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
