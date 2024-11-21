<?php

namespace App\Filament\Resources\Contact\InquiryResource\Pages;

use App\Filament\Resources\Contact\InquiryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInquiries extends ListRecords
{
    protected static string $resource = InquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-m-plus')->label('New Inquiry'),
        ];
    }
}
