<?php

namespace App\Enums;

enum ArticleStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case SCHEDULED = 'scheduled';

    public function getColor(): string
    {
        return match ($this) {
            self::DRAFT => 'info',
            self::SCHEDULED => 'warning',
            self::PUBLISHED => 'success'
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::SCHEDULED => 'Scheduled',
            self::PUBLISHED => 'Published'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::DRAFT => 'heroicon-o-clock',
            self::SCHEDULED => 'heroicon-o-calendar-days',
            self::PUBLISHED => 'heroicon-o-check-badge',
        };
    }
}
