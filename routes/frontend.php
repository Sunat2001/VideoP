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
Route::prefix('/watched')->middleware('auth:api')->group(static function () {
    Route::post('/{id}', [AlreadySeenController::class, 'watched']);
    Route::get('/', [AlreadySeenController::class, 'list']);
    Route::get('/{id}/season', [AlreadySeenController::class, 'listBySeason']);
    Route::post('/check/{id}', [AlreadySeenController::class, 'checkWatched']);
});

/**
 * Review Routes
 */
Route::prefix('/review')->middleware('auth:api')->group(static function () {
    Route::post('/', [SerialController::class, 'addReview']);
    Route::post('/vote/{review}', [SerialController::class, 'voteReview']);
});


/**
 * Search Routes
 */
Route::post('/search', [SearchController::class, 'search']);
