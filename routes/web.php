<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SerialController;
use App\Http\Controllers\SerialEpisodeController;
use App\Http\Controllers\SerialSeasonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('about', 'about')->name('about');

    Route::resource('users', UserController::class)->except(['destroy', 'update']);
    Route::post('users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/update/{user}', [UserController::class, 'update'])->name('users.update');

    Route::resource('serials', SerialController::class)->except(['destroy', 'update']);
    Route::post('serials/delete/{serial}', [SerialController::class, 'destroy'])->name('serials.destroy');
    Route::post('serials/update/{serial}', [SerialController::class, 'update'])->name('serials.update');

    Route::resource('serials_episodes', SerialEpisodeController::class)->except(['destroy', 'update']);
    Route::post('serials_episodes/delete/{episode}', [SerialEpisodeController::class, 'destroy'])->name('serials_episodes.destroy');
    Route::post('serials_episodes/update/{episode}', [SerialEpisodeController::class, 'update'])->name('serials_episodes.update');

    Route::resource('serials_seasons', SerialSeasonController::class)->except(['destroy', 'update']);
    Route::post('serials_seasons/delete/{serials_season}', [SerialSeasonController::class, 'destroy'])->name('serials_seasons.destroy');
    Route::post('serials_seasons/update/{serials_season}', [SerialSeasonController::class, 'update'])->name('serials_seasons.update');

    Route::resource('reviews', ReviewController::class)->except(['destroy']);
    Route::post('reviews/delete/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('reviews/change-status/{review}', [ReviewController::class, 'changeStatus'])->name('reviews.change-status');
    Route::post('reviews/change-best/{review}', [ReviewController::class, 'changeBest'])->name('reviews.change-best');

    Route::resource('attributes', AttributeController::class)->except(['destroy', 'update']);
    Route::post('attributes/delete/{attribute}', [AttributeController::class, 'destroy'])->name('attributes.destroy');
    Route::post('attributes/update/{attribute}', [AttributeController::class, 'update'])->name('attributes.update');
    Route::post('attributes/change-status/{attribute}', [AttributeController::class, 'changeActive'])->name('attributes.change-status');

    Route::resource('attribute-values', AttributeValueController::class)->except(['destroy', 'update']);
    Route::post('attribute-values/delete/{attribute_value}', [AttributeValueController::class, 'destroy'])->name('attribute-values.destroy');
    Route::post('attribute-values/update/{attribute_value}', [AttributeValueController::class, 'update'])->name('attribute-values.update');
    Route::post('attribute-values/change-status/{attribute_value}', [AttributeValueController::class, 'changeActive'])->name('attribute-values.change-status');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});
