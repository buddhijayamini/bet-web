<?php

namespace App\Http\Controllers;

use App\Models\GeneralWallet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class GeneralWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $generalWallet = $user->wallet;

        return view('general_wallet', compact('generalWallet'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'amount' => 'required|numeric'
            ]);

            // Start the database transaction
            DB::beginTransaction();

            $validatedData['users_id'] = Auth::user()->id;
            $validatedData['status'] = 'Added';

            GeneralWallet::create($validatedData);

            // Commit the transaction if everything is successful
            DB::commit();

            return redirect()->route('home')->with(['message' => 'Wallet created successfully']);
        } catch (Throwable $th) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Log the error or handle it in any other way
            return redirect()->back()->with(['error' => 'Failed to create general wallet', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralWallet $generalWallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralWallet $generalWallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeneralWallet $generalWallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneralWallet $generalWallet)
    {
        //
    }
}
