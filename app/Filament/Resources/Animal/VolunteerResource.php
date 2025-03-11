<?php

namespace App\Filament\Resources\Animal;

use App\Enums\VolunteerStatusTypeEnum;
use App\Filament\Resources\Animal\VolunteerResource\Pages;
use App\Filament\Resources\Animal\VolunteerResource\RelationManagers;
use App\Filament\Resources\Animal\VolunteerResource\Widgets\VolunteerStatsOverview;
use App\Models\Volunteer\Volunteer;
// use App\Models\Volunteer\Volunteer\Volunteer as VolunteerVolunteer;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VolunteerResource extends Resource
{
    protected static ?string $model = Volunteer::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?int $navigationSort = 1;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Volunteer Details')
                ->schema([
                    Select::make('user_id')
                    ->required()
                    ->relationship(name:'user', titleAttribute:'name')
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->optionsLimit(6),

                    Select::make('volunteer_role')
                    ->label('Volunteer Role')
                    ->required()
                    ->options([
                        'dog_walking' => 'Dog Walking',
                        'event_assistance' => 'Event Assistance',
                        'admin_support' => 'Admin Support',
                        'community_outreach' => 'Community Outreach',
                    ])->native(false),

                    RichEditor::make('volunteer_reason')
                    ->required()
                    ->placeholder('Reason for joining')
                    ->columnSpanFull()
                    ->maxLength(65535),

                    DatePicker::make('volunteer_joined_date')
                    ->required()
                    ->default(now())
                    ->native(false),

                    ToggleButtons::make('volunteer_status')
                    ->required()
                    ->default('active')->inline()
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->icons([
                        'active' => 'heroicon-o-check-circle',
                        'inactive' => 'heroicon-o-x-circle',
                    ])
                    ->colors([
                        'active' => 'success',
                        'inactive' => 'danger',
                    ]),

                    ToggleButtons::make('volunteer_status_type')
                    ->required()
                    ->inline()
                    ->options(VolunteerStatusTypeEnum::class)
                    ->default('pending')
                    ->columnSpanFull(),

                ])->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                    'default' => 2
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('user.name')->searchable()->sortable()->weight('bold'),
            Tables\Columns\TextColumn::make('volunteer_role')
            ->label('Volunteer Role')
            ->searchable()
            ->sortable()
            ->formatStateUsing(function (string $state): string {
                return ucwords(str_replace('_', ' ', $state));
            }),
            Tables\Columns\TextColumn::make('volunteer_reason')->wrap()->limit(60)->html(),
            Tables\Columns\TextColumn::make('volunteer_status')->sortable()
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'active' => 'success',
                'inactive' => 'danger',
            })
            ->icon(fn (string $state): string => match ($state) {
                'active' => 'heroicon-o-check-circle',
                'inactive' => 'heroicon-o-x-circle',
            })->formatStateUsing(fn (string $state): string => ucwords($state)),

            Tables\Columns\TextColumn::make('volunteer_status_type')->sortable()
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
            })->formatStateUsing(fn (string $state): string => ucwords($state)),

            Tables\Columns\TextColumn::make('volunteer_joined_date')->searchable()->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make()->modalHeading('Volunteer Details')->modalIcon('heroicon-o-heart'),
            Tables\Actions\ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->tooltip('Actions')
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->striped()
        ->deferLoading()
        ->emptyStateActions([
            Tables\Actions\CreateAction::make()
            ->icon('heroicon-m-plus')
            ->label(__('New Volunteer')),
        ])
        ->emptyStateIcon('heroicon-o-heart')
        ->emptyStateHeading('No volunteers are registered');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVolunteers::route('/'),
            'create' => Pages\CreateVolunteer::route('/create'),
            'edit' => Pages\EditVolunteer::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            VolunteerStatsOverview::class
        ];
    }

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('volunteer_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'active' => 'heroicon-o-check-circle',
                        'inactive' => 'heroicon-o-x-circle',
                    })->formatStateUsing(fn (string $state): string => ucwords($state)),
                TextEntry::make('volunteer_status_type')
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
                    ->formatStateUsing(fn (string $state): string => ucwords($state)),

                TextEntry::make('user.name')->label('Name')->size(TextEntrySize::Large),
                TextEntry::make('volunteer_joined_date'),
                TextEntry::make('volunteer_role')->label('Role')
                    ->formatStateUsing(function (string $state): string {
                        return ucwords(str_replace('_', ' ', $state));
                    }),

                TextEntry::make('reason')->markdown()->columnSpanFull(),
            ])
            ->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 2,
            ]);

    }
}
