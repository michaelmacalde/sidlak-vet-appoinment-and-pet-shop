<?php

namespace App\Traits;

use App\Models\Adoption\AdoptionCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Rule;

trait AdoptableDog
{
    #[Locked]
    #[Rule('required|integer|exists:dogs,id')]
    public $adopt_id;

    private $get_user_adopt_count = 0;

    public function adoptDog($id)
    {

       $this->get_user_adopt_count = $this->getUserAdoptCount();

        if (!auth()->check()) {
            return $this->redirect(route('login'));
        }

        if($this->get_user_adopt_count > 2){
            return;
        }

        $this->adopt_id = $id;

        try {

            DB::transaction(function () {
                AdoptionCart::updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'dog_id' => $this->adopt_id,
                    ],
                    [
                        'updated_at' => now()
                    ]
                );
            });

            $this->dispatchAlert('success', 'Successfully added to adoption cart');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatchAlert('error', 'Invalid dog selection.');
            Log::warning('Adoption validation error: ' . $e->getMessage());
        } catch (\Exception $e) {
            $this->dispatchAlert('error', 'Failed to add to adoption cart. Please try again.');
            Log::error('Adoption cart error: ' . $e->getMessage());
        }
    }

    protected function dispatchAlert($type, $message)
    {
        $this->dispatch('alert', [
            'type' => $type,
            'message' => $message,
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    protected function getUserAdoptCount(){

        return AdoptionCart::where('user_id', auth()->id())->count();
    }

    // public function updateadoptCount()
    // {
    //     $this->adoptCount = AdoptionCart::where('user_id', auth()->id())->count();
    // }

    // Add this method to the trait
    // public function getadoptCount()
    // {
    //     return $this->adoptCount = AdoptionCart::where('user_id', auth()->id())->count();
    // }
}
