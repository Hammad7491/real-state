<?php
// app/Models/Seller.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Seller extends Model
{
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        // Seller Info
        'name',
        'email',
        'phone',

        // Property Info
        'property_address',
        'property_city',
        'property_state',
        'property_zip',

        // Deal Type
        'deal_type',

        // Core deal fields
        'asking_price',
        'bedrooms',
        'bathrooms',
        'square_footage',

        // ROI / Entry inputs
        'arv',
        'estimated_repairs',
        'back_taxes',
        'title_liens',
        'closing_costs',
        'transaction_coordinator_fees',

        // Creative fields
        'mortgage_balance',
        'monthly_piti',
        'arrears',
        'cash_to_seller',
        'down_payment',
        'monthly_payment_to_seller',
        'interest_rate',
        'term_length',
        'balloon',
        'balloon_years',

        // Extra
        'additional_details',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        // integers
        'asking_price'                => 'integer',
        'bedrooms'                    => 'integer',
        'square_footage'              => 'integer',
        'arv'                         => 'integer',
        'estimated_repairs'           => 'integer',
        'back_taxes'                  => 'integer',
        'title_liens'                 => 'integer',
        'closing_costs'               => 'integer',
        'transaction_coordinator_fees'=> 'integer',
        'mortgage_balance'            => 'integer',
        'monthly_piti'                => 'integer',
        'arrears'                     => 'integer',
        'cash_to_seller'              => 'integer',
        'down_payment'                => 'integer',
        'monthly_payment_to_seller'   => 'integer',
        'term_length'                 => 'integer',
        'balloon_years'               => 'integer',

        // decimals / booleans
        'bathrooms'                   => 'float',
        'interest_rate'               => 'float',
        'balloon'                     => 'boolean',
    ];

    /**
     * Scope a query to match against a set of buyer criteria.
     *
     * @param  Builder  $query
     * @param  \Illuminate\Support\Collection|array  $criteria
     *   Each item: (object|array) with ->field, ->operator, ->value
     * @return Builder
     */
    public function scopeMatching(Builder $query, $criteria)
    {
        // map buyer fields to actual seller columns
        $map = [
            'location'       => 'property_city',   // custom OR city/state/zip below
            'price'          => 'asking_price',
            'property_type'  => 'deal_type',
            'bedrooms'       => 'bedrooms',
            'bathrooms'      => 'bathrooms',
            'square_footage' => 'square_footage',
        ];

        $iter = is_array($criteria) ? $criteria : $criteria->all();

        return $query->where(function ($q) use ($iter, $map) {
            foreach ($iter as $c) {
                // support array or object
                $field    = is_array($c) ? ($c['field'] ?? null) : ($c->field ?? null);
                $operator = strtoupper(is_array($c) ? ($c['operator'] ?? '=') : ($c->operator ?? '='));
                $value    = is_array($c) ? ($c['value'] ?? null) : ($c->value ?? null);

                if ($field === null) {
                    continue;
                }

                $col = $map[$field] ?? $field;

                if ($field === 'location' && $operator === 'IN') {
                    // OR across city/state/zip
                    $vals = is_array($value) ? $value : array_map('trim', explode(',', (string) $value));
                    $vals = array_filter($vals, fn ($v) => $v !== '');

                    if (!empty($vals)) {
                        $q->where(function ($q2) use ($vals) {
                            $q2->whereIn('property_city', $vals)
                               ->orWhereIn('property_state', $vals)
                               ->orWhereIn('property_zip', $vals);
                        });
                    }
                } elseif ($operator === 'IN') {
                    $vals = is_array($value) ? $value : array_map('trim', explode(',', (string) $value));
                    $vals = array_filter($vals, fn ($v) => $v !== '');
                    if (!empty($vals)) {
                        $q->whereIn($col, $vals);
                    }
                } elseif ($operator === 'BETWEEN' && is_array($value) && count($value) === 2) {
                    $q->whereBetween($col, [$value[0], $value[1]]);
                } else {
                    // Fallback to simple comparison
                    $q->where($col, $operator ?: '=', $value);
                }
            }
        });
    }
}
