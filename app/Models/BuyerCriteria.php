<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerCriteria extends Model
{
    protected $table = 'buyer_criteria';

    protected $fillable = [
        'buyer_id', 'field', 'operator', 'value', 'weight'
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
