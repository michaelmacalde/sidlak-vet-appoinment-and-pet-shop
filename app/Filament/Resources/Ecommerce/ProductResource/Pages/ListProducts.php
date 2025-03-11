<?php

namespace App\Filament\Resources\Ecommerce\ProductResource\Pages;


use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Filament\Resources\Ecommerce\ProductResource;
use Filament\Tables;
class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New Product')->icon('heroicon-m-plus-circle'),
        ];
    }

   


}
