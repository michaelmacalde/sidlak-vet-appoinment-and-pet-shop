<?php

namespace App\Enums;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatusEnum: string implements HasColor, HasLabel, HasIcon
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Failed = 'failed';
    case Refunded = 'refunded';

    public function getColor(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Completed => 'success',
            self::Failed => 'danger',
            self::Refunded => 'danger',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Completed => 'Completed',
            self::Failed => 'Failed',
            self::Refunded => 'Refunded',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Pending => 'heroicon-m-clock',
            self::Completed => 'heroicon-m-check-badge',
            self::Failed => 'heroicon-m-x-circle',
            self::Refunded => 'heroicon-m-x-circle',
        };
    }
}
