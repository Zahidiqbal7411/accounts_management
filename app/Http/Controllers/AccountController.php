<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $accounts = Account::all();
            return response()->json([
                'success' => true,
                'data' => $accounts
            ]);
        }

        return view('accounts.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ac_title' => 'required|string|max:255',
            'ac_owner' => 'required|string|max:45',
            'ac_contact' => 'required|string|max:45',
        ]);

        $account = Account::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Account created successfully!',
            'data' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        
        $validated = $request->validate([
            'ac_title' => 'required|string|max:255',
            'ac_owner' => 'required|string|max:45',
            'ac_contact' => 'required|string|max:45',
        ]);

        $account->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Account updated successfully!',
            'data' => $account
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return response()->json([
            'success' => true,
            'message' => 'Account deleted successfully!'
        ]);
    }
}
