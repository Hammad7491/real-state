<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'notes'
    ];

    public function criteria()
    {
        return $this->hasMany(BuyerCriteria::class);
    }
}
