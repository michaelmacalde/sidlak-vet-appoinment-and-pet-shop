<?php

namespace App\Livewire\Pages;

use App\Livewire\Traits\WithDogBreeds;
use App\Traits\AdoptableDog;
use App\Models\Animal\Dog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class DogSinglePage extends Component
{
    use WithDogBreeds, AdoptableDog;

    #[Locked]
    private $dog_slug;

    #[Locked]
    #[Rule('required|integer|exists:dogs,id')]
    public $adopt_id;

    public Dog $dog;

    public function mount($dog_slug){
        $this->dog_slug = $dog_slug;
        $this->dog = Dog::with(['breed:id,breed_name,breed_slug', 'medicalRecords'])
            ->where('dog_slug', $this->dog_slug)
            ->where('status', 'available')
            ->withLimitedDescriptionAndSecureKey()
            ->firstOrFail();

        $this->adopt_id = $this->dog->id;
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.dog-single-page',[
            'dog' => $this->dog,
            'dogBreeds' => $this->getDogBreedsPage()
        ])->title($this->dog->dog_name . '(' . $this->dog->breed->breed_name . ') - ' . config('app.name'));
    }
}
