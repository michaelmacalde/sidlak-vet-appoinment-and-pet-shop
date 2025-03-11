<?php

namespace App\Livewire\Pages;

use App\Mail\VolunteerWelcome;
use App\Models\Role;
use App\Models\User;
use App\Models\Volunteer\Volunteer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role as ModelsRole;

class VolunteerPage extends Component
{
    #[Validate('required|max:255',as:'First Name', message: 'The first name field is required.')]
    public $v_first_name;

    #[Validate('required|max:255', as: 'Last Name', message: 'The last name field is required.')]
    public $v_last_name;

    #[Validate('required|email|max:255', as: 'Email', message: 'The email field is required.')]
    public $v_email;

    #[Validate('required|max:255', as: 'Role', message: 'The role field is required.')]
    public $v_role;

    #[Validate('required|max:65535', as: 'Reason', message: 'The reason field is required.')]
    public $v_reason;

    protected function ensureVolunteerRoleExists()
    {
        $volunteerRole = ModelsRole::where('name', 'volunteer')->first();

        if (!$volunteerRole) {
            // Create the volunteer role if it doesn't exist
            ModelsRole::create(['name' => 'volunteer', 'guard_name' => 'web']);
        }
    }

    public function submit()
    {
        $this->validate();

        $data = $this->sanitizeVolunteerInputArray([
            'v_first_name' => $this->v_first_name,
            'v_last_name' => $this->v_last_name,
            'v_email' => $this->v_email,
            'v_role' => $this->v_role,
            'v_reason' => $this->v_reason,
        ]);

        try {
            DB::transaction(function () use ($data) {
                $name = $data['v_first_name'] . ' ' . $data['v_last_name'];
                $temporaryPassword = Str::random(8);

                $user = User::updateOrCreate(
                    ['email' => $data['v_email']],
                    [
                        'name' => $name,
                        'password' => Hash::make($temporaryPassword),
                    ]
                );

                // Ensure volunteer role exists before assigning
                $this->ensureVolunteerRoleExists();

                // Assign the volunteer role
                if (!$user->hasRole('volunteer')) {
                    $user->assignRole('volunteer');
                }

                Volunteer::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'volunteer_role' => $data['v_role'],
                        'volunteer_reason' => $data['v_reason'],
                        'volunteer_status' => 'inactive',
                        'volunteer_joined_date' => now(),
                    ]
                );

                $token = app('auth.password.broker')->createToken($user);
                Mail::to($user->email)->send(new VolunteerWelcome($name, $temporaryPassword, $data['v_role'], $token));

                session()->flash('message', 'Thank you for making a difference. Please check your email for password setup. Thank you!');
            });

            $this->reset(['v_first_name', 'v_last_name', 'v_email', 'v_role', 'v_reason']);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create volunteer. Please try again.');
        }
    }

    #[Title('Make a Difference Through Volunteering')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.volunteer-page');
    }

    protected function sanitizeVolunteerInput($input)
    {
        return trim(strip_tags($input));
    }

    protected function sanitizeVolunteerInputArray($data)
    {
        return array_map([$this, 'sanitizeVolunteerInput'], $data);
    }
}
