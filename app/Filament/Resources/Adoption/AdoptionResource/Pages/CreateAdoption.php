<?php

namespace App\Filament\Resources\Adoption\AdoptionResource\Pages;

use App\Filament\Resources\Adoption\AdoptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdoption extends CreateRecord
{
    protected static string $resource = AdoptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function afterCreate(): void
    {
        $dogId = $this->record->dog_id;
        $adoptionStatus = $this->form->getState()['status'];

        if ($dogId && $adoptionStatus === "approved") {
            $this->record->dog?->query()->where('id', $dogId)->update(['status' => 'adopted']);
        }
    }
}
