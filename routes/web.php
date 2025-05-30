<?php

use App\Http\Controllers\ApostasController;
use App\Http\Controllers\ChampionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::controller(ChampionsController::class)->group(function () {
    Route::get('/get_bets','getBets')->name('get.bets');
    Route::post('/submit_bet','submitBet')->name('submit.bet');
});

Route::controller(ApostasController::class)->group(function () {
    Route::get('/admin/apostas','adminApostas')->name('admin.apostas');
});
