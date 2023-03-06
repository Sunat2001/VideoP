<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    /**
     * Auth Messages
     */
    'messages' => [
        /**
         * Success messages
         */
        'success_login' => 'You have successfully logged in',
        'success_logout' => 'You have successfully logged out',
        'success_register' => 'You have successfully registered',
        'success_reset_password' => 'You have successfully reset your password',
        'success_otp_password' => 'Password can be changed',
        'success_otp_sent' => 'OTP sent successfully',
        'success_register_otp' => 'You have successfully registered. Please check your email for OTP',

        /**
         * Error messages
         */
        'email_not_verified' => 'Your email is not verified. Please check your email',
        'error_email_already_exists' => 'Email already exists',
        'error_credentials' => 'Invalid credentials',
        'error_invalid_otp' => 'Invalid OTP',
        'error_expired_otp' => 'OTP expired',
        'error_confirm_otp_first' => 'Confirm otp first',
        'error_user_not_fount' => 'User not found',
        'error_otp_already_sent' => 'OTP already sent',
    ],
];
