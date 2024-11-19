<?php

namespace App\Filament\Resources\Animal\VolunteerResource\Pages;

use App\Filament\Resources\Animal\VolunteerResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListVolunteers extends ListRecords
{
    protected static string $resource = VolunteerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-o-plus'),
        ];
    }


    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'Dog Walking' => Tab::make()->query(fn ($query) => $query->where('role', 'dog_walking')),
            'Event Assistant' => Tab::make()->query(fn ($query) => $query->where('role', 'event_assistant')),
            'Admin Support' => Tab::make()->query(fn ($query) => $query->where('role', 'admin_support')),
            'Community Outreach' => Tab::make()->query(fn ($query) => $query->where('role', 'community_outreach')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return VolunteerResource::getWidgets();
    }

}
