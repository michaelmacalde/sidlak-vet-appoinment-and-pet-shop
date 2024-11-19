<?php

namespace App\Filament\Resources\Animal;

use App\Filament\Resources\Animal\BreedResource\Pages;
use App\Filament\Resources\Animal\BreedResource\RelationManagers;
use App\Models\Animal\Breed;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\Group as ComponentsGroup;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BreedResource extends Resource
{
    protected static ?string $model = Breed::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationGroup = 'Animal';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Breed Details')
                ->icon('heroicon-o-information-circle')
                ->description('All fields are required')
                ->collapsible(true)
                ->schema([
                    Group::make([
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
                    ]),


                    FileUpload::make('breed_image')->image()->maxSize(1024)->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('breed_image')->circular()->label('Image')->width(50)->height(50),
                TextColumn::make('breed_name')->sortable()->searchable()->label('Breed')->weight('bold'),
                TextColumn::make('breed_description')->limit(50)->wrap()->label('Description'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalHeading('Breed Details')->modalIcon('heroicon-o-rectangle-group'),
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
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('Create Breed')),
            ])
            ->emptyStateIcon('heroicon-o-rectangle-group')
            ->emptyStateHeading('No breeds are created');
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
            'index' => Pages\ListBreeds::route('/'),
            'create' => Pages\CreateBreed::route('/create'),
            'edit' => Pages\EditBreed::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ComponentsGroup::make([
                    ImageEntry::make('breed_image')->label(''),
                ]),

                ComponentsGroup::make([
                    TextEntry::make('breed_name')->size(TextEntrySize::Large)->label('Breed'),
                    TextEntry::make('breed_slug')->size(TextEntrySize::Small)->label('Slug'),
                ]),

                ComponentsGroup::make([
                    TextEntry::make('breed_description')->label('Description'),
                ])->columnSpanFull()
            ])
            ->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 2,
            ]);
    }
}
