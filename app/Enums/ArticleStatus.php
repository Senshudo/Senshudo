<?php

namespace App\Enums;

enum ArticleStatus: string
{
    case DRAFT = 'draft';
    case REVIEW = 'review';
    case PUBLISHED = 'published';
    case SCHEDULED = 'scheduled';

    public function getColor(): string
    {
        return match ($this) {
            self::DRAFT => 'info',
            self::REVIEW => 'warning',
            self::SCHEDULED => 'warning',
            self::PUBLISHED => 'success'
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::REVIEW => 'Ready For Review',
            self::SCHEDULED => 'Scheduled',
            self::PUBLISHED => 'Published'
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::DRAFT => 'heroicon-o-clock',
            self::REVIEW => 'heroicon-o-clipboard-check',
            self::SCHEDULED => 'heroicon-o-calendar-days',
            self::PUBLISHED => 'heroicon-o-check-badge',
        };
    }

    public static function toSelectOptions(): array
    {
        return [
            self::DRAFT->value => 'Draft',
            self::REVIEW->value => 'Ready For Review',
            self::SCHEDULED->value => 'Scheduled',
            self::PUBLISHED->value => 'Published',
        ];
    }
}
