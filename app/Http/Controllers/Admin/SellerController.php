<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::latest()->get();
        return view('admin.sellers.index', compact('sellers'));
    }

    public function create()
    {
        // Empty model so blade can use isset($seller)
        return view('admin.sellers.form', ['seller' => new Seller()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        // Normalize checkbox (unchecked -> false)
        $data['balloon'] = $request->boolean('balloon');

        Seller::create($data);

        // If user is admin (has permission), go to admin list; otherwise, public thank-you
        if (auth()->check() && auth()->user()->can('view sellers')) {
            return redirect()
                ->route('admin.sellers.index')
                ->with('success', 'Seller added.');
        }

        return redirect()
            ->route('welcome')
            ->with('success', 'Thanks! Your property was submitted.');
    }

    public function edit(Seller $seller)
    {
        return view('admin.sellers.form', compact('seller'));
    }

    public function update(Request $request, Seller $seller)
    {
        $data = $this->validateData($request);
        $data['balloon'] = $request->boolean('balloon');

        $seller->update($data);

        return redirect()
            ->route('admin.sellers.index')
            ->with('success', 'Seller updated.');
    }

    public function destroy(Seller $seller)
    {
        $seller->delete();
        return back()->with('success', 'Seller deleted.');
    }

    /**
     * Shared validation rules for create/update.
     */
    protected function validateData(Request $r): array
    {
        return $r->validate([
            // Seller info
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'phone'  => 'nullable|string|max:50',

            // Address
            'property_address' => 'required|string|max:255',
            'property_city'    => 'required|string|max:100',
            'property_state'   => 'required|string|max:50',
            'property_zip'     => 'required|string|max:20',

            // Deal/core
            'deal_type'      => 'required|in:Cash,Subject-To,Seller-Finance,Hybrid',
            'asking_price'   => 'required|integer|min:0',
            'bedrooms'       => 'nullable|integer|min:0',
            'bathrooms'      => 'nullable|numeric|min:0',
            'square_footage' => 'nullable|integer|min:0',

            // ROI / costs
            'arv'                          => 'nullable|integer|min:0',
            'estimated_repairs'            => 'nullable|integer|min:0',
            'back_taxes'                   => 'nullable|integer|min:0',
            'title_liens'                  => 'nullable|integer|min:0',
            'closing_costs'                => 'nullable|integer|min:0',
            'transaction_coordinator_fees' => 'nullable|integer|min:0',

            // Creative
            'mortgage_balance'            => 'nullable|integer|min:0',
            'monthly_piti'                => 'nullable|integer|min:0',
            'arrears'                     => 'nullable|integer|min:0',
            'cash_to_seller'              => 'nullable|integer|min:0',
            'down_payment'                => 'nullable|integer|min:0',
            'monthly_payment_to_seller'   => 'nullable|integer|min:0',
            'interest_rate'               => 'nullable|numeric|min:0',
            'term_length'                 => 'nullable|integer|min:0',
            'balloon'                     => 'sometimes|boolean',
            'balloon_years'               => 'nullable|integer|min:0',

            // Extra
            'additional_details' => 'nullable|string',
        ]);
    }
}
