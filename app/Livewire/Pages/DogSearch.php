<?php

namespace App\Livewire\Pages;

use App\Models\Animal\Dog;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DogSearch extends Component
{
    use WithPagination;
    #[Url(as: 'q')]
    public $query = '';

    public function updatedQuery()
    {
        $this->query = trim($this->query);
        $this->resetPage();
    }

    public function render()
    {
        $dogs = collect();

        if (strlen($this->query) > 2) {
            $dogs = Dog::with('breed')
                ->where('status', 'available')
                ->where(function ($query) {
                    $query->where('dog_name', 'like', '%' . $this->query . '%')
                        ->orWhereHas('breed', function ($query) {
                            $query->where('breed_name', 'like', '%' . $this->query . '%');
                        });
                })
                ->paginate(10);
        }

        return view('livewire.pages.dog-search', [
            'dogs' => $dogs
        ]);
    }
}
