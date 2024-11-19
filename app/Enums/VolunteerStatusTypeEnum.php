<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum VolunteerStatusTypeEnum: string implements HasIcon, HasColor
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING => 'heroicon-m-clock',
            self::APPROVED => 'heroicon-m-hand-thumb-up',
            self::REJECTED => 'heroicon-m-x-circle',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PENDING => 'primary',
            self::APPROVED => 'success',
            self::REJECTED => 'danger',
        };
    }
}

