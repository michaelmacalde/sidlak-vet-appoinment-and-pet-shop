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
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
                Select::make('user_id')
                    ->label('Customer')
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->preload()
                    ->optionsLimit(5)
                    ->searchable()
                    ->getOptionLabelFromRecordUsing(fn ($record) => ucwords($record->name)),
              

                ToggleButtons::make('order_status')
                    ->options(OrderStatusEnum::class)
                    ->inline()
                    ->default(OrderStatusEnum::New)
                    ->dehydrated()
                    ->required()
                    ->label('Order Status'),

                ToggleButtons::make('payment_status')
                    ->options(PaymentStatusEnum::class)
                    ->default(PaymentStatusEnum::Pending)
                    ->inline()
                    ->dehydrated()
                    ->required()
                    ->label('Payment Status'),
            ]) ->columns(2);
            
           
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->sortable()
                    ->formatStateUsing(fn (string $state) : string => ucwords($state)) 
                    ->searchable(),

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
