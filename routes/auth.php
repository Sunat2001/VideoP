<?php

use App\Http\Controllers\API\Auth\OtpController;
use App\Http\Controllers\API\Auth\PasswordResetController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/password/reset', [PasswordResetController::class, 'reset']);
Route::post('/password/send-otp', [PasswordResetController::class, 'sendOtp']);

/**
 * Otp
 */
Route::post('/otp', [OtpController::class, 'checkOtp']);
Route::post('/otp/password/reset', [OtpController::class, 'otpResetPassword']);
