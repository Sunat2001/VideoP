<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SerialController;
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

//    Route::get('users', [UserController::class, 'index'])->name('users.index');
//    Route::post('users', [UserController::class, 'store'])->name('users.store');
//    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
//    Route::get('users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
//    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::resource('users', UserController::class)->except(['destroy', 'update']);
    Route::post('users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/update/{user}', [UserController::class, 'update'])->name('users.update');

    Route::resource('serials', SerialController::class)->except(['destroy', 'update']);
    Route::post('serials/delete/{serial}', [SerialController::class, 'destroy'])->name('serials.destroy');
    Route::post('serials/update/{serial}', [SerialController::class, 'update'])->name('serials.update');

    Route::resource('reviews', ReviewController::class);

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});
