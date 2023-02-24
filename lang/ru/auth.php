<?php

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

return [
    'failed'   => 'Неверное имя пользователя или пароль.',
    'password' => 'Неверный пароль.',
    'throttle' => 'Слишком много попыток входа. Пожалуйста, попробуйте еще раз через :seconds секунд.',

    /**
     * Auth Messages
     */
    'messages' => [
        /**
         * Success messages
         */
        'success_login' => 'Вы успешно вошли в систему',
        'success_logout' => 'Вы успешно вышли из системы',
        'success_register' => 'Вы успешно зарегистрировались',
        'success_reset_password' => 'Вы успешно сбросили пароль',
        'success_otp_password' => 'Пароль можно изменить',
        'success_otp_sent' => 'OTP успешно отправлен',
        'success_register_otp' => 'Вы успешно зарегистрировались. Пожалуйста, проверьте свою электронную почту для OTP',

        /**
         * Error messages
         */
        'email_not_verified' => 'Ваш адрес электронной почты не подтвержден. Пожалуйста, проверьте свою электронную почту',
        'error_email_already_exists' => 'Электронная почта уже существует',
        'error_credentials' => 'Неверные учетные данные',
        'error_invalid_otp' => 'Неверный OTP',
        'error_expired_otp' => 'OTP истек',
        'error_confirm_otp_first' => 'Сначала подтвердите OTP',
        'error_user_not_fount' => 'Пользователь не найден',
        'error_otp_already_sent' => 'OTP уже отправлен',
    ]
];
