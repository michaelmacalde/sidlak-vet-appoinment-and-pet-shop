<?php

namespace App\Filament\Resources\Adoption\AdoptionResource\Pages;

use App\Enums\AdoptionEnum;
use App\Filament\Resources\Adoption\AdoptionResource;
use App\Mail\AdoptionStatusUpdatedMail;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class EditAdoption extends EditRecord
{
    protected static string $resource = AdoptionResource::class;
    protected $oldDogId;
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


    protected function handleRecordUpdate(Model $record, array $data): Model
    {
       $this->oldDogId =  $this->record->getOriginal('dog_id');
        $newId = $data['dog_id'];

        if($this->oldDogId !== $newId){
            $record->dog->where('id', $this->oldDogId )->update(['status' => 'available']);
        }

        // Determine the new status for the dog and update it
        $current_status = $this->determineDogStatus($data['status']);
        $record->dog->update(['status' => $current_status]);

        // Update the record with the new data (if necessary)
        $record->fill($data);
        $record->save();

        // Return the updated record
        return $record;

    }


    /**
     * Determine the dog's status based on the adoption status.
     *
     * @param string $adoptionStatus
     * @return string
     */
    protected function determineDogStatus(string $adoptionStatus): string
    {
        switch ($adoptionStatus) {
            case AdoptionEnum::APPROVED->value:
                return 'adopted';
            case AdoptionEnum::PENDING->value:
            case AdoptionEnum::REJECTED->value:
            default:
                return 'available';
        }
    }

    protected function afterSave(): void
    {
        $adoption = $this->record;

        if ($adoption->wasChanged('status')) {

            $getStatus = AdoptionEnum::tryFrom($adoption->status);

            if ($getStatus === AdoptionEnum::APPROVED || $getStatus === AdoptionEnum::REJECTED) {
                Mail::to($adoption->user->email)->send(new AdoptionStatusUpdatedMail($adoption->user, $getStatus, $adoption->user_id));
            }
        }
    }

}
