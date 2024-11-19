<?php

namespace App\Filament\Resources\Blog\BlogPostResource\Pages;

use App\Filament\Resources\Blog\BlogPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogPosts extends ListRecords
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-m-plus'),
        ];
    }
}
