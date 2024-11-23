<?php

namespace App\Livewire\Pages;

use App\Models\Adoption\Adoption;
use Livewire\Component;

class AdoptionRequests extends Component
{
    public $adoptionRequests;
    public $viewAdoptionRequest;
    public $isModalOpen = false;

    public function mount()
    {
       $this->adoptionRequests = Adoption::with(['applicationForm','user', 'dog'])->where('user_id', auth()->id())->get();
    }

    public function viewRequest($requestId)
    {
        $this->viewAdoptionRequest = Adoption::with(['applicationForm', 'user', 'dog'])
            ->where('id', $requestId)
            ->first();
        $this->isModalOpen = true;

    }



    public function render()
    {
        return view('livewire.pages.adoption-requests');

    }
}
