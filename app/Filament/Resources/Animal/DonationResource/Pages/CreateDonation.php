<?php

namespace App\Filament\Resources\Animal\DonationResource\Pages;

use App\Filament\Resources\Animal\DonationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDonation extends CreateRecord
{
    protected static string $resource = DonationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
