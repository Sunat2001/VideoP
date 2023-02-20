<?php
namespace App\Enum;

enum ReviewStatuses
{
    public const ON_MODERATION = 'on_moderation';
    public const APPROVED = 'approved';
    public const REJECTED = 'rejected';

    public static function getLabels(): array
    {
        return [
            self::ON_MODERATION => 'На модерации',
            self::APPROVED => 'Опубликовано',
            self::REJECTED => 'Отклонено',
        ];
    }

    public static function getLabel(string $value): string
    {
        return self::getLabels()[$value];
    }

    public static function getValues(): array
    {
        return [
            self::ON_MODERATION,
            self::APPROVED,
            self::REJECTED,
        ];
    }
}
