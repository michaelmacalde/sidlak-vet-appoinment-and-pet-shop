<?php

namespace App\Traits;

use App\Livewire\Adoption\AdoptionCartCounter;
use App\Models\Adoption\AdoptionCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Rule;

trait AdoptableDog
{
    use LivewireAlert;
    use AdoptionCartTrait;
    use AdoptionTrait;

    #[Locked]
    #[Rule('required|integer|exists:dogs,id')]
    public $adopt_id;


    // #[On('add-to-adoption-cart')]
    public function adoptDog($id)
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'));
        }

        $getExists = $this->getAdoptionExists(auth()->id(), $id);

        if ($getExists > 0) {
            return $this->alert('error', '', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'This dog is already in your requested adoption.',
               ]);
        }


        $adoption_cart_info = $this->getAdoptionCartInfo(auth()->id(),  $id);



        if ($adoption_cart_info->dog_exists > 0) {

            return $this->alert('error', '', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'This dog is already in your selected adoption.',
               ]);
        }


        if($adoption_cart_info->total_count >= 3){
            return $this->alert('error', '', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'You can only select 3 dogs for adoption.',
               ]);
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

                $this->dispatch('add-to-adoption-cart')->to(AdoptionCartCounter::class);

                $this->alert('success', '', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Successfully added',
                   ]);
            });



        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatchAlert('error', 'Invalid dog selection.');

        } catch (\Exception $e) {
            $this->dispatchAlert('error', 'Failed to add to adoption cart. Please try again.');

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

    // protected function getUserAdoptCount(){

    //     return AdoptionCart::where('user_id', auth()->id())->count();
    // }
}
