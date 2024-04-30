<?php

use App\Http\Controllers\BetController;
use App\Http\Controllers\GameWalletController;
use App\Http\Controllers\GeneralWalletController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/create-bet', [BetController::class, 'index'])->name('create.bet');
Route::post('/store-bet', [BetController::class, 'store'])->name('store.bet');
Route::post('/bet-vote/{id}', [BetController::class, 'voteBet'])->name('bet.vote');

Route::get('/wallet', [GeneralWalletController::class, 'index'])->name('wallet');
Route::post('/topup-wallet', [GeneralWalletController::class, 'store'])->name('topup.wallet');

Route::get('/game-wallet', [GameWalletController::class, 'index'])->name('game.wallet');
Route::post('/topup-game', [GameWalletController::class, 'store'])->name('topup.game');





