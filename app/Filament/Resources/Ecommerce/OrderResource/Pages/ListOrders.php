<?php

namespace App\Filament\Resources\Ecommerce\OrderResource\Pages;

use App\Filament\Resources\Ecommerce\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New Order')->icon('heroicon-m-plus-circle'),
        ];
    }
}
