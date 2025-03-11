<?php

namespace App\Livewire\Ecommerce;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Ecommerce\ProductReview;

class ProductReviewsForm extends Component
{

    public $review;
    public $rating;
    public $image_review;
    public $product_id;

    protected $rules = [
        'review' => 'required|string|max:500',
        'image_review' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'rating' => 'required|integer|min:1|max:5',
    ];

    //sanitize input
    protected function sanitizeInput(array $data): array
    {
        return array_map(function ($value) {
            return is_array($value) ? $this->sanitizeInput($value) : strip_tags($value);
        }, $data);
    }
    public function submitReview(){

        $this->validate();

        $img_path = $this->image_review ? $this->image_review->store('public') : null;

        $data = $this->sanitizeInput([
            'review' => $this->review,
            'rating' => $this->rating,
            'product_id' => $this->product_id,
        ]);

        ProductReview::create([
            'review' => $data['review'],
            'rating' => $data['rating'],
            'image_review' => $img_path,
            'product_id' => $data['product_id'],
            'user_id' => Auth::id(),
        ]);

        // session()->flash('success', 'Review submitted successfully!');
    }


    #[Layout('layouts.app')]
    #[Title('Product Reviews')]
    public function render()
    {
        return view('livewire.ecommerce.product-reviews-form');
    }
}
