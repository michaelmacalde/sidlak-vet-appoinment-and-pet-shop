<?php

namespace App\Filament\Resources\Animal\DonationResource\Pages;

use App\Filament\Resources\Animal\DonationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonation extends EditRecord
{
    protected static string $resource = DonationResource::class;

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
