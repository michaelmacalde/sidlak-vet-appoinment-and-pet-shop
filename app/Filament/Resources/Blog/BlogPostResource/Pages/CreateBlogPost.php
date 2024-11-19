<?php

namespace App\Filament\Resources\Blog\BlogPostResource\Pages;

use App\Filament\Resources\Blog\BlogPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
