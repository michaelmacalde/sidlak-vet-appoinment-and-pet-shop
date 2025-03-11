<?php

namespace App\Filament\Resources\Ecommerce\ProductCategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\Ecommerce\ProductCategoryResource;

class ViewProductCategory extends ViewRecord
{
    protected static string $resource = ProductCategoryResource::class;


    public function getTitle(): string | Htmlable
    {
        /** @var ProductCategory */
        $record = $this->getRecord();

        return ucwords($record->prod_cat_name);
    }
}
