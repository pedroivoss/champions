<?php

use App\Http\Controllers\ChampionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ChampionsController::class)->group(function () {
    Route::get('/get_bets','getBets')->name('get.bets');
});
