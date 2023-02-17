<x-mail::message>
# Вы сделали запрос на сброс пароля на сайте {{ config('app.name') }}.

    Ваш OTP: {{$otp}}

    [VID] {{config('app.url')}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
