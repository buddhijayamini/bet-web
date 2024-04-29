<?php

use App\Http\Controllers\BetController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/create-bet', [BetController::class, 'index'])->name('create.bet');
Route::post('/store-bet', [BetController::class, 'store'])->name('store.bet');
Route::post('/bet-vote/{id}', [BetController::class, 'voteBet'])->name('bet.vote');



