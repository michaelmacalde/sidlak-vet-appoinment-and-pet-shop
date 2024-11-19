<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum DogEnum: string implements HasIcon, HasColor
{
    case Available = 'available';
    case Adopted = 'adopted';
    case Foster = 'foster';

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Available => 'heroicon-m-check-circle',
            self::Adopted => 'heroicon-m-heart',
            self::Foster => 'heroicon-m-hand-thumb-up',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Available => 'success',
            self::Adopted => 'danger',
            self::Foster => 'warning',
        };
    }
}

