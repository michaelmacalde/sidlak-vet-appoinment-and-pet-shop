<?php

namespace App\Filament\Resources\Blog;

use App\Filament\Resources\Blog\CategoryResource\Pages;
use App\Filament\Resources\Blog\CategoryResource\RelationManagers;
use App\Models\Blog\Category;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?string $navigationGroup = 'News & Events';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Category Details')
                ->description('All fields are required')
                ->schema([
                    TextInput::make('category_name')
                    ->required()->maxLength(255)
                    ->unique(Category::class, 'category_name', ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('category_slug', Str::slug($state)))
                    ->columnSpan(1),

                    TextInput::make('category_slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(255)
                    ->unique(Category::class, 'category_slug', ignoreRecord: true)
                    ->columnSpan(1),

                    Textarea::make('category_description')->maxLength(1024)->columnSpanFull()->rows(7)

                ])
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    'default' => 2
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category_name')->label('Name')->sortable()->searchable(),
                TextColumn::make('category_slug')->label('Slug')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
                ->label(__('Create Category')),
            ])
            ->emptyStateIcon('heroicon-o-swatch');
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
               ComponentsSection::make('Category')
               ->schema([
                   TextEntry::make('category_name')->size(TextEntrySize::Medium)->label('Name'),
                   TextEntry::make('category_slug')->size(TextEntrySize::Medium)->label('Slug'),
                   TextEntry::make('category_description')->color('light')->label('Description')->columnSpanFull(),
               ])
               ->columns([
                   'sm' => 1,
                   'md' => 2,
                   'lg' => 2,
                   'default' => 2
               ])->collapsible()
            ]);
    }
}
