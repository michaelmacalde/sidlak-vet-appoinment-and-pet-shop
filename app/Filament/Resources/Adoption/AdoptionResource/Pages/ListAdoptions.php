<?php

namespace App\Filament\Resources\Adoption\AdoptionResource\Pages;

use App\Filament\Resources\Adoption\AdoptionResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListAdoptions extends ListRecords
{
    protected static string $resource = AdoptionResource::class;

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
            'Pending' => Tab::make()->query(fn ($query) => $query->where('status', 'pending')),
            'Approved' => Tab::make()->query(fn ($query) => $query->where('status', 'approved')),
            'Rejected' => Tab::make()->query(fn ($query) => $query->where('status', 'rejected')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return AdoptionResource::getWidgets();
    }
}
