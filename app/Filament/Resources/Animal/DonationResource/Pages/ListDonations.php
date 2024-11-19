<?php

namespace App\Filament\Resources\Animal\DonationResource\Pages;

use App\Filament\Resources\Animal\DonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-m-plus'),
        ];
    }
}
