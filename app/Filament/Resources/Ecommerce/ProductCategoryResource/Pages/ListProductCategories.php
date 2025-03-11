<?php

namespace App\Filament\Resources\Ecommerce\ProductCategoryResource\Pages;

use App\Filament\Resources\Ecommerce\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New Product Category')->icon('heroicon-m-plus-circle'),
        ];
    }
}
