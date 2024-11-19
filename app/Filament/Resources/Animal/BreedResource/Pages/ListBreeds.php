<?php

namespace App\Filament\Resources\Animal\BreedResource\Pages;

use App\Filament\Resources\Animal\BreedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBreeds extends ListRecords
{
    protected static string $resource = BreedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-m-plus'),
        ];
    }
}
