<?php

namespace App\Filament\Resources\Animal\VolunteerResource\Pages;

use App\Filament\Resources\Animal\VolunteerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditVolunteer extends EditRecord
{
    protected static string $resource = VolunteerResource::class;

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
