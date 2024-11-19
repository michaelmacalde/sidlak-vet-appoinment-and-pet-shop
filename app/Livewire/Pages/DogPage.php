<?php

namespace App\Livewire\Pages;

use App\Livewire\Adoption\AdoptionCartCounter;
use App\Livewire\Traits\WithDogBreeds;
use App\Models\Adoption\AdoptionCart;
use App\Models\Animal\Breed;
use App\Models\Animal\Dog;
use App\Traits\AdoptableDog;
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

    #[Url(as: 'q')]
    public $breed = '';

    #[Locked]
    public $dog_id_page;

    public $adopt_count = 0;
    public $adoptionStatus = [];

    // protected $queryString = ['breed', 'page' => ['except' => 1]];

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

    public function updateAdoptionStatus()
    {
        if (auth()->user()) {
            $adoptedDogs = AdoptionCart::where('user_id', auth()->user()->id)->pluck('dog_id')->toArray();
            $this->adoptionStatus = array_fill_keys($adoptedDogs, true);
        }
    }

    #[On('add-to-adoption-cart')]
    public function adopt($id){
        $this->dog_id_page = $id;

        if(auth()->user()){
            $data = [
                'user_id' => auth()->user()->id,
                'dog_id' => $this->dog_id_page,
            ];

            // $get_adoption_cart = AdoptionCart::query()->where('user_id', $data['user_id'])->where('dog_id', $data['dog_id'])->first();
            $adoption_cart_info = AdoptionCart::where('user_id', $data['user_id'])
                ->selectRaw('COUNT(*) as total_count')
                ->addSelect(['dog_exists' => AdoptionCart::where('user_id', $data['user_id'])
                    ->where('dog_id', $data['dog_id'])
                    ->selectRaw('COUNT(*)')
                ])
                ->first();


            if ($adoption_cart_info->dog_exists > 0) {
                   $this->alert('error', '', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'This dog is already in your selected adoption.',
                   ]);
                return;
            }


            if($adoption_cart_info->total_count >= 3){
                $this->alert('error', '', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'You can only select 3 dogs for adoption.',
                   ]);
                return;
            }

            try {

                DB::transaction(function () use ($data) {
                    AdoptionCart::updateOrCreate(
                        [
                            'user_id' => $data['user_id'],
                             'dog_id' => $data['dog_id']
                        ],
                        $data
                    );
                    $this->dispatch('add-to-adoption-cart')->to(AdoptionCartCounter::class);

                    $this->alert('success', '', [
                        'position' => 'bottom-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'Successfully added',
                       ]);
                });

            } catch (\Exception $e) {
                session()->flash('error', 'Failed to create volunteer. Please try again.');
            }

        }else{
            return redirect()->route('login');
        }

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
