<x-mail::message>
    # Добро пожаловать на наш сайт!

    Ваш OTP: {{$otp}}

    [VID] {{config('app.url')}}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
