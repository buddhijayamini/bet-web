<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Http\Controllers\Controller;
use App\Models\BetUser;
use App\Models\GameWallet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class BetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('create_bet');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'round' => 'required|numeric',
                'time_per_round' => 'required|date_format:i:s',
                'date' => 'required|date',
            ]);

            // Start the database transaction
            DB::beginTransaction();

            $validatedData['users_id'] = Auth::user()->id;
            $validatedData['status'] = 'Created';

            // Create a new bet record using create()
            $bet = Bet::create($validatedData);

            // Commit the transaction if everything is successful
            DB::commit();

            return redirect()->route('home')->with(['message' => 'Bet created successfully', 'bet' => $bet]);
        } catch (Throwable $th) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Log the error or handle it in any other way
            return redirect()->back()->with(['error' => 'Failed to create bet', 'message' => $th->getMessage()]);
        }
    }

    public function voteBet($id, Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'action' => 'required|string',
                'amount' => 'required|numeric',
            ]);

            $user = Auth::user();
            $admin = User::find(1);
            $amount =  $validatedData['amount'];

            // Retrieve the user's game wallet
            $userWallet = $user->gameWallet()->first();
            $adminWallet = $admin->wallet()->first();

            if($adminWallet->amount < $amount){
                throw new \Exception('Insufficient balance in the admin wallet.');
            }

            // Start the database transaction
            DB::beginTransaction();

            if ($userWallet && $amount < $userWallet->amount) {
                $data['users_id'] = $user->id;
                $data['bets_id'] = $id;
                $data['status'] = 'Voted';
                $data['color'] =  $validatedData['action'];
                $data['amount'] = $amount;

                // Create a new bet record using create()
                $bet = BetUser::create($data);

                GameWallet::create([
                    'users_id' => $user->id,
                    'amount' => - $amount,
                    'status' => 'Betted'
                ]);

            } else {
                return redirect()->route('home')->with(['error' => 'Failed to create bet', 'message' => 'Not enough amount in Wallet']);
            }

            // Commit the transaction if everything is successful
            DB::commit();

            return redirect()->route('home')->with(['message' => 'Bet created successfully', 'bet' => $bet]);
        } catch (Throwable $th) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Log the error or handle it in any other way
            return redirect()->back()->with(['error' => 'Failed to create bet', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bet $bet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bet $bet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bet $bet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bet $bet)
    {
        //
    }
}
