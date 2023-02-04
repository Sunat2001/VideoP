<?php

use App\Http\Controllers\SerialControllers\SerialController;
use Illuminate\Support\Facades\Route;

Route::get('/top-serials', [SerialController::class, 'topSerials']);
Route::get('/serial/{serial}', [SerialController::class, 'serialById']);
Route::get('/serials/{season}', [SerialController::class, 'serialsBySeason']);
