<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $fillable = [
        'amount',
        'is_paid',
        'debtor_id',
        'creditor_id',
        'expense_id',
    ];
}
