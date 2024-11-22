<?php

namespace App\Livewire\Pages;

use App\Livewire\Adoption\AdoptionCartCounter;
use App\Livewire\Traits\WithDogBreeds;
use App\Models\Adoption\AdoptionCart;
use App\Models\Animal\Breed;
use App\Models\Animal\Dog;
use App\Traits\AdoptableDog;
use App\Traits\AdoptionCartTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;

class DogPage extends Component
{
    use WithPagination;
    use WithDogBreeds;
    use LivewireAlert;
    use AdoptionCartTrait;
    use AdoptableDog;

    #[Url(as: 'q')]
    public $breed = '';

    #[Locked]
    public $dog_id_page;

    public $adopt_count = 0;
    public $adoptionStatus = [];

    #[Computed()]
    public function getDogsPage()
    {
        return Dog::with('breed:id,breed_name,breed_slug')
                ->where('status', 'available')
                ->when(Breed::where('breed_slug', $this->breed)->first(), function($query){
                    $query->withBreed($this->breed);
                } )
                // ->whereRelation('adoption', 'status', 'pending')
                ->paginate(6);

    }

    #[On('add-to-adoption-cart')]
    public function adopt($id){
        // call the adopt dog method sa adaptable dog traits
        $this->adoptDog($id);
    }

    #[Title('Dogs Page')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.dog-page', [
            'dogs' => $this->getDogsPage(),
            'dogBreeds' => $this->getDogBreedsPage(),

        ]);
    }
}
