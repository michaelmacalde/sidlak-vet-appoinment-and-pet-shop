<?php

namespace App\Livewire\Adoption;

use App\Models\Adoption\AdoptionCart as AdoptionAdoptionCart;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class AdoptionCart extends Component
{
    use LivewireAlert;

    #[Locked]
    public $adoptId;
    // #[Locked]
    public $adopt_items;

    #[Computed()]
    public function getAdoptItems(){
        if(!auth()->user()){
            return redirect()->route('login');
        }

        $this->adopt_items = AdoptionAdoptionCart::with(['dog:id,dog_name,dog_image,dog_slug,breed_id,dog_gender,dog_age','dog.breed:id,breed_name'])
                            ->where('user_id', auth()->user()->id)->get();

        return $this->adopt_items;
    }
    #[On('add-to-adoption-cart')]
    public function removeAdoptionItem($id){
        $this->adoptId = $id;
        try {
            DB::beginTransaction();

            $adoptionItem = AdoptionAdoptionCart::find($this->adoptId);

            if ($adoptionItem) {
                $adoptionItem->delete();

                $this->dispatch('add-to-adoption-cart')->to(AdoptionCartCounter::class);
                $this->alert('success', '', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Successfully deleted',
                   ]);

            } else {
                abort(404);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e; // or abort(500, 'Error deleting item');
        }
    }
    #[Title('Selected Dogs')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.adoption.adoption-cart',[
            'adopt_items' => $this->getAdoptItems()
        ]);
    }
}
