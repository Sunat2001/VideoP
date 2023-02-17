<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\SerialControllers\AlreadySeenController;
use App\Http\Controllers\SerialControllers\SerialController;
use App\Http\Controllers\SerialControllers\SerialRecommendedController;
use Illuminate\Support\Facades\Route;

/**
 * Serial Routes
 */
Route::get('/top-serials', [SerialController::class, 'topSerials']);
Route::get('/serial/{serial}', [SerialController::class, 'serialById']);
Route::get('/serials/{season}', [SerialController::class, 'serialsBySeason']);
Route::get('/serials/season/{serial}', [SerialController::class, 'serialSeasons']);
Route::get('/serials/filter/{attributeValue}', [SerialController::class, 'serialByAttributeValue']);
Route::get('/recommendations', [SerialRecommendedController::class, 'recommendations'])->middleware('auth:api');

/**
 * Episode Routes
 */
Route::post('/watched/{id}', [AlreadySeenController::class, 'watched']);
Route::get('/watched', [AlreadySeenController::class, 'list']);
Route::get('/watched/{id}/season', [AlreadySeenController::class, 'listBySeason']);
Route::post('/watched/check/{id}', [AlreadySeenController::class, 'checkWatched']);

/**
 * Search Routes
 */
Route::post('/search', [SearchController::class, 'search']);
