<?php

namespace App\Filament\Resources\Ecommerce\ProductCategoryResource\Pages;

use App\Filament\Resources\Ecommerce\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductCategory extends EditRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
