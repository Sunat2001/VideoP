<?php

use App\Http\Controllers\Dashboard\AttributeController;
use App\Http\Controllers\Dashboard\AttributeValueController;
use App\Http\Controllers\Dashboard\FileController;
use App\Http\Controllers\Dashboard\ReviewController;
use App\Http\Controllers\Dashboard\SerialController;
use App\Http\Controllers\Dashboard\SerialEpisodeController;
use App\Http\Controllers\Dashboard\SerialEpisodeSeasonController;
use App\Http\Controllers\Dashboard\SerialEpisodeVideoController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\PHPConfController;
use Illuminate\Support\Facades\Route;

/**
* Dashboard routes
*/
Route::apiResource('serials', SerialController::class);
Route::apiResource('serial-episodes', SerialEpisodeController::class);
Route::apiResource('serial-episode-seasons', SerialEpisodeSeasonController::class);
Route::apiResource('serial-episode-videos', SerialEpisodeVideoController::class);
Route::apiResource('attributes', AttributeController::class);
Route::apiResource('attribute-values', AttributeValueController::class);
Route::apiResource('users', UserController::class)->except(['store', 'update']);
Route::post('/users/{user}/role', [UserController::class, 'changeRole']);
Route::apiResource('reviews', ReviewController::class)->except(['store', 'update']);
Route::post('/reviews/{review}/status', [ReviewController::class, 'changeStatus']);
Route::post('/reviews/{review}/best', [ReviewController::class, 'changeBest']);

/**
 * File Management Routes
 */
Route::post('/upload-video', [FileController::class, 'videoUploader']);
Route::post('/upload-image', [FileController::class, 'imageUploader']);


/**
 * PHP Configuration Routes
 */
Route::get('/php-info', [PHPConfController::class, 'php_info']);

