<?php

namespace App\Filament\Resources\Ecommerce\ProductResource\Pages;

use App\Filament\Resources\Ecommerce\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    
}
