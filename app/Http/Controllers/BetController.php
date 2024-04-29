<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Http\Controllers\Controller;
use App\Models\BetUser;
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
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

            // Start the database transaction
            DB::beginTransaction();

            $data['users_id'] = Auth::user()->id;
            $data['bets_id'] = $id;
            $data['status'] = 'Voted';
            $data['color'] =  $validatedData['action'];
            $data['amount'] =  $validatedData['amount'];

            // Create a new bet record using create()
            $bet = BetUser::create($data);

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
