<?php

namespace App\Filament\Resources\Ecommerce;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\OrderStatusEnum;
use App\Models\Ecommerce\Order;
use App\Enums\PaymentStatusEnum;
use Filament\Resources\Resource;
use App\Models\Ecommerce\Product;
// use Filament\Resources\Pages\Page;
use App\Ecommerce\Models\OrderItem;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use Filament\Pages\Page;
use App\Filament\Resources\Ecommerce\OrderResource\Pages;
use App\Filament\Resources\Ecommerce\OrderResource\RelationManagers;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationGroup = 'Ecommerce';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?int $navigationSort = 3;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        $count = static::getModel()::count();

        return match (true) {
            $count  == 0 => 'danger',      // No orders: danger
            $count < 10  => 'warning',    //less than 10 orders: warning
            default      => 'success',     // Many orders: success
        };
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Order Details')
                ->schema([
                    Select::make('user_id')
                        ->label('Customer')
                        ->relationship(name: 'user', titleAttribute: 'name')
                        ->preload()
                        ->optionsLimit(5)
                        ->required()
                        ->searchable()
                        ->getOptionLabelFromRecordUsing(fn ($record) => ucwords($record->name))
                        ->createOptionForm([
                            Section::make('User Details')
                                ->description('The user\'s name and email address.')
                                ->schema([
                                    TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),

                                    TextInput::make('email')
                                    ->required()
                                    ->email()
                                    ->unique(ignoreRecord: true),

                                    TextInput::make('password')
                                    ->password()
                                    ->revealable()
                                    // ->required(fn (Page $livewire): bool => $livewire instanceof EditUser)
                                    // ->visible(fn (Page $livewire): bool => $livewire instanceof CreateUser)
                                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
                                    

                                    TextInput::make('password_confirmation')
                                    ->label('Confirm Password')
                                    ->password()
                                    ->same('password')
                                    // ->required(fn (Page $livewire): bool => $livewire instanceof EditUser)
                                    // ->visible(fn (Page $livewire): bool => $livewire instanceof CreateUser)
                                    ->revealable(),
                                    
                            ])->columns(2),
                        ]),
                       
    
                    ToggleButtons::make('order_status')
                        ->options(OrderStatusEnum::class)
                        ->default(OrderStatusEnum::New)
                        ->dehydrated()
                        ->inline()
                        ->required()
                        ->label('Order Status'),
    
                    ToggleButtons::make('payment_status')
                        ->options(PaymentStatusEnum::class)
                        ->default(PaymentStatusEnum::Pending)
                        ->inline()
                        ->dehydrated()
                        ->required()
                        ->label('Payment Status'),


                   
                ])
                ->columns(1),

                Section::make('Addresses')
                ->schema([
                    Select::make('shipping_address_id')
                        ->label('Shipping Address')
                        ->relationship(name: 'shippingAddress', titleAttribute: 'full_address')
                        ->preload()
                        ->required()
                        ->optionsLimit(5)
                        ->searchable()
                        ->createOptionForm([
                            TextInput::make('street')->required(),
                            TextInput::make('city')->required(),
                            TextInput::make('state')->required(),
                            TextInput::make('zip')->required(),
                            Hidden::make('address_type')->default('shipping'),
                        ]),

                    Select::make('billing_address_id')
                        ->label('Billing Address')
                        ->relationship(name: 'billingAddress', titleAttribute: 'full_address')
                        ->preload()
                        ->required()
                        ->dehydrated()
                        ->optionsLimit(5)
                        ->searchable()
                        ->createOptionForm([
                            TextInput::make('street')->required(),
                            TextInput::make('city')->required(),
                            TextInput::make('state')->required(),
                            TextInput::make('zip')->required(),
                            Hidden::make('address_type')->default('billing'),
                        ]),
                        
                    Toggle::make('is_billing_same_as_shipping')
                        ->label('Billing same as Shipping')
                        ->reactive()
                        ->afterStateUpdated(fn ($state, $set, $get) => 
                            $state ? $set('billing_address_id', $get('shipping_address_id')) : null
                        ),
                ])
                ->columns(2),       



    
            Section::make('Order Items')
                ->schema([
                    Repeater::make('orderItems')
                        ->label('')
                        ->relationship('orderItems') 
                        ->schema([
                            Select::make('product_id')
                                ->label('Product')
                                ->relationship(name: 'product', titleAttribute: 'prod_name')
                                ->preload()
                                // ->multiple()
                                ->optionsLimit(5)
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(fn ($state, $set) => 
                                    $set('price', Product::find($state)?->prod_price)
                                   
                                 )
                                  ->getOptionLabelFromRecordUsing(fn ($record) => ucwords($record->prod_name)),
                            
                            TextInput::make('price')
                                ->numeric()
                                ->required()
                                ->dehydrated()
                                ->required()
                                ->label('Price')
                                ->disabled(),
                               

                            TextInput::make('quantity')
                                ->numeric()
                                ->minValue(1)
                                ->required()
                                ->maxValue(fn ($get) => Product::find($get('product_id'))?->prod_quantity ?? 1)
                                ->reactive()
                                ->afterStateUpdated(fn ($state, $set, $get) => 
                                    $set('total', ($get('price')) * ($state))
                                )
                                ->label('Quantity'),
    
                          
    
                            TextInput::make('total')
                                ->numeric()
                                ->required()
                                ->dehydrated()
                                ->minValue(0)
                                ->label('Total')
                                ->disabled(), 
                              
                                
                        ])->columns(2)
                          //->addable(false)
                          ->addActionLabel('Add Item')      
                          ->deletable(fn ($get) => count($get('orderItems')) > 1) 
                          ->reorderable(),
                 ]),
        ]);
    
            
           
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Customer Name')
                    ->sortable()
                    ->formatStateUsing(fn (string $state) : string => ucwords($state)) 
                    ->searchable(),

                TextColumn::make('orderItems.product.prod_name')
                    ->label('Product Ordered')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn (string $state) : string => ucwords($state)),

                ImageColumn::make('images.url')
                    ->label('Product Image')
                    ->circular()
                    ->height(50)
                    ->width(50)
                    ->limit(1)
                    ->getStateUsing(fn ($record) => 
                    $record->orderItems->first()?->product->images()
                        ->where('is_primary', true)
                        ->value('url')
                        
                    ?? 

                    $record->orderItems->first()?->product->images()
                        ->orderBy('created_at')
                        ->value('url')
                ),



                TextColumn::make('order_status')
                    ->label('Order Status')
                    ->formatStateUsing(fn ($state) => OrderStatusEnum::tryFrom($state)?->getLabel() ?? 'Unknown') // display label halin sa orderstatusenum
                    ->color(fn ($state) => OrderStatusEnum::tryFrom($state)?->getColor() ?? 'gray') 
                    ->icon(fn ($state) => OrderStatusEnum::tryFrom($state)?->getIcon() ?? null)
                    ->sortable(),

                 TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->formatStateUsing(fn ($state) => PaymentStatusEnum::tryFrom($state)?->getLabel() ?? 'Unknown') // display label halin sa paymentstatusenum
                    ->color(fn ($state) => PaymentStatusEnum::tryFrom($state)?->getColor() ?? 'gray') 
                    ->icon(fn ($state) => PaymentStatusEnum::tryFrom($state)?->getIcon() ?? null)
                    ->sortable(),

               
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
            ])->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('New Order')),
            ])
            ->emptyStateIcon('heroicon-o-shopping-cart')
            ->emptyStateHeading('No Orders are created');
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
