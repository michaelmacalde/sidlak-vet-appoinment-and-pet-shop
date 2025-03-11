<?php

namespace App\Livewire\Ecommerce;

use Livewire\Component;
use App\Models\Ecommerce\Cart;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartCount extends Component
{


    protected $listeners = ['cartUpdated' => '$refresh']; // Refresh when cart updates

    public function getCartCountProperty()
    {
        if (Auth::check()) {
            //for authenticated users
            return Cart::where('user_id', Auth::id())->count();
        } else {
           //for guest users
            // return collect(Session::get('cart', []))->sum('quantity');
            // return array_sum(Session::get('cart', []));
            return Cart::where('session_id', Session::getId())->count();
        }
    }

    public function refreshCartCount()
    {
        $this->dispatchBrowserEvent('cart-updated');
    }

    #[Layout('layouts.app')]
    #[Title('Cart Count')]
    public function render()
    {
        return view('livewire.ecommerce.cart-count');
    }
}
