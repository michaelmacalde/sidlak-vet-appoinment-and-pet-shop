<?php

namespace App\Filament\Resources\Contact\InquiryResource\Pages;

use App\Filament\Resources\Contact\InquiryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInquiry extends EditRecord
{
    protected static string $resource = InquiryResource::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
