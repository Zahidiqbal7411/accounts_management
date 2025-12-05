<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Account;
use App\Models\Product;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $services = Service::with(['account', 'product'])->latest()->get();
            return response()->json([
                'success' => true,
                'data' => $services,
                'service_statuses' => config('constants.service_status')
            ]);
        }

        // Get accounts and products for dropdowns
        $accounts = Account::all();
        $products = Product::all();
        $serviceStatuses = config('constants.service_status');

        return view('services.index', compact('accounts', 'products', 'serviceStatuses'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Service::with(['account', 'product'])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $service
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pro_id' => 'nullable|exists:acm_products,pro_id',
            'ac_id' => 'nullable|exists:acm_accounts,ac_id',
            'service_title' => 'required|string|max:255',
            'service_description' => 'nullable|string',
            'service_email' => 'nullable|email|max:255',
            'service_contact' => 'nullable|string|max:255',
            'pro_link' => 'nullable|string',
            'service_domain' => 'nullable|integer',
            'service_person' => 'nullable|string|max:45',
            'service_person_contact' => 'nullable|string|max:45',
            'service_person2' => 'nullable|string|max:45',
            'service_person2_contact' => 'nullable|string|max:45',
            'service_personemail' => 'nullable|string|max:45',
            'service_start_date' => 'required|date',
            'service_due_date' => 'required|date|after_or_equal:service_start_date',
            'service_status' => 'nullable|integer',
            'service_paid_status' => 'nullable|integer',
            'service_additional_detail' => 'nullable|string|max:255',
            'service_db' => 'nullable|string|max:100',
            'service_db_user' => 'nullable|string|max:100',
            'service_db_password' => 'nullable|string|max:100',
        ]);

        // Set defaults
        $validated['service_status'] = $validated['service_status'] ?? 1;
        $validated['service_paid_status'] = $validated['service_paid_status'] ?? 0;

        $service = Service::create($validated);
        $service->load(['account', 'product']);

        return response()->json([
            'success' => true,
            'message' => 'Service created successfully!',
            'data' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $validated = $request->validate([
            'pro_id' => 'nullable|exists:acm_products,pro_id',
            'ac_id' => 'nullable|exists:acm_accounts,ac_id',
            'service_title' => 'required|string|max:255',
            'service_description' => 'nullable|string',
            'service_email' => 'nullable|email|max:255',
            'service_contact' => 'nullable|string|max:255',
            'pro_link' => 'nullable|string',
            'service_domain' => 'nullable|integer',
            'service_person' => 'nullable|string|max:45',
            'service_person_contact' => 'nullable|string|max:45',
            'service_person2' => 'nullable|string|max:45',
            'service_person2_contact' => 'nullable|string|max:45',
            'service_personemail' => 'nullable|string|max:45',
            'service_start_date' => 'required|date',
            'service_due_date' => 'required|date|after_or_equal:service_start_date',
            'service_status' => 'nullable|integer',
            'service_paid_status' => 'nullable|integer',
            'service_additional_detail' => 'nullable|string|max:255',
            'service_db' => 'nullable|string|max:100',
            'service_db_user' => 'nullable|string|max:100',
            'service_db_password' => 'nullable|string|max:100',
        ]);

        $service->update($validated);
        $service->load(['account', 'product']);

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully!',
            'data' => $service
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully!'
        ]);
    }
}
