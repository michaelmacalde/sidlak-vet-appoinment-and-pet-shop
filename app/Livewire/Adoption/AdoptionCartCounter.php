<?php

namespace App\Livewire\Adoption;

use App\Models\Adoption\AdoptionCart;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class AdoptionCartCounter extends Component
{
    public $count = 0;

    #[On('add-to-adoption-cart')]
    public function getAdoptionCartCount()
    {
        if (auth()->check()) {
            $this->count = AdoptionCart::where('user_id', auth()->id())->count();
        } else {
            $this->count = 0;
        }
    }

    #[Title('Dog Lists')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.adoption.adoption-cart-counter',[
            'count' => $this->count
        ]);
    }
}
