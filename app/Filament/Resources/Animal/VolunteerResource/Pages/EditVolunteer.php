<?php

namespace App\Filament\Resources\Animal\VolunteerResource\Pages;

use App\Enums\VolunteerStatusTypeEnum;
use App\Filament\Resources\Animal\VolunteerResource;
use App\Mail\VolunteerStatusUpdatedMail;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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

    protected function afterSave(): void
    {
        $volunteer = $this->record;

        if ($volunteer->wasChanged('volunteer_status_type')) {

            $getStatus = VolunteerStatusTypeEnum::tryFrom($volunteer->status_type);

            if ($getStatus === VolunteerStatusTypeEnum::APPROVED || $getStatus === VolunteerStatusTypeEnum::REJECTED) {
                Mail::to($volunteer->user->email)->send(new VolunteerStatusUpdatedMail($volunteer->user, $getStatus));
            }
        }
    }


}
