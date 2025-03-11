<?php

namespace App\Filament\Resources\Ecommerce;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Facades\Filament;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Models\Ecommerce\ProductCategory;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Components\Group as ComponentsGroup;
use Filament\Infolists\Components\Section as ComponentsSection;
use App\Filament\Resources\Ecommerce\ProductCategoryResource\Pages;
use App\Filament\Resources\Ecommerce\ProductCategoryResource\RelationManagers;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;
    protected static ?string $navigationGroup = 'Ecommerce';
    protected static ?string $navigationIcon = 'heroicon-m-folder';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
   
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Product Category Information')
                ->schema([
                    TextInput::make('prod_cat_name')
                    ->label('Product Category Name')
                    ->required()
                   
                    ->maxLength(255)
                    ->unique(ProductCategory::class, 'prod_cat_name', ignoreRecord: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('prod_cat_slug', Str::slug($state)))
                    ->maxLength(255)
                    ->columnSpan(1),

                    TextInput::make('prod_cat_slug')
                    ->label('Product Category Slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->unique(ProductCategory::class, 'prod_cat_slug', ignoreRecord: true)
                    ->columnSpan(1),

                    MarkdownEditor::make('prod_cat_description')
                    ->label('Product Category Description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                ])
                

              
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('prod_cat_name')->label('Name')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn ($state) => ucwords($state)),

                TextColumn::make('prod_cat_slug')
                ->label('Slug')
                ->sortable()
                ->searchable(),

                TextColumn::make('prod_cat_description')
                ->label('Description')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn ($state) => ucfirst(Str::limit($state, 50, '...'))),
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
            ])  ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('New Product Category')),
            ])
            ->emptyStateIcon('heroicon-o-swatch')  
            ->emptyStateHeading('No Product Categories');
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewProductCategory::class,
            Pages\EditProductCategory::class,
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoSection::make()
                ->schema([
                    TextEntry::make('prod_cat_name')
                    ->label('Product Category Name')
                    ->formatStateUsing(fn (string $state) : string => ucwords($state))
                    ->size(TextEntry\TextEntrySize::Large)
                    ->weight(FontWeight::ExtraBold),

                    

                    ComponentsSection::make('Product Category Details')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                      
                        TextEntry::make('prod_cat_description')
                            ->label('')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight(FontWeight::ExtraBold),
                        
                    ]),

                ])
            ]);
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
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
            'view' => Pages\ViewProductCategory::route('/{record}'),
        ];
    }


   


}
