<?php

namespace App\Filament\Resources\Adoption;

use App\Enums\AdoptionEnum;
use App\Filament\Resources\Adoption\AdoptionResource\Pages;
use App\Filament\Resources\Adoption\AdoptionResource\RelationManagers;
use App\Filament\Resources\Animal\AdoptionResource\Widgets\AdoptionStatsOverview;
use App\Models\Adoption\Adoption;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class AdoptionResource extends Resource
{
    protected static ?string $model = Adoption::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';

    protected static ?string $navigationGroup = 'Animal';

    protected static ?int $navigationSort = 1;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Adoption Information')
                ->description('Please provide the following information about the adoption.')
                ->schema([
                    TextInput::make('adoption_number')
                    ->default('AR-'. date('His-') . strtoupper(Str::random(6)))
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(32)
                    ->unique(Adoption::class, 'adoption_number', ignoreRecord: true)
                    ->columnSpanFull(),

                    Select::make('user_id')
                    ->required()
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->native(false)
                    ->searchable()
                    ->searchDebounce(1200)
                    ->preload()
                    ->optionsLimit(6),

                    Select::make('dog_id')
                    ->required()
                    ->relationship(
                        name: 'dog',
                        titleAttribute: 'dog_name',
                        modifyQueryUsing: function (Builder $query, string $operation){
                            if($operation == 'create'){
                                $query->whereDoesntHave('adoption', fn (Builder $query) => $query->where('status', 'approved'))->with('breed');
                            }
                        },
                    )
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return $record->dog_name . ' - ' . ($record->breed->breed_name ?? 'Unknown Breed');
                    })
                    ->native(false)
                    ->searchable()
                    ->searchDebounce(1200)
                    ->preload()
                    ->optionsLimit(5),


                    DatePicker::make('request_date')
                    ->required()
                    ->native(false)
                    ->default(now())
                    ->dehydrated(),

                    ToggleButtons::make('status')
                    ->required()
                    ->options(AdoptionEnum::class)
                    ->default('pending')
                    ->colors([
                        'pending' => 'primary',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    ])
                    ->disableOptionWhen(fn (string $value): bool => $value === 'published')
                    ->in(fn (ToggleButtons $component): array => array_keys($component->getEnabledOptions()))
                    ->inline(true),

                ])->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Split::make([
                TextColumn::make('adoption_number')
                ->label('Adoption #')
                ->sortable()
                ->searchable()
                ->badge()
                ->color('primary'),

                TextColumn::make('user.name')
                ->label('Adopter')
                ->searchable()
                ->sortable(),

                ImageColumn::make('dog.first_dog_image')->label('Dog Image')->circular()
                ->grow(false)
                ->width(70)
                ->height(70),

                Stack::make([
                    TextColumn::make('dog.dog_name')->searchable()->label('Dog Name')
                    ->label('Dog & Breed')
                    ->sortable()
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->alignLeft()
                    ->weight('bold'),
                    TextColumn::make('dog.breed.breed_name')->searchable()->label('Breed')->size('xs')->alignLeft()
                    ->formatStateUsing(fn (string $state) => ucfirst('('.$state.')')),
                ])->space(1),


                TextColumn::make('status')->label('Status')->toggleable()
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'primary',
                    'approved' => 'success',
                    'rejected' => 'danger',
                })
                ->icon(fn (string $state): string => match ($state) {
                    'pending' => 'heroicon-o-clock',
                    'approved' => 'heroicon-o-hand-thumb-up',
                    'rejected' => 'heroicon-o-x-circle',
                })
                ->formatStateUsing(fn (string $state) => ucfirst($state)),

            ])


        ])
        ->filters([
            //
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([
            Tables\Actions\ViewAction::make()->modalHeading('Adoption Information')->modalIcon('heroicon-o-information-circle'),
            Tables\Actions\ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->after(function (Model $record) {
                    $dog = $record->dog;
                    if ($dog) {
                        $dog->update(['status' => 'available']);
                        return $dog;
                    }
                }),
            ])->tooltip('Actions')
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
            ->label(__('New Adoption')),
        ])
        ->emptyStateIcon('heroicon-o-face-smile')
        ->emptyStateHeading('No adoptions are created');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdoptions::route('/'),
            'create' => Pages\CreateAdoption::route('/create'),
            'edit' => Pages\EditAdoption::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            AdoptionStatsOverview::class
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
                ->schema([
                    Group::make([
                        TextEntry::make('dog.dog_name')->label('Dog Name')->size(TextEntrySize::Large)->weight('bold')
                        ->formatStateUsing(function(Model $record): string {
                                $breed = $record?->dog?->breed?->breed_name;
                                $dog = $record?->dog?->dog_name;
                            return $dog . ' (' . $breed . ')';
                        }),

                        ImageEntry::make('dog.first_dog_image')->label('')->circular(),
                    ])->columnSpan(1),
                Group::make([
                        TextEntry::make('adoption_number')->label('Adoption #')->size(TextEntrySize::Large)->badge()->color('primary'),
                        TextEntry::make('user.name')->label('Adopter')->size(TextEntrySize::Large),
                        TextEntry::make('request_date')->label('Request Date')->size(TextEntrySize::Large),
                        TextEntry::make('status')->label('Status')->size(TextEntrySize::Large)->badge()->color(fn (string $state): string => match ($state) {
                            'pending' => 'primary',
                            'approved' => 'success',
                            'rejected' => 'danger',
                        })
                        ->icon(fn (string $state): string => match ($state) {
                            'pending' => 'heroicon-o-clock',
                            'approved' => 'heroicon-o-hand-thumb-up',
                            'rejected' => 'heroicon-o-x-circle',
                        })
                        ->formatStateUsing(fn (string $state) => ucfirst($state)),
                    ])
                    ->columnSpan(2)
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2,
                ])
            ])
            ->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 3,
           ]);
    }
}
