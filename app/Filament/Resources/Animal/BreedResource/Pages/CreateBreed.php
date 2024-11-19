<?php

namespace App\Filament\Resources\Animal\BreedResource\Pages;

use App\Filament\Resources\Animal\BreedResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBreed extends CreateRecord
{
    protected static string $resource = BreedResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
