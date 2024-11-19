<?php

namespace App\Filament\Resources\Animal\DogResource\Pages;

use App\Filament\Resources\Animal\DogResource;
use App\Filament\Resources\Animal\DogResource\Widgets\DogStatsOverview;
use Filament\Actions;
use Filament\Forms\Components\Builder;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListDogs extends ListRecords
{

    protected static string $resource = DogResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-m-plus'),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'Available' => Tab::make()->query(fn ($query) => $query->where('status', 'available')),
            'Adopted' => Tab::make()->query(fn ($query) => $query->where('status', 'adopted')),
            'Foster' => Tab::make()->query(fn ($query) => $query->where('status', 'foster')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return DogResource::getWidgets();
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['dog_gender'] = ucfirst($data['dog_gender']);
        $data['dog_size'] = ucfirst($data['dog_size']);

        return $data;
    }
}
