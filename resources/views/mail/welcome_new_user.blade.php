@component('mail::message')
    Добро пожаловать на наш сайт!

    Ваш OTP: {{$otp}}

    [VID] {{config('app.url')}}

    Спасибо
    {{ config('app.name') }}
@endcomponent
