<?php

namespace App\Helpers;

use App\Models\Adoption\AdoptionCart;
use Illuminate\Support\Facades\DB;

class AdoptionHelper
{
    public static function adoptDog($userId, $dogId, $dispatcher)
    {
        $data = [
            'user_id' => $userId,
            'dog_id' => $dogId,
        ];

        $getAdoptionCart = AdoptionCart::where('user_id', $data['user_id'])->where('dog_id', $data['dog_id'])->first();

        if ($getAdoptionCart) {
            $dispatcher->alert('error', '', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'This dog is already in your selected adoption.',
            ]);
            return false;
        }

        try {
            DB::transaction(function () use ($data, $dispatcher) {
                AdoptionCart::updateOrCreate(
                    [
                        'user_id' => $data['user_id'],
                        'dog_id' => $data['dog_id']
                    ],
                    $data
                );

                $dispatcher->dispatch('add-to-adoption-cart')->to(\App\Livewire\Adoption\AdoptionCartCounter::class);

                $dispatcher->alert('success', '', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Successfully added',
                ]);
            });
            return true;
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create volunteer. Please try again.');
            return false;
        }
    }
}
