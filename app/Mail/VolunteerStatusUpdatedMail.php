<?php

namespace App\Mail;

use App\Enums\VolunteerStatusTypeEnum;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VolunteerStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public VolunteerStatusTypeEnum $status;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, VolunteerStatusTypeEnum $status)
    {
        $this->user = $user;
        $this->status = $status;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Volunteer Status Updated Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.volunteer.status',
            with : [
                'user' => $this->user,
                'status' => $this->status,
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
