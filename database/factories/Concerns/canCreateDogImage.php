<?php

namespace Database\Factories\Concerns;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Database\Seeders\LocalImages;

trait CanCreateDogImage
{
    protected static $unusedImages = null;

    public function createDogImage(): ?string
    {
        if (is_null(self::$unusedImages)) {
            self::$unusedImages = LocalImages::getAllFiles();
        }

        if (empty(self::$unusedImages)) {
            throw new \Exception("No more unique images available for dogs.");
        }

        $imageFile = array_pop(self::$unusedImages);
        $image = file_get_contents($imageFile->getPathname());
        $newFilename = Str::uuid() . '.jpg';

        Storage::disk('public')->put($newFilename, $image);

        return $newFilename;

    }

    public static function setUnusedImages($images)
    {
        self::$unusedImages = $images;
    }

    public static function getUnusedImages()
    {
        return self::$unusedImages;
    }
}
