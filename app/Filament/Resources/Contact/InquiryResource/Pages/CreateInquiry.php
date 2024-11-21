<?php

namespace App\Filament\Resources\Contact\InquiryResource\Pages;

use App\Filament\Resources\Contact\InquiryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInquiry extends CreateRecord
{
    protected static string $resource = InquiryResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
