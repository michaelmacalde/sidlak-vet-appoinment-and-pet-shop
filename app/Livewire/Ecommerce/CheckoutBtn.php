<?php

namespace App\Livewire\Ecommerce;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class CheckoutBtn extends Component
{

    public $selectedItems = [];


    // authenticated user direct to checkout page
    public function checkout(){
        return (!Auth::check() && Auth::id()) ? route('login')
               : route('checkout',['items' => $this->selectedItems]);
    }

    #[Layout('layouts.app')]
    #[Title('Checkout-btn')]
    public function render()
    {
        return view('livewire.ecommerce.checkout-btn');
    }
}
