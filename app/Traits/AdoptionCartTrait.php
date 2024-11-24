<?php

namespace App\Traits;

use App\Models\Adoption\Adoption;
use App\Models\Adoption\AdoptionCart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

trait AdoptionCartTrait
{
    use LivewireAlert;
    public function getAdoptionCartInfo($userId, $dogId)
    {
        return AdoptionCart::getCartInfo($userId, $dogId)->first();
    }

}
