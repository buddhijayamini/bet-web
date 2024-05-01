<?php

namespace App\Http\Controllers;

use App\Models\GameWallet;
use App\Http\Controllers\Controller;
use App\Models\GeneralWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class GameWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $generalWallet = $user->wallet->amount ?? 0;
        $gameWallet = $user->gameWallet()->sum('amount') ?? 0;

        return view('game_wallet', compact('generalWallet', 'gameWallet'));
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

            // Check if the balance in the general wallet is higher than the amount being added to the game wallet
            $user = Auth::user();
            $generalWalletBalance = $user->wallet->amount;

            $amountToAdd = $validatedData['amount'];

            if ($generalWalletBalance < $amountToAdd) {
                throw new \Exception('Insufficient balance in the general wallet.');
            } else {
                // If the balance in the general wallet is sufficient, proceed to create the game wallet record
                $gameWalletData = [
                    'users_id' => $user->id,
                    'amount' => $amountToAdd,
                    'status' => 'Added'
                ];

                GameWallet::create($gameWalletData);
                $balance = $generalWalletBalance - $amountToAdd;
                GeneralWallet::where('users_id', $user->id)->update([
                    'amount' => $balance,
                    'status' => 'Transfered'
                ]);
            }

            // Commit the transaction if everything is successful
            DB::commit();

            return redirect()->route('home')->with(['message' => 'Game Wallet created successfully']);
        } catch (Throwable $th) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Log the error or handle it in any other way
            return redirect()->back()->with(['error' => 'Failed to create Game wallet', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GameWallet $gameWallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GameWallet $gameWallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GameWallet $gameWallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameWallet $gameWallet)
    {
        //
    }
}
