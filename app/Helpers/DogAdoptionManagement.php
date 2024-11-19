<?php

namespace App\Helpers;

use App\Models\Animal\Dog;
use Illuminate\Support\Facades\Cookie;

class DogAdoptionManagement
{
    // Add adoption item
    static public function addDogAdoptionItem($id)
    {
        $adoption_items = self::getAllDogAdoptionItemsFromCookies();
        $existing_item = null;

        foreach ($adoption_items as $key => $item) {
            if ($item['id'] == $id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            // If item exists, remove it first
            self::removeDogAdoptionItem($id);
        }

        $dog = Dog::with('breed:id,breed_name,breed_slug')
                    ->where('id', $id)
                    ->first(['id', 'dog_image', 'dog_name', 'breed_id', 'dog_gender', 'dog_age', 'dog_short_description']);

        if ($dog && isset($dog->dog_image[0]['dog_image'])) {
            $adoption_items[] = [
                'id' => $dog->id,
                'dog_name' => $dog->dog_name,
                'dog_image' => $dog->dog_image[0]['dog_image'],
                'dog_breed' => $dog->breed->breed_name,
                'dog_gender' => $dog->dog_gender,
                'dog_age' => $dog->dog_age,
                'dog_short_description' => $dog->dog_short_description
            ];
        }

        self::addDogAdoptionToCookies($adoption_items);
        return $adoption_items;
    }

    // Remove adoption item
    static public function removeDogAdoptionItem($id)
    {
        $adoption_items = self::getAllDogAdoptionItemsFromCookies();

        foreach ($adoption_items as $key => $item) {
            if ($item['id'] == $id) {
                unset($adoption_items[$key]);
                break;
            }
        }

        self::addDogAdoptionToCookies($adoption_items);
        return $adoption_items;
    }

    // Add adoption items to cookies
    static public function addDogAdoptionToCookies($dog)
    {
        Cookie::queue('adoption_items', json_encode($dog), 60);
    }

    // Clear all adoption items from cookies
    static public function clearDogAdoptionItems()
    {
        Cookie::queue(Cookie::forget('adoption_items'));
    }

    // Get all adoption items from cookies
    static public function getAllDogAdoptionItemsFromCookies()
    {
        $adoption_items = json_decode(Cookie::get('adoption_items'), true);

        if (!$adoption_items) {
            $adoption_items = [];
        }

        return $adoption_items;
    }
}
