<?php

namespace App\Filament\Resources\Blog\BlogPostResource\Pages;

use App\Filament\Resources\Blog\BlogPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewBlogPost extends ViewRecord
{
    protected static string $resource = BlogPostResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var BlogPost */
        $record = $this->getRecord();
        return $record->post_title;
    }

    protected function getActions(): array
    {
        return [];
    }
}
