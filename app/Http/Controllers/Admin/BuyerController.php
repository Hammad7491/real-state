<?php
// app/Http/Controllers/Admin/BuyerController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::withCount('criteria')->latest()->get();
        return view('admin.buyers.index', compact('buyers'));
    }

    public function create()
    {
        $buyer = new Buyer;
        $buyer->loadMissing('criteria');
        return view('admin.buyers.create', compact('buyer'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request, null);
        $buyer = Buyer::create($data);
        foreach ($data['criteria'] as $rule) {
            $buyer->criteria()->create($rule);
        }

        return redirect()->route('admin.buyers.index')
                         ->with('success','Buyer created.');
    }

    public function edit(Buyer $buyer)
    {
        $buyer->load('criteria');
        return view('admin.buyers.create', compact('buyer'));
    }

    public function update(Request $request, Buyer $buyer)
    {
        $data = $this->validateData($request, $buyer->id);
        $buyer->update($data);
        $buyer->criteria()->delete();
        foreach ($data['criteria'] as $rule) {
            $buyer->criteria()->create($rule);
        }

        return redirect()->route('admin.buyers.index')
                         ->with('success','Buyer updated.');
    }

    public function destroy(Buyer $buyer)
    {
        $buyer->delete();
        return redirect()->route('admin.buyers.index')
                         ->with('success','Buyer deleted.');
    }

    protected function validateData(Request $r, $ignoreId = null)
    {
        return $r->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|unique:buyers,email'.($ignoreId?"," . $ignoreId:""),
            'phone'               => 'nullable|string|max:50',
            'notes'               => 'nullable|string',
            'criteria'            => 'required|array|min:1',
            'criteria.*.field'    => 'required|string',
            'criteria.*.operator' => 'required|string',
            'criteria.*.value'    => 'required|string',
            'criteria.*.weight'   => 'required|integer|min:1|max:10',
        ]);
    }
}
