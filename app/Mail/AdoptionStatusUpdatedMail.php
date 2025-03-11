<?php

namespace App\Mail;

use App\Enums\AdoptionEnum;
use App\Models\Adoption\Adoption;
use App\Models\Animal\Dog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdoptionStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public AdoptionEnum $status;
    public $user_id;
    public array $adoptedDogs;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, AdoptionEnum $status, $user_id)
    {
        $this->user = $user;
        $this->status = $status;
        $this->user_id = $user_id;

        $this->adoptedDogs = Adoption::where('user_id', $user_id)
        ->where('status', AdoptionEnum::APPROVED)
        ->with('dog.breed') // Ensure breed relationship is loaded
        ->get()
        ->map(function ($adoption) {
            return [
                'dog_name' => $adoption->dog->dog_name,
                'dog_age' => $adoption->dog->dog_age,
                'dog_size' => ucfirst($adoption->dog->dog_size),
                'dog_gender' => ucfirst($adoption->dog->dog_gender),
                'breed_name' => $adoption->dog->breed->breed_name ?? 'Unknown',
                'dog_image' => $adoption->dog->getFirstDogImageAttribute(), // Ensure image attribute exists
            ];
        })
        ->toArray();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Adoption Status Updated Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.adoption.status',
            with : [
                'user' => $this->user,
                'status' => $this->status,
                'adoptedDogs' => $this->adoptedDogs,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
