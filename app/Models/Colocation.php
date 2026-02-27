<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = [
        'name',
        'status',
        'numbers',
    ];


    public function users()
    {
        return $this->hasOne(User::class);
    }
    
    
}
