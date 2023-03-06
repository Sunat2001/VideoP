<?php

namespace App\Enum;

enum Languages
{
    public const RU = 'ru';
    public const EN = 'en';

    public static function getValues(): array
    {
        return [
            self::RU,
            self::EN,
        ];
    }
}
