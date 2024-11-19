<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

class LocalImages
{
    public const DOGS = 'dogs';
    public const POSTS = 'posts';
    /**
     * Get all image files for dogs.
     *
     * @return array
     */
    public static function getAllFiles(?string $category = LocalImages::DOGS): array
    {
        return File::files(database_path('seeders/local_images/' . $category));
    }

     /**
     * Get all image files for dogs.
     *
     * @return array
     */
    public static function getFeaturedImage(?string $posts = LocalImages::POSTS): array
    {
        return File::files(database_path('seeders/local_images/' . $posts));
    }
}
