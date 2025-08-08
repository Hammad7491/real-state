<?php
// app/Models/Seller.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Seller extends Model
{
    // … your existing $fillable, etc.

    /**
     * Scope a query to match against a set of buyer criteria.
     *
     * @param  Builder  $query
     * @param  \Illuminate\Support\Collection|\App\Models\BuyerCriteria[]  $criteria
     * @return Builder
     */
    public function scopeMatching(Builder $query, $criteria)
    {
        // map buyer fields to actual seller columns
        $map = [
            'location'       => 'property_city',   // still need custom OR logic if desired
            'price'          => 'asking_price',
            'property_type'  => 'deal_type',       // <<< changed from 'property_type'
            'bedrooms'       => 'bedrooms',
            'bathrooms'      => 'bathrooms',
            'square_footage' => 'square_footage',
        ];

        return $query->where(function($q) use ($criteria, $map) {
            foreach ($criteria as $c) {
                $col = $map[$c->field] ?? $c->field;
                $op  = strtoupper($c->operator);
                $val = $c->value;

                if ($c->field === 'location' && $op === 'IN') {
                    // custom OR-across-city/state/zip
                    $vals = array_map('trim', explode(',', $val));
                    $q->where(function($q2) use ($vals) {
                        $q2->whereIn('property_city', $vals)
                           ->orWhereIn('property_state', $vals)
                           ->orWhereIn('property_zip', $vals);
                    });
                }
                elseif ($op === 'IN') {
                    $vals = array_map('trim', explode(',', $val));
                    $q->whereIn($col, $vals);
                } else {
                    $q->where($col, $op, $val);
                }
            }
        });
    }
}
