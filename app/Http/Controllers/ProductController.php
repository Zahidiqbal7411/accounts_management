<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::latest()->get();
            return response()->json([
                'success' => true,
                'data' => $products,
                'pro_types' => config('constants.pro_type')
            ]);
        }

        $proTypes = config('constants.pro_type');
        return view('products.index', compact('proTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pro_title' => 'required|string|max:255',
            'pro_description' => 'nullable|string',
            'pro_expiry_date' => 'required|date',
            'pro_type' => 'nullable|integer|in:' . implode(',', array_keys(config('constants.pro_type'))),
        ]);

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully!',
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'pro_title' => 'required|string|max:255',
            'pro_description' => 'nullable|string',
            'pro_expiry_date' => 'required|date',
            'pro_type' => 'nullable|integer|in:' . implode(',', array_keys(config('constants.pro_type'))),
        ]);

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully!',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully!'
        ]);
    }
}

