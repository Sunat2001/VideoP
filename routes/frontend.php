<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\SerialControllers\AlreadySeenController;
use App\Http\Controllers\SerialControllers\SerialController;
use Illuminate\Support\Facades\Route;

/**
 * Serial Routes
 */
Route::get('/top-serials', [SerialController::class, 'topSerials']);
Route::get('/serial/{serial}', [SerialController::class, 'serialById']);
Route::get('/serials/{season}', [SerialController::class, 'serialsBySeason']);
Route::get('/serials/filter/{attributeValue}', [SerialController::class, 'serialByAttributeValue']);

/**
 * Episode Routes
 */
Route::get('/watched/{id}', [AlreadySeenController::class, 'watched']);
Route::get('/watched', [AlreadySeenController::class, 'list']);
Route::get('/watched/{id}/season', [AlreadySeenController::class, 'listBySeason']);

/**
 * Search Routes
 */
Route::post('/search', [SearchController::class, 'search']);
