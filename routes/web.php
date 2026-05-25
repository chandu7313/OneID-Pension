<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\PensionSchemeController;
use App\Http\Controllers\CitizenPensionController;
use App\Http\Controllers\SearchController;

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::resource('citizens', CitizenController::class);
Route::resource('pension-schemes', PensionSchemeController::class);
Route::resource('citizen-pensions', CitizenPensionController::class);
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
