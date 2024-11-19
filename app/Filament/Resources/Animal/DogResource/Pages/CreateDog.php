<?php

namespace App\Filament\Resources\Animal\DogResource\Pages;

use App\Filament\Resources\Animal\DogResource;
use App\Models\Adoption\Adoption;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateDog extends CreateRecord
{
    use HasWizard;

    protected static string $resource = DogResource::class;

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make($this->getSteps())
                    ->startOnStep($this->getStartStep())
                    ->cancelAction($this->getCancelFormAction())
                    ->submitAction($this->getSubmitFormAction())
                    ->skippable($this->hasSkippableSteps())
                    ->contained(false),
            ])
            ->columns(null);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $dogId = $this->record->dog_id;
        if ($dogId) {
           $this->record->adoption?->query()->where('id', $dogId)->update(['status' => 'pending']);
        }
    }


     /** @return Step[] */
     protected function getSteps(): array
     {
         return [
             Step::make('Dog Details')
                ->icon('heroicon-o-information-circle')
                 ->schema([
                     Section::make()->schema(DogResource::getDetailsFormSchema())->columns(),
                 ]),

             Step::make('Medical Records')
                 ->icon('heroicon-o-clipboard-document-list')
                 ->schema([
                     Section::make()->schema([
                        DogResource::getItemsRepeater(),
                     ]),
                 ]),

            Step::make('Photos')
                ->icon('heroicon-o-photo')
                ->schema([
                    Section::make()->schema([
                        DogResource::getDogImagesRepeater(),
                    ]),
                ]),
         ];
     }
}
