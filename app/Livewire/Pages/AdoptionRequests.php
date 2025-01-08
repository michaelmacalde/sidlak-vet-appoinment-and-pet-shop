<?php

namespace App\Livewire\Pages;

use App\Models\Adoption\Adoption;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AdoptionRequests extends Component
{
    use LivewireAlert;

    public $adoptionRequests;
    public $viewAdoptionRequest;
    public $isModalOpen = false;

    #[Locked]
    public $adoptId;

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

    public function removeAdoptionRequest($id){
        $this->adoptId = $id;
        try {
            DB::beginTransaction();

            $adoptionItem = Adoption::find($this->adoptId);

            if ($adoptionItem) {
                $adoptionItem->delete();

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


    public function render()
    {
        return view('livewire.pages.adoption-requests');

    }
}
