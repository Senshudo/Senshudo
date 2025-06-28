<?php

namespace App\Enums;

enum ArticleApprovalStatus: string {
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::APPROVED => 'success',
            self::REJECTED => 'danger',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::PENDING => 'fa-clock',
            self::APPROVED => 'fa-check',
            self::REJECTED => 'fa-times',
        };
    }

    public static function toSelectOptions(): array
    {
        return [
            self::PENDING->value => self::PENDING->getLabel(),
            self::APPROVED->value => self::APPROVED->getLabel(),
            self::REJECTED->value => self::REJECTED->getLabel(),
        ];
    }
}
