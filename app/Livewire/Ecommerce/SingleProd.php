<?php

namespace App\Livewire\Ecommerce;
use Livewire\Component;
use Livewire\Attributes\Layout;

use Livewire\Attributes\Locked;
use App\Models\Ecommerce\Product;

class SingleProd extends Component
{
    public $product;
    #[Locked]
    private $prod_slug;

    

    public function mount($prod_slug)
    {
        $this->prod_slug = $prod_slug;
        $this->getSingleProd();
    }

    //get specific product
    public function getSingleProd(){
        $this->product = Product::with(['images','productCategories'])
        ->where([
            
            ['prod_slug', $this->prod_slug],
            ['is_visible_to_market',true]
        
        
        ])
        ->first();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.ecommerce.single-prod',[
            'product' => $this->product
        ]
    
    );
    }
}
