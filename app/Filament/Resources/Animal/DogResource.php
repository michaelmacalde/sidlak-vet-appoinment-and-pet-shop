<?php

namespace App\Filament\Resources\Animal;

use App\Enums\AdoptionEnum;
use App\Enums\DogEnum;
use App\Filament\Resources\Animal\DogResource\Pages;
use App\Filament\Resources\Animal\DogResource\Pages\CreateDog;
use App\Filament\Resources\Animal\DogResource\Pages\EditDog;
use App\Filament\Resources\Animal\DogResource\Pages\ManageDogMedicalRecord;
use App\Filament\Resources\Animal\DogResource\RelationManagers;
use App\Filament\Resources\Animal\DogResource\Widgets\DogStatsOverview;
use App\Models\Animal\Breed;
use App\Models\Animal\Dog;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\Group as ComponentsGroup;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class DogResource extends Resource
{
    protected static ?string $model = Dog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Animal';

    protected static ?int $navigationSort = 2;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Dog Information')
                ->icon('heroicon-o-rectangle-stack')
                ->description('Please provide the following information about the dog.')
                ->schema([
                    Group::make()
                        ->schema([
                            Section::make('Dog Details')
                        ->schema(static::getDetailsFormSchema()),

                        Section::make('Dog Photo')
                        ->schema([
                            static::getDogImagesRepeater(),
                        ]),
                    ]),

                    Forms\Components\Section::make('Medical Records')
                    ->headerActions([
                        ActionsAction::make('reset')
                            ->modalHeading('Are you sure?')
                            ->modalDescription('All existing items will be removed from the order.')
                            ->requiresConfirmation()
                            ->color('danger')
                            ->action(fn (Forms\Set $set) => $set('items', [])),
                    ])
                    ->schema([
                        static::getItemsRepeater(),
                    ])
                    ->visible(fn( $livewire) => $livewire instanceof CreateDog),

                ])->columnSpanFull(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Registry of All Dogs')
            ->description('A comprehensive list of all the dogs currently registered in the system, including their statuses and details.')
            ->columns([
                Split::make([
                    ImageColumn::make('first_dog_image')
                    ->label('Avatar')
                    ->width(80)
                    ->height(80)
                    ->circular(),

                    Stack::make([
                        TextColumn::make('dog_name')->label('Name')->weight('bold')->searchable(),
                        TextColumn::make('breed.breed_name')->label('Breed')->size('xs')->searchable(),
                    ])
                    ->space(1)->alignLeft(),

                    TextColumn::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'available' => 'success',
                            'adopted' => 'danger',
                            'foster' => 'danger',
                        })
                        ->icon(fn (string $state): ?string => match ($state) {
                            'available' => 'heroicon-o-check-circle',
                            'adopted' => 'heroicon-o-heart',
                            'fostered' => 'heroicon-o-hand-thumb-up',
                        })->formatStateUsing(fn (string $state) => ucfirst($state)),
                ]),

                Panel::make([
                    Stack::make([
                        TextColumn::make('dog_short_description')->wrap()->limit(250)->label('Description')->html(),
                        TextColumn::make('adoption.status'),
                    ]),
                ])->collapsible(),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 2,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->icon('heroicon-m-eye')->label(''),
                Tables\Actions\EditAction::make()->icon('heroicon-m-pencil-square')->label(''),
                Tables\Actions\DeleteAction::make()->icon('heroicon-m-trash')->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('Create Dog')),
            ])
            ->emptyStateIcon('heroicon-o-rectangle-stack')
            ->emptyStateHeading('No dogs are created')
            ->defaultSort('created_at', 'desc');
    }

    public static function getWidgets(): array
    {
        return [
            DogStatsOverview::class
        ];
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewDog::class,
            EditDog::class,
            ManageDogMedicalRecord::class
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDogs::route('/'),
            'create' => Pages\CreateDog::route('/create'),
            'edit' => Pages\EditDog::route('/{record}/edit'),
            'view' => Pages\ViewDog::route('/{record}'),
            'medical_records' => ManageDogMedicalRecord::route('/{record}/medical_records'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                ComponentsSection::make('Dog Profile')
                ->description('The following information is used to display the dog on the website.')
                ->schema([
                    ImageEntry::make('first_dog_image')->label('')
                    ->width(230)
                    ->height(230)
                    ->circular()->columnSpan(1)
                    ->alignCenter(),

                    ComponentsGroup::make()
                    ->schema([
                        TextEntry::make('dog_name')->size(TextEntrySize::Large),
                        TextEntry::make('breed.breed_name')->size(TextEntrySize::Large),
                        TextEntry::make('dog_age')->size(TextEntrySize::Large),
                        TextEntry::make('dog_gender')->formatStateUsing(fn (string $state) => ucfirst($state)),
                        TextEntry::make('status')->size(TextEntrySize::Large)->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'available' => 'success',
                            'adopted' => 'danger',
                            'fostered' => 'danger',
                        })
                        ->icon(fn (string $state): ?string => match ($state) {
                            'available' => 'heroicon-o-check-circle',
                            'adopted' => 'heroicon-o-heart',
                            'fostered' => 'heroicon-o-hand-thumb-up',
                        })->formatStateUsing(fn (string $state) => ucfirst($state)),
                        TextEntry::make('dog_size')->formatStateUsing(fn (string $state) => ucfirst($state)),
                        TextEntry::make('adoption.user.name')
                        ->label('Adopter')->placeholder('---')
                        ->formatStateUsing(fn (string $state) => ucfirst($state))
                        ->getStateUsing(function (Model $record) {
                            if ($record->adoption && $record->adoption->status === AdoptionEnum::APPROVED->value) {
                                return $record->adoption->user->name; //return user name kung and adoption status is approved
                            }
                            return;
                        })->visible(fn (Model $record) => !empty($record->adoption->user->name)),
                        TextEntry::make('adoption.adoption_number')
                        ->label('Adoption #')->placeholder('---')
                        ->formatStateUsing(fn (string $state) => ucwords($state))
                        ->badge()
                        ->color('primary')
                        ->getStateUsing(function (Model $record) {
                            if ($record->adoption && $record->adoption->status === AdoptionEnum::APPROVED->value) {
                                return $record->adoption->adoption_number;
                            }
                            return;
                        })->visible(fn (Model $record) => !empty($record->adoption->adoption_number)),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 3,
                    ])->columnSpan(2)

                ])->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 3,
                ]),

                ComponentsSection::make('About the Dog')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    TextEntry::make('dog_short_description')->markdown()->label(''),
                    TextEntry::make('dog_long_description')->markdown()->label('')
                ]),

                ComponentsSection::make('Medical Records')
                ->icon('heroicon-o-clipboard-document-list')
                ->schema([
                    RepeatableEntry::make('medicalRecords')
                    ->schema([
                        TextEntry::make('record_date')->label('Recorded Date')->date()->placeholder('---')->columnSpan(1),
                        TextEntry::make('record_type')->label('Type of medical record')->placeholder('---'),

                        ComponentsGroup::make()
                        ->schema([
                            TextEntry::make('vet_name')->label('Veterinarian')->weight('bold')->placeholder('---'),
                            TextEntry::make('vet_contact')->label('Contact #')->weight('bold')->placeholder('---'),
                        ])->columns([
                            'sm' => 1, 'md' => 2, 'lg' => 2
                        ])->columnSpanFull(),

                        ComponentsGroup::make()
                        ->schema([
                            TextEntry::make('cost')->label('Cost')->placeholder('---'),
                            TextEntry::make('next_appointment')->label('Next Appointment')->badge()->color('primary')->placeholder('N/A'),
                        ])->columns([
                            'sm' => 1, 'md' => 2, 'lg' => 2
                        ])->columnSpanFull(),


                        TextEntry::make('description')->label('Description')->columnSpanFull()->placeholder('---')->markdown(),

                    ])

                    ->columns([
                        'sm' => 1, 'md' => 2, 'lg' => 2
                    ])
                    ->grid([
                        'sm' => 1, 'md' => 2, 'lg' => 2
                    ])
                    // ComponentsGroup::make()
                    // ->schema([
                    //     TextEntry::make('medicalRecords.type')->label('Type')->placeholder('---')
                    //     ->badge()->color('primary'),
                    //     TextEntry::make('medicalRecords.veterinarian')->label('Veterinarian')->placeholder('---')
                    //     ->badge()->color('success'),
                    // ])->columns([
                    //     'sm' => 1, 'md' => 2, 'lg' => 2
                    // ]),
                    // TextEntry::make('medicalRecords.description')->label('Description')->html()->placeholder('---'),
                    // TextEntry::make('medicalRecords.record_date')->label('Recorded Date')->badge()->color('success')->dateTime()->placeholder('---'),
                ])->columnSpanFull()->collapsible()->collapsed(),


            ]);
    }


    /** @return Builder<Dog> */
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['breed', 'adoption', 'medicalRecords']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['dog_name', 'breed.breed_name','medicalRecords.type', 'adoption.adoption_number'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        /** @var Dog $record */
        $details = [];

        if ($record->dog_name) {
            $details['Dog Name'] = $record->dog_name . ' (' . $record->breed->breed_name . ')';
        }

        return $details;
    }


     /** @return Forms\Components\Component[] */
     public static function getDetailsFormSchema(): array
     {
         return [
            Group::make()
            ->schema([
                Group::make()
                ->schema([
                    TextInput::make('dog_name')
                    ->required()
                    ->maxLength(255)
                    ->unique(Dog::class, 'dog_name', ignoreRecord: true)
                    ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('dog_slug', Str::slug($state))),

                    TextInput::make('dog_slug')
                    ->label('Slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(255)
                    ->unique(Dog::class, 'dog_slug', ignoreRecord: true),

                    Select::make('breed_id')->relationship(name:  'breed', titleAttribute:'breed_name')->required()->preload()->optionsLimit(6)->searchable()->searchDebounce(1200)->native(false)
                    ->createOptionForm([
                        Section::make('Breed Details')
                            ->icon('heroicon-o-information-circle')
                            ->description('All fields are required')
                            ->collapsible(true)
                            ->schema([
                                TextInput::make('breed_name')->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('breed_slug', Str::slug($state))),

                                TextInput::make('breed_slug')
                                ->disabled()
                                ->dehydrated()
                                ->required()
                                ->maxLength(255)
                                ->unique(Breed::class, 'breed_slug', ignoreRecord: true),

                                Textarea::make('breed_description')->maxLength(1024)->rows(6)->cols(20),

                                FileUpload::make('breed_image')->image()->maxSize(1024)->imageEditor()
                                ->imageEditorAspectRatios([
                                    '16:9',
                                    '4:3',
                                    '1:1',
                        ])
                    ])
                ]),
                ])
                ->columnSpanFull()
                ->columns([
                    'sm' => 1,
                    'md' => 3,
                    'lg' => 3,
                ]),
                TextInput::make('dog_age')->required()->numeric()->minValue(0),

                Select::make('dog_size')->required()->options([
                    'small' => 'Small',
                    'medium' => 'Medium',
                    'large' => 'Large',])->native(false),
                Select::make('dog_gender')->required()->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    ])->native(false),

                ToggleButtons::make('status')
                ->required()
                ->options(DogEnum::class)
                ->inline()
                ->default('available'),
                Textarea::make('dog_short_description')->required()->columnSpanFull()->maxLength(65535)
                ->label('Short Description')
                ->rows(5),
                RichEditor::make('dog_long_description')->required()->columnSpanFull()->maxLength(65535)
                ->label('Long Description'),
            ])->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 2,
            ])->columnSpanFull()

         ];
     }

     public static function getItemsRepeater(): Repeater
     {
         return Repeater::make('medicalRecords')
             ->relationship()
             ->schema([
                TextInput::make('type')->required()->maxLength(255),
                TextInput::make('veterinarian')->required()->maxLength(255),
                RichEditor::make('description')->required()->columnSpanFull()->maxLength(65535),
                DatePicker::make('record_date')
                ->default(now())
                ->native(false)
                ->required(),
             ])
             ->defaultItems(0)
             ->columns([
                 'sm' => 1,
                 'md' => 2,
                 'lg' => 2,
             ])
             ->required();
     }

     public static function getDogImagesRepeater(): Repeater
     {
        return Repeater::make('dog_image')
                ->label('Photo')
                ->schema([
                    FileUpload::make('dog_image')->image()->required()->imageEditor() ->imageEditorAspectRatios([
                        null,
                        '1:1',
                        '4:3',
                    ])->maxSize(2048)->label(''),
                ])->grid([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                ])->maxItems(6);
     }
}
