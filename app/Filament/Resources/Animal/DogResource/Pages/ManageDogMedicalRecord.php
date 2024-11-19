<?php

namespace App\Filament\Resources\Animal\DogResource\Pages;

use App\Filament\Resources\Animal\DogResource;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageDogMedicalRecord extends ManageRelatedRecords
{

    protected static string $resource = DogResource::class;

    protected static string $relationship = 'medicalRecords';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public function getTitle(): string | Htmlable
    {
        /** @var Dog */
        $record = $this->getRecord();
        return '(' .  $record->dog_name . ' - ' . $record->breed->breed_name . ') Medical Record';
    }

    public static function getNavigationLabel(): string
    {
        return 'Medical Records';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               TextInput::make('vet_name')
                    ->placeholder('Name of veterinarian')
                    ->required()
                    ->maxLength(255),

                TextInput::make('record_type')
                    ->placeholder('Type of medical record (e.g., vaccination, check-up)')
                    ->required()
                    ->maxLength(255),

                TextInput::make('vet_contact')
                    ->placeholder('Veterinarian contact number')
                    ->tel()
                    ->telRegex('((^(\+)(\d){12}$)|(^\d{11}$))')
                    ->required()
                    ->maxLength(255),

                TextInput::make('cost')
                    ->placeholder('Cost')
                    ->numeric()
                    ->minValue(0),



                DatePicker::make('record_date')
                    ->placeholder('Record date')
                    ->required()
                    ->default(now())
                    ->native(false),

                DatePicker::make('next_appointment')
                    ->required()
                    ->label('Next appointment date')
                    ->placeholder('Next appointment date')
                    ->default(now())
                    ->native(false),

                RichEditor::make('description')
                    ->placeholder('Description of the medical record')
                    ->maxLength(65535)->columnSpanFull(),

                RichEditor::make('medications')
                    ->placeholder('Medications prescribed')
                    ->maxLength(65535)->columnSpanFull(),

                Textarea::make('description')
                    ->placeholder('Additional notes')
                    ->rows(6)
                    ->maxLength(65535)->columnSpanFull()


            ])->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 2
              ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('dog_id')
            ->columns([
                Tables\Columns\TextColumn::make('vet_name')->weight('bold')
                ->description(fn (Model $record) => $record->vet_contact),
                Tables\Columns\TextColumn::make('record_type')
                ->description(fn (Model $record) => $record->medications),
                Tables\Columns\TextColumn::make('description')
                ->markdown()
                ->wrap()
                ->limit(100),
                Tables\Columns\TextColumn::make('record_date'),
                Tables\Columns\TextColumn::make('next_appointment')->placeholder('N/A'),
                Tables\Columns\TextColumn::make('cost')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('notes')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
               ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DissociateAction::make(),
                Tables\Actions\DeleteAction::make(),
               ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
              Section::make()->schema([
                TextEntry::make('record_date')->label('Record Date'),
                TextEntry::make('next_appointment')->label('Next Appointment Date')->badge()->color('primay')->placeholder('N/A'),
                TextEntry::make('vet_name')->label('Veterinarian Name')->size('bold')->badge()->color('success'),
                TextEntry::make('vet_contact')->label('Veterinarian Contact')->size('bold')->badge()->color('success'),
                TextEntry::make('record_type')->label('Record Type')->badge()->color('primary'),
                TextEntry::make('cost')->label('Cost'),
                TextEntry::make('description')->label('Description')->columnSpanFull()->markdown(),
                TextEntry::make('medications')->label('Medications Prescribed')->columnSpanFull()->markdown()->placeholder('N/A'),
                TextEntry::make('notes')->label('Medications Prescribed')->columnSpanFull()->markdown()->placeholder('N/A'),
              ])->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 2
              ])
            ]);
    }
}
