<?php

namespace App\Livewire\Pages;

use App\Models\Adoption\Adoption;
use App\Models\Adoption\AdoptionCart;
use App\Models\Application\ApplicationForm as ApplicationApplicationForm;
use App\Models\Application\PetDetails;
use App\Rules\UniqueContactDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ApplicationForm extends Component
{
    public $dog;
    public $type_of_home;
    public $is_own_home = 1;
    public $owners_name;
    public $temporary_address;
    public $permanent_address;
    public $contact_details = [['phone_number' => '', 'telephone_number' => '']];
    public $has_any_pet = 0;
    public $pet_details = [['pet_name' => '', 'species' => '']];
    public $preferred_date;
    public $preferred_time;
    public $can_visit_shelter = 1;
    public $dogDetails;
    public $dog_selected;

    public function rules(){
        return [
            'type_of_home' => 'required|in:home,apartment,villa,other',
            'owners_name' => 'nullable|string|max:255',
            'is_own_home' => 'boolean',
            'temporary_address' => 'nullable|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'contact_details.*.phone_number' => ['required', 'regex:/^(\+\d{12}$)|(^\d{11}$)/'],
            'contact_details.*.telephone_number' => 'required|string|max:15',
            'has_any_pet' => 'boolean',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'can_visit_shelter' => 'boolean',
            'pet_details.*.pet_name' => 'nullable|string|max:255',
            'pet_details.*.species' => 'nullable|string|max:255',
            'contact_details' => [new UniqueContactDetails],
        ];
    }

    public function messages()
    {
        return [
            'contact_details.*.phone_number.required' => 'The phone number field is required.',
            'contact_details.*.telephone_number.required' => 'The telephone number field is required.',
        ];
    }

    public function mount(): void
    {
        $this->refreshDogSelected();
        // $this->dog_selected = AdoptionCart::with(['dog:id,breed_id,dog_name,dog_slug,dog_age,dog_gender,dog_image','dog.breed:id,breed_name'])->where('user_id', auth()->id())->get();
    }

    private function refreshDogSelected(): void
    {
        $this->dog_selected = AdoptionCart::with(['dog:id,breed_id,dog_name,dog_slug,dog_age,dog_gender,dog_image','dog.breed:id,breed_name'])
            ->where('user_id', auth()->id())
            ->get();
    }

    public function addContact()
    {
        $this->contact_details[] = ['phone_number' => '', 'telephone_number' => ''];
    }

    public function addPet()
    {
        $this->pet_details[] = ['pet_name' => '', 'species' => ''];
    }

    public function removeContact($index)
    {
        unset($this->contact_details[$index]);
        $this->contact_details = array_values($this->contact_details);
    }

    public function removePet($index)
    {
        unset($this->pet_details[$index]);
        $this->pet_details = array_values($this->pet_details);
    }

    protected function sanitizeInput(array $data): array
    {
        return array_map(function ($value) {
            if (is_array($value)) {
                return $this->sanitizeInput($value);
            }
            return htmlspecialchars(strip_tags($value));
        }, $data);
    }

    public function submit()
    {
        $validatedData = $this->validate();
        $sanitizedData = $this->sanitizeInput($validatedData);

        DB::transaction(function () use ($sanitizedData) {
            $userId = Auth::id();


            $applicationForm = ApplicationApplicationForm::updateOrCreate(
                [
                    'user_id' => $userId,
                    // 'dog_id' => $dogId,
                ],
                [
                    'type_of_home' => $sanitizedData['type_of_home'],
                    'owners_name' => $sanitizedData['owners_name'],
                    'is_own_home' => (bool)$sanitizedData['is_own_home'],
                    'temporary_address' => $sanitizedData['temporary_address'],
                    'permanent_address' => $sanitizedData['permanent_address'],
                    'contact_details' => $sanitizedData['contact_details'],
                    'has_any_pet' => (bool)$sanitizedData['has_any_pet'],
                    'preferred_date' => $sanitizedData['preferred_date'],
                    'preferred_time' => $sanitizedData['preferred_time'],
                    'can_visit_shelter' => (bool)$sanitizedData['can_visit_shelter'],
                ]
            );

            foreach ($this->dog_selected as $cartItem) {
                $dogId = $cartItem->dog->id;

                if ($sanitizedData['has_any_pet']) {
                    $petDetails = array_map(function ($petDetail) use ($applicationForm) {
                        return [
                            'application_form_id' => $applicationForm->id,
                            'pet_name' => $petDetail['pet_name'],
                            'species' => $petDetail['species'],
                        ];
                    }, $sanitizedData['pet_details']);

                    PetDetails::insert($petDetails);
                }

                Adoption::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'dog_id' => $dogId,
                    ],
                    [
                        'adoption_number' => 'AR-' . date('Ymd-His-') . random_int(100000, 999999),
                        'status' => 'pending',
                        'application_form_id' => $applicationForm->id,
                        'request_date' => now(),
                    ]
                );


                AdoptionCart::where('user_id', auth()->id())->where('dog_id', $dogId)->delete();
            }
        });

        session()->flash('message', 'Application submitted successfully.');

        $this->resetExcept(['dog_selected']);

        // $this->dog_selected = AdoptionCart::with(['dog:id,breed_id,dog_name,dog_slug,dog_age,dog_gender,dog_image','dog.breed:id,breed_name'])
        // ->where('user_id', auth()->id())
        // ->get();

        $this->refreshDogSelected();

        // $this->reset();

        // $validatedData = $this->validate();
        // $sanitizedData = $this->sanitizeInput($validatedData);

        // DB::transaction(function () use ($sanitizedData) {
        //     $userId = Auth::id();
        //     $dogId = $this->dog->id;

        //     $applicationForm = ApplicationForm::updateOrCreate(
        //         [
        //             'user_id' => $userId,
        //             'dog_id' => $dogId,
        //         ],
        //         [
        //             'type_of_home' => $sanitizedData['type_of_home'],
        //             'owners_name' => $sanitizedData['owners_name'],
        //             'is_own_home' => $sanitizedData['is_own_home'],
        //             'temporary_address' => $sanitizedData['temporary_address'],
        //             'permanent_address' => $sanitizedData['permanent_address'],
        //             'contact_details' => $sanitizedData['contact_details'],
        //             'has_any_pet' => $sanitizedData['has_any_pet'],
        //             'preferred_date' => $sanitizedData['preferred_date'],
        //             'preferred_time' => $sanitizedData['preferred_time'],
        //             'can_visit_shelter' => $sanitizedData['can_visit_shelter'],
        //         ]
        //     );

        //     // if ($sanitizedData['has_any_pet']) {
        //     //     foreach ($sanitizedData['pet_details'] as $petDetail) {
        //     //         PetDetails::create([
        //     //             'application_form_id' => $applicationForm->id,
        //     //             'pet_name' => $petDetail['pet_name'],
        //     //             'species' => $petDetail['species'],
        //     //         ]);
        //     //     }
        //     // }

        //     if ($sanitizedData['has_any_pet']) {
        //         $petDetails = array_map(function ($petDetail) use ($applicationForm) {
        //             return [
        //                 'application_form_id' => $applicationForm->id,
        //                 'pet_name' => $petDetail['pet_name'],
        //                 'species' => $petDetail['species'],
        //             ];
        //         }, $sanitizedData['pet_details']);

        //         PetDetails::insert($petDetails);
        //     }


        //     if ($applicationForm->exists) {
        //         Adoption::updateOrCreate(
        //             [
        //                 'user_id' => $userId,
        //                 'dog_id' => $dogId,
        //             ],
        //             [
        //                 'adoption_number' => 'AR-' . date('Ymd-His-') . random_int(100000, 999999),
        //                 'status' => 'pending',
        //                 'request_date' => now(),
        //             ]
        //         );
        //     }
        // });

        // session()->flash('message', 'Application submitted successfully.');

        // $this->reset();
    }

    #[Title('Create Application Form')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.application-form',[
            'selected_dogs' => $this->dog_selected
        ]);
    }
}
