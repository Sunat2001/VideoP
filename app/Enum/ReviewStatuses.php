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
            self::ON_MODERATION => __('dashboard.review.on_moderation'),
            self::APPROVED => __('dashboard.review.pass_moderation'),
            self::REJECTED => __('dashboard.review.rejected'),
        ];
    }

    public static function getModerationStatuses(): array
    {
        return [
            self::APPROVED,
            self::REJECTED,
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
