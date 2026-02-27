<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = true;
    
    protected $fillable = [
        'amount',
        'description',
        'user_id',
        'colocation_id',
        'category_id'
    ];
}
