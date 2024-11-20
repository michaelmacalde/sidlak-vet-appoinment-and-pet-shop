<?php

namespace App\Livewire\Pages;

use App\Mail\ContactMail;
use App\Mail\InquirySubmitted;
use App\Models\Contact\Inquiry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactPage extends Component
{
   // public properties
   #[Validate('required|string|max:255', as: 'Firstname')]
   public $first_name;
   #[Validate('required|string|max:255', as: 'Lastname')]
   public $last_name;
   #[Validate('required|string|max:255', as: 'Phone')]
   public $phone;
   #[Validate('required|string|max:255', as: 'Email')]
   public $email;
   #[Validate('required|string|max:255', as: 'Subject')]
   public $subject;
   #[Validate('required|string|max:255', as: 'Message')]
   public $message;

   // submit inquiry
   public function submit()
   {
       // validate
       $validatedData = $this->validate();
       // sanitize
       $validatedData['name'] = $this->sanitizeContactInput($validatedData['first_name'] . ' ' . $validatedData['last_name']);
       // store
       $sanitizedData = $this->sanitizeContactInputArray($validatedData);

       DB::transaction(function () use ($sanitizedData) {
           // create inquiry
           $inquiry = Inquiry::create($sanitizedData);
           // send email
           Mail::to($this->email)->send(new ContactMail($inquiry));
       });

       // flash
       session()->flash('message', 'Inquiry successfully submitted.');

        // reset input fields
        $this->reset(['first_name', 'last_name', 'phone', 'email', 'subject', 'message']);
   }


   // sanitize input field
   protected function sanitizeContactInput($input)
   {
       return trim(strip_tags($input));
   }

   // functio to handle sanitize inputs
   protected function sanitizeContactInputArray($data)
   {
       return [
           'name' => $data['name'],
           'phone' => $this->sanitizeContactInput($data['phone']),
           'email' => $this->sanitizeContactInput($data['email']),
           'subject' => $this->sanitizeContactInput($data['subject']),
           'message' => $this->sanitizeContactInput($data['message']),
       ];
   }

   #[Title('Contact us')]
   #[Layout('layouts.app')]
   public function render()
   {
       return view('livewire.pages.contact-page');
   }
}
