<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $bet = Bet::where('status', 'Created')->where('date', $today)->first();
        return view('home', compact('bet'));
    }
}
