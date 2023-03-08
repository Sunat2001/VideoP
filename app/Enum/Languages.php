<?php

namespace App\Enum;

enum Languages
{
    public const RU = 'ru';
    public const EN = 'en';

    public const DEFAULT = self::RU;

    public static function getValues(): array
    {
        return [
            self::RU,
            self::EN,
        ];
    }

    public static function getLabels(): array
    {
        return [
            self::RU => 'Русский',
            self::EN => 'English',
        ];
    }

    public static function getLabel(?string $value): string
    {
        return self::getLabels()[$value] ?? self::getLabels()[self::RU];
    }
}
