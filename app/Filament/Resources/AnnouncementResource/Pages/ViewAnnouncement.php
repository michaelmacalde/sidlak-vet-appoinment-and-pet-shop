<?php

namespace App\Filament\Resources\AnnouncementResource\Pages;

use App\Filament\Resources\AnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewAnnouncement extends ViewRecord
{
    protected static string $resource = AnnouncementResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var Announcement */
        $record = $this->getRecord();
        return $record->announcement_title;
    }

    protected function getActions(): array
    {
        return [];
    }
}
