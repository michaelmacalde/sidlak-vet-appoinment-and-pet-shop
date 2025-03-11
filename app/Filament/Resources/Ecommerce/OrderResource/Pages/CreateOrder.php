<?php

namespace App\Filament\Resources\Ecommerce\OrderResource\Pages;

use App\Filament\Resources\Ecommerce\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
