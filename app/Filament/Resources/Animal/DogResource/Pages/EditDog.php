<?php

namespace App\Filament\Resources\Animal\DogResource\Pages;

use App\Enums\DogEnum;
use App\Filament\Resources\Animal\DogResource;
use App\Models\Adoption\Adoption;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditDog extends EditRecord
{
    protected static string $resource = DogResource::class;

    protected static ?string $recordTitleAttribute = 'dog_name';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        /** @var Dog */
        $record = $this->getRecord();
        return 'Edit (' .  $record->dog_name . ' - ' . $record->breed->breed_name . ') Record';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        $dogId = $record->id; //kwa id sang ido
        $adoptionStatus = $data['status']; //kwa sang current state sng status
        $dogExists = $record->adoption?->query()->where('dog_id', $dogId)->exists();
        $determineAdoptionStatus = $this->determineAdoptionStatus($adoptionStatus);

        if (!$dogExists && $adoptionStatus != "available" && $determineAdoptionStatus != "pending") {
            Notification::make()
                ->title('Cannot change adoption status.')
                ->body('Adopter of ' . $data['dog_name'] . ' is not exists. ')
                ->icon('heroicon-o-x-circle')
                ->iconColor('danger')
                ->color('danger')
                ->send();
                $this->redirect(DogResource::getUrl('index'));
                $this->halt();
        }

        !$dogExists ?
        $record->update($data) :
        $record->adoption->update(['status' => $determineAdoptionStatus]);

        $record->fill($data);
        $record->save();

        return $record;

    }

    /**
     * Determine the dog's status based on the adoption status.
     *
     * @param string $adoptionStatus
     * @return string
     */
    protected function determineAdoptionStatus(string $adoptionStatus): string
    {
        switch ($adoptionStatus) {
            case DogEnum::Available->value:
                return 'pending';
            case DogEnum::Adopted->value:
            case DogEnum::Foster->value:
            default:
                return 'approved';
        }
    }
}
