<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Seller;

class MatchingController extends Controller
{
    /**
     * List all buyers with ≥1 matching seller.
     */
    public function pending()
    {
        $buyers = Buyer::with('criteria')->get()
            ->map(function($buyer){
                // how many sellers match *all* criteria?
                $count = Seller::matching($buyer->criteria)->count();
                $buyer->match_count      = $count;
                $buyer->matched_sellers  = $count
                    ? Seller::matching($buyer->criteria)->get()
                    : collect();
                return $buyer;
            })
            ->filter(fn($b) => $b->match_count > 0);

        return view('admin.matchings.pending', compact('buyers'));
    }

    /**
     * Detail page: which sellers match and which criteria did they hit.
     */
    public function show(Buyer $buyer)
    {
        $buyer->load('criteria');
        $sellers = Seller::matching($buyer->criteria)->get();

        $matches = $sellers->mapWithKeys(function($s) use($buyer){
            $hit = [];
            foreach ($buyer->criteria as $c) {
                // reuse the same mapping logic
                $col = [
                    'location'       => 'property_city',
                    'price'          => 'asking_price',
                    'property_type'  => 'property_type',
                    'bedrooms'       => 'bedrooms',
                    'bathrooms'      => 'bathrooms',
                    'square_footage' => 'square_footage',
                ][$c->field] ?? $c->field;

                $lhs = data_get($s, $col);
                $rhs = $c->value;
                switch(strtoupper($c->operator)) {
                    case '>=': if($lhs >= $rhs) $hit[] = "{$c->field} ≥ {$rhs}"; break;
                    case '<=': if($lhs <= $rhs) $hit[] = "{$c->field} ≤ {$rhs}"; break;
                    case '=':  if($lhs == $rhs) $hit[] = "{$c->field} = {$rhs}"; break;
                    case 'IN':
                        $vals = array_map('trim', explode(',', $rhs));
                        if(in_array($lhs,$vals)) $hit[] = "{$c->field} ∈ ({$rhs})";
                        break;
                }
            }
            return [$s->id => ['seller'=>$s,'matched'=>$hit]];
        });

        return view('admin.matchings.show', compact('buyer','matches'));
    }
}
