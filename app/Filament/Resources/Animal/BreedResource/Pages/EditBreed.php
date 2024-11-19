<?php

namespace App\Filament\Resources\Animal\BreedResource\Pages;

use App\Filament\Resources\Animal\BreedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBreed extends EditRecord
{
    protected static string $resource = BreedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
