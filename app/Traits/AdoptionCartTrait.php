<?php

namespace App\Traits;

use App\Models\Adoption\AdoptionCart;

trait AdoptionCartTrait
{
    public function getAdoptionCartInfo($userId, $dogId)
    {
        return AdoptionCart::getCartInfo($userId, $dogId)->first();
    }
}
