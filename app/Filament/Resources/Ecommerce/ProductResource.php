<?php

namespace App\Filament\Resources\Ecommerce;

use Filament\Forms;
use Filament\Tables;
use Pages\ViewProduct;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\Icon;
use App\Models\Ecommerce\Product;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use App\Models\Ecommerce\ProductImage;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use App\Models\Ecommerce\ProductCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfoSection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use App\Filament\Resources\Ecommerce\ProductResource\Pages;
use Filament\Infolists\Components\Group as ComponentsGroup;
use Filament\Infolists\Components\Section as ComponentsSection;
use App\Filament\Resources\Ecommerce\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Ecommerce';
   
    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';
    // 'heroicon-o-rectangle-stack';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Product Information')
                ->description('Please provide the following information about the product.')
                ->schema([

                    Section::make('Product Information')
                    ->schema([
                        Group::make()
                            ->schema([
                                TextInput::make('prod_name')
                                    ->label('Product Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull()
                                    ->live(onBlur: true)
                                    ->unique(Product::class, 'prod_name', ignoreRecord: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('prod_slug', Str::slug($state))),
                
                                TextInput::make('prod_slug')
                                    ->label('Product Slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull()
                                    ->unique(Product::class, 'prod_slug', ignoreRecord: true),
                            ])
                            ->columnSpanFull()
                            ->columns([
                                'sm' => 1,
                                'md' => 2,
                                'lg' => 4
                            ]),
                
                        Group::make()
                            ->schema([
                                TextInput::make('prod_sku')
                                    ->label('Product SKU')
                                    ->default(function() {
                                        do {
                                            $sku = 'SKU-'. rand(1000,9999) . '-' . strtoupper(Str::random(4));
                                        } while (Product::where('prod_sku', $sku)->exists());
                                        return $sku;
                                    })
                                    ->disabled()
                                    ->dehydrated()
                                    ->unique(Product::class, 'prod_sku', ignoreRecord: true),
                
                                    MultiSelect::make('productCategories')
                                    ->label('Product Category')
                                    ->relationship(
                                        name: 'productCategories',
                                        titleAttribute: 'prod_cat_name'
                                    )
                                    ->getOptionLabelFromRecordUsing(fn ($record) => ucwords($record->prod_cat_name)) // Capital letters per word
                                    ->preload()
                                    ->searchable()
                                    ->optionsLimit(5)
                                    ->required()
                                    ->createOptionForm([
                                        Section::make('Product Category Information')->schema([
                                            TextInput::make('prod_cat_name')
                                                ->label('Product Category Name')
                                                ->required()
                                                ->maxLength(255)
                                                ->unique(ProductCategory::class, 'prod_cat_name', ignoreRecord: true)
                                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('prod_cat_slug', Str::slug($state)))
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
                                        ]),
                                    ]),
                                

                                    

                                    Select::make('prod_unit')
                                    ->label('Product Unit')
                                    ->required()
                                    ->options([
                                        'pcs' => 'Piece (pcs)',
                                        'kg' => 'Kilograms (kg)',
                                    ])
                                    ->reactive(),
                        
                                TextInput::make('prod_weight')
                                    ->label('Kilograms To Sell')
                                    ->required()
                                    ->numeric()
                                    ->hidden(fn ($get) => $get('prod_unit') !== 'kg'), // Show only when unit is kg
                        
                                TextInput::make('prod_quantity')
                                    ->label('Product Quantity')
                                    ->required()
                                    ->numeric()
                                    ->default(1),
                        
                                TextInput::make('prod_old_price')
                                    ->label('Product Old Price')
                                    ->numeric()
                                    ->default(0),
                        
                                TextInput::make('prod_price')
                                    ->label('Product Price')
                                    ->required()
                                    ->numeric()
                                    ->default(0),

                                    Section::make('Specify whether this product requires shipping and if it should be available in the market.')
                                    ->schema([
                                        ToggleButtons::make('prod_requires_shipping')
                                            ->label('Is Product Requires Shipping?')
                                            ->boolean()
                                            ->dehydrated()
                                            ->grouped()
                                            ->colors([
                                               false => 'warning',
                                               true => 'success',
                                            ])
                                            ->icons([
                                                false => 'heroicon-m-x-circle',  
                                                true => 'heroicon-m-check-circle', 
                                            ])
                                            ->default(false),
                                
                                        ToggleButtons::make('is_visible_to_market')
                                            ->label('Want to make this product visible to market?')
                                            ->boolean()
                                            ->grouped()
                                            ->dehydrated()
                                            ->colors([
                                                false => 'warning',
                                                true => 'success',
                                             ])
                                             ->icons([
                                                 false => 'heroicon-m-x-circle',  
                                                 true => 'heroicon-m-check-circle', 
                                             ])
                                            ->default(false),
                                    ])
                                    ->columns(2),
                                       
                                    
                                   
                                   
                           

                            ])
                            ->columnSpanFull()
                            ->columns([
                                'sm' => 1,
                                'md' => 3,
                                'lg' => 4,
                                'default' => 2
                            ]), 
                    ])
                  
                    ->columns([
                        'sm' => 1,
                        'md' => 3,
                        'lg' => 5,
                        'default' => 2
                    ]),
                
                                
                    
                       
                
                
            Section::make('Add a short and detailed description for the product.')
            ->schema([
                Textarea::make('prod_short_description')
                    ->label('Product Short Description')
                    ->maxLength(102)
                    ->columnSpan('full'),

                RichEditor::make('prod_description')
                    ->label('Product Description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpan('full'),
            ]),

           

            // Repeater::make('product_images')
            //         ->label('Product Image')
            //         ->relationship(name:'images')
            //         ->schema([
            //             FileUpload::make('image')
            //             ->image()
            //             ->required()
            //             ->directory('product-images'),
            //         ])->columns(1),



                ])->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                    'default' => 2
                ]),

                Section::make('Product Images')
                ->schema([
                    Repeater::make('images')
                    ->label('Product Images')
                    ->relationship(name: 'images')
                    ->schema([
                        // FileUpload::make('product_img')
                        //     ->image()
                        //     ->required()
                        //     ->directory('product-images')
                        //     ->dehydrateStateUsing(fn ($state) => json_encode([$state])) // Converts to JSON
                        //     ->afterStateHydrated(fn ($state) => json_decode($state, true)[0] ?? null), // Converts back to string
                            
                
                        // TextInput::make('url')
                        //     ->label('Image URL')
                        //     //->default(fn ($get) => $get('image') ? 'product-images/' . $get('image') : null)
                        //     ->default(fn ($get) => $get('product_img') ? 'product-images/' . json_decode($get('product_img'), true)[0] : null)
                        //     ->disabled(),
                            
                
                        // TextInput::make('alt_text')
                        //     ->label('Alt Text')
                        //     ->default(fn ($get) => $get('product_img') ? pathinfo(json_decode($get('product_img'), true)[0], PATHINFO_FILENAME) : null)
                        //     ->disabled(),
                            
                
                        // Toggle::make('is_primary')
                        //     ->label('Primary Image'),
                            
                
                        // TextInput::make('display_order')
                        //     ->label('Display Order')
                        //     ->numeric()
                        //     ->default(0),


                        FileUpload::make('url')
                        ->label('Image Upload')
                        ->image()
                       
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            null,
                            '16:9',
                            '4:3',
                        ])->maxSize(2048)
                        ->required()
                       
                        ->afterStateUpdated(fn ($state, $set) => 
                            $set('alt_text', $state ? pathinfo($state, PATHINFO_FILENAME) : '')
                        ),
                        
                        
                       


                     
                          
    
                    TextInput::make('alt_text')
                        ->label('Alt Text')
                        ->disabled()
                        ->dehydrated()
                        ->maxLength(255),

                        // Toggle::make('is_primary')
                        // ->label('Make this as Primary Image?')
                        // ->default(false)
                        // ->dehydrated(),

                        ToggleButtons::make('is_primary')
                            ->label('Make this as Primary Image?')
                            ->boolean()
                            ->grouped()
                            ->colors([
                                false => 'warning',
                                true => 'success',
                             ])
                             ->icons([
                                 false => 'heroicon-m-x-circle',  
                                 true => 'heroicon-m-check-circle', 
                             ])
                            ->default(false)
                            ->dehydrated(),
                      
                        

                       
                        


                    
                           
                        
                    // TextInput::make('display_order')
                    //     ->label('Display Order')
                    //     ->hidden()
                    //     ->numeric()
                    //     ->default(0)
                    //     ->minValue(0)
                    //     ->unique(ProductImage::class, 'display_order', ignoreRecord: true),
                        
                       
    
                 
                            
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2,
                        'default' => 2
                    ])
                    ->addable(true)  // Allows users to add more images
                    ->deletable(true),// Allows users to remove images
                
                ])
                
            ]);
    }

  
    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Grid::make([
                'lg' => 3,
                '2xl' => 3,
            ]),
            
            Tables\Columns\Layout\Stack::make([
                Tables\Columns\Layout\Split::make([
                    TextColumn::make('prod_sku')
                        ->label('SKU')
                        ->searchable()
                        ->badge()
                        ->copyable()
                        ->color('success')
                        ->weight(FontWeight::Bold),
                        
                    
                ]),

                ImageColumn::make('images.url')
                        ->label('Primary Image')
                        // ->height('100%')
                        // ->width('100%')
                        ->height(200)
                        ->width(200)
                        ->limit(1)
                        ->getStateUsing(fn ($record) => $record->images()->where('is_primary', true)->value('url')   ?? $record->images()->orderBy('created_at')->value('url'))
                        ->extraAttributes(['class' => 'rounded-lg']),
                
                TextColumn::make('prod_name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->weight(FontWeight::Bold)
                    ->size(TextColumn\TextColumnSize::Large)
                    ->formatStateUsing(fn ($record) => 
                        $record->prod_unit == 'kg' ? $record->prod_name . ' - ' . $record->prod_weight . ' kg' : $record->prod_name
                    ),

                   
               

                
                Tables\Columns\Layout\Split::make([
                    TextColumn::make('prod_price')
                        ->label('Price')
                        ->sortable()
                        ->money('PHP'),
                       
                    
                    TextColumn::make('prod_quantity')
                        ->label('Quantity')
                        ->badge()
                        ->sortable()
                        ->color('success'),

                        TextColumn::make('prod_unit')
                        ->label('Unit')
                        ->formatStateUsing(fn ($record) => 
                            $record?->prod_unit == 'kg' 
                                ? ($record->quantity < 10 ? "kg" : 'kg') 
                                : ($record->quantity < 10 ? "pcs" : 'pcs')
                        ),
                        //->hidden(fn ($record) => $record?->prod_unit != 'kg'),
                       
                    
                    TextColumn::make('prod_status')
                        ->label('Status')
                        ->getStateUsing(fn ($record) => match (true) {
                            $record->prod_quantity > 10 => 'In&nbsp;Stock',
                            $record->prod_quantity > 0 && $record->prod_quantity <= 10 => 'Low&nbsp;in&nbsp;Stock',
                            default => 'Out&nbsp;of&nbsp;Stock',
                        })->html()
                        ->color(fn ($record) => match (true) {
                            $record->prod_quantity > 10 => 'success',
                            $record->prod_quantity > 0 && $record->prod_quantity <= 10 => 'warning',
                            default => 'danger',
                        }),



                    
                        
                ]),
            ])->space(3),

            Tables\Columns\Layout\Panel::make([
                Tables\Columns\Layout\Split::make([

                    TextColumn::make('productCategories.prod_cat_name')
                    ->badge()
                    ->label('Product Category')
                    ->sortable()
                    ->color('warning')
                    ->formatStateUsing(fn (string $state) : string => ucwords($state)),

                ]),

               
            ])->collapsible(),
        

        ])
        ->contentGrid([
            'md' => 2,
            'xl' => 3,
        ])
        ->paginated([
            9,
            18,
            36,
            'all',
        ])
        ->filters([
            //
        ])
        ->actions([
            //Tables\Actions\ViewAction::make()->icon('heroicon-m-eye')->label(''),
           //Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make()->icon('heroicon-m-eye')->label(''),
                Tables\Actions\EditAction::make()->icon('heroicon-m-pencil')->label(''),
               
                Tables\Actions\DeleteAction::make()->icon('heroicon-m-trash')->label(''),
            //])->tooltip('Actions')
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('prod_requires_shipping')
                ->label('Require Shipping')
                ->icon('heroicon-o-truck')
                ->action(function (Collection $records): void {
                    $records->each(function ($record) {
                        $record->update([
                            'prod_requires_shipping' => !$record->prod_requires_shipping,
                        ]);
                    });
                })
                ->deselectRecordsAfterCompletion()
                ->requiresConfirmation()
                ->modalIcon('heroicon-o-truck')
                ->modalHeading('This action will make the selected product(s) require shipping or not.')
                ->modalDescription('Are you sure you want to make the selected product(s) require shipping?')
                ->modalSubmitActionLabel('Yes')
                ->color('success'),


                Tables\Actions\BulkAction::make('is_visible_to_market')
                ->label('Visible to Market')
                ->icon('heroicon-o-eye')
                ->action(function (Collection $records): void {
                    $records->each(function ($record) {
                        $record->update([
                            'is_visible_to_market' => !$record->is_visible_to_market,
                        ]);
                    });
                })
                ->deselectRecordsAfterCompletion()
                ->requiresConfirmation()
                ->modalIcon('heroicon-o-eye')
                ->modalHeading('This action will make the selected product(s) available to market.')
                ->modalDescription('Are you sure you want to make the selected product(s) available to market?')
                ->modalSubmitActionLabel('Yes')
                ->color('success'),

            ]),
        ])
        ->deferLoading()
        ->emptyStateActions([
            Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('New Product')),
        ])
        ->emptyStateIcon('heroicon-o-squares-plus')
        ->emptyStateHeading('No Products are created')
        ->defaultSort('created_at', 'desc');
}



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewProduct::class,
           Pages\EditProduct::class,
        ]);
    }
    
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoSection::make()
                ->schema([

                    ImageEntry::make('images.url')
                    ->hiddenLabel()
                    ->stacked()
                    ->limit(3)
                    ->height(100)
                    ->square(),

                    TextEntry::make('prod_name')
                    ->label('Product')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->weight(FontWeight::ExtraBold)
                    ->formatStateUsing(fn (string $state) : string => ucwords($state) ),

                    TextEntry::make('prod_sku')
                    ->label('SKU')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->weight(FontWeight::ExtraBold)
                    ->badge()
                    ->color('success')
                    ->copyable(),
                    // ->toolTip('Copy SKU'),
                   

                    ComponentsSection::make('Product Details')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('prod_short_description')
                        ->markdown()
                        ->weight(FontWeight::Bold)
                        ->label('Short Description: ')
                        ->formatStateUsing(fn (string $state) : string => ucfirst($state) )
                        ->columnSpan(2),

                        TextEntry::make('prod_description')
                        ->markdown()
                        ->weight(FontWeight::Bold)
                        ->label('Long Description:')
                        ->formatStateUsing(fn (string $state) : string => ucfirst($state) )
                        ->columnSpan(2),

                        // ComponentsGroup::make()
                        // ->schema([
                        //     TextEntry::make('prod_old_price')
                        //     ->size(TextEntrySize::Large)
                        //     ->label('Old Price:')
                        //     ->columnSpan(2),

                        //     TextEntry::make('prod_price')
                        //     ->size(TextEntrySize::Large)
                        //     ->label('Price:')
                        //     ->columnSpan(2),
                        // ])
                    ]),

                    // ComponentsSection::make('Product Prices')
                    // ->icon('heroicon-o-information-circle')
                    // ->schema([
                    //     TextEntry::make('prod_old_price')->markdown()->label('Old Price')->columnSpan(2),
                    //     TextEntry::make('prod_price')->markdown()->label('Price')->columnSpan(2),
                    // ]),
                    






                ])
            ]);
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'view' => Pages\ViewProduct::route('/{record}'),
        ];
    }

   
}
