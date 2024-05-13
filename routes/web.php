<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, "index"])->name('dashboard');
Route::get('/country-competions', [HomeController::class, "countryCompetitions"])->name('countryCompetitions');
Route::get('/country-competions-detail/{countryId}', [HomeController::class, "countryCompetitionsDetail"])->name('countryCompetitionsDetail');
Route::get('/country-competions-standings/{leagueId}', [HomeController::class, "countryCompetitionsStandings"])->name('countryCompetitionsStandings');
