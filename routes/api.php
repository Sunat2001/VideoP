<?php

use App\Http\Controllers\Dashboard\AttributeController;
use App\Http\Controllers\Dashboard\AttributeValueController;
use App\Http\Controllers\Dashboard\SerialController;
use App\Http\Controllers\Dashboard\SerialEpisodeController;
use App\Http\Controllers\Dashboard\SerialEpisodeSeasonController;
use App\Http\Controllers\Dashboard\SerialEpisodeVideoController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * Dashboard routes
 */
Route::prefix('dashboard')->group(function () {
    Route::apiResource('serials', SerialController::class);
    Route::apiResource('serial-episodes', SerialEpisodeController::class);
    Route::apiResource('serial-episode-seasons', SerialEpisodeSeasonController::class);
    Route::apiResource('serial-episode-videos', SerialEpisodeVideoController::class);
    Route::apiResource('attributes', AttributeController::class);
    Route::apiResource('attribute-values', AttributeValueController::class);
    Route::apiResource('users', UserController::class)->except(['store', 'update']);
});

