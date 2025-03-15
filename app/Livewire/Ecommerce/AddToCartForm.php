<?php

namespace App\Livewire\Ecommerce;

use Livewire\Component;
use App\Models\Ecommerce\Cart;
use Livewire\Attributes\Layout;
use App\Models\Ecommerce\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
Use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class AddToCartForm extends Component
{
    use LivewireAlert;

    public $product_id;
    public $session_id;
    public $quantity;
    public $user_id;
    public $cartItems;

    // Validation rules (if needed)
    protected $rules = [
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|numeric|min:1',
    ];

    // Sanitize input
    protected function sanitizeInput(array $data): array
    {
        return array_map(function ($value) {
            return is_array($value) ? $this->sanitizeInput($value) : strip_tags($value);
        }, $data);
    }

    public function mount()
    {
        if (!Session::isStarted()) {
            Session::start();
        }
        $this->session_id = Session::getId(); // get session id for guest user
        $this->user_id = Auth::id(); // Kwa id sa Authenticated user
        $this->getCartItems(); // Load cart items
    }

    public function addToCart()
    {   
       
       // default quantity
        $product = Product::find($this->product_id);

        if (!$product ) {
            
            //session()->flash('message', 'Product not found ');
            $this->alert('warning','', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Product not found!',
            ]);
            return;
        }

        $session_id = $this->session_id; 
        $user_id = $this->user_id; //kwa user id ara sa mount function


        //if user naka login store store sa account ya ang cart item
        if ($user_id) {
            Cart::where('session_id', $session_id)
                ->update(['user_id' => $user_id, 'session_id' => null]);
        }
        // Check if the product is already in the cart
        $cart = Cart::where('product_id', $product->id)
            ->where(function ($query) use ($user_id, $session_id) {
                if ($user_id) { // para sa logged-in user
                    $query->where('user_id', $user_id);
                } else { // windows shopping or guest
                    $query->where('session_id', $session_id);
                }
            })->first();

        // if item ga exist sa cart + 1 else add sa cart another item
        // if ($cart) {
        //     $cart->quantity += 1;
        //     $cart->save();
        // } else {
        //     Cart::create([
        //         'product_id' => $product->id,
        //         'user_id' => $user_id,
        //         'session_id' => $session_id,
        //         'quantity' => $quantity,
        //     ]);
        // }

            // check if ang unit is equal to kg ma add ka qunatity base sa weight else quantity
        $quantityAdd = ($product->prod_unit =='kg') ? $product->prod_weight : 1;

        if ($cart) {
            if($cart->quantity + $quantityAdd > $product->prod_quantity){ // if stock cart quantity
                                                          //mg lapaw sa product quantity throw error message
                // session()->flash('error_message', 'Not enough stock available');
                $this->alert('warning','', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Not enough stock available!',
                ]);
                
                return;
            }
            $cart->quantity += $quantityAdd;
            $cart->save();
        } else {
            Cart::create([
                'product_id' => $product->id,
                 'user_id' => $user_id ?: null,
                'session_id' => $user_id ? null : $session_id, // if si user naka login null ang value da session id else session_id
                'quantity' => $quantityAdd,
            ]);
        }

        
        $this->dispatch('cartUpdated');
       
        // $this->emit('cartUpdated');
        // Refresh cart items after adding
        // session()->flash('message', 'Product added to cart!');
        $this->alert('success','', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Product added to cart!',
        ]);
        
        $this->getCartItems();
    }

    
    public function getCartItems(){
        // $this->cartItems = Cart::where('user_id',Auth::id())
        //      ->orWhere('session_id',$this->session_id)  ara sa mount function to get session id
        //      ->get();

        $this->cartItems = Cart::where(function ($query) {
                if (Auth::check()) {
                    $query->where('user_id', $this->user_id);
                } else {
                    $query->where('session_id', $this->session_id);
                }
        })->get();
    }


   




    #[Layout('layouts.app')]
    #[Title('Add to Cart')]
    public function render()
    {
       
        return view('livewire.ecommerce.add-to-cart-form',[
            'cartItems' => $this->cartItems
        ]);
    }
}
