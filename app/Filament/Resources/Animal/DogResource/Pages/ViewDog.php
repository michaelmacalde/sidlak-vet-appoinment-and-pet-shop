<?php

namespace App\Filament\Resources\Animal\DogResource\Pages;

use App\Filament\Resources\Animal\DogResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewDog extends ViewRecord
{
    protected static string $resource = DogResource::class;

    protected static ?string $recordTitleAttribute = 'dog_name';

    public function getTitle(): string | Htmlable
    {
        /** @var Dog */
        $record = $this->getRecord();
        return $record->dog_name . ' - ' . $record->breed->breed_name;
    }

    protected function getActions(): array
    {
        return [];
    }
}
