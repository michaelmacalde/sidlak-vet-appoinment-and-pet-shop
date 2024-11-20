<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donor_email;
    public $donor_name;
    public $donor_phone_number;
    public $donor_address;
    public $donor_amount;
    public $donor_payment_method;
    public $donor_message;
    public $donation_number;
    public $created_at;

    public function __construct(
        $donor_name,
        $donor_email,
        $donor_phone_number,
        $donor_address,
        $donor_amount,
        $donor_payment_method,
        $donor_message,
        $donation_number,
        $created_at
    ) {
        $this->donor_name = $donor_name;
        $this->donor_email = $donor_email;
        $this->donor_phone_number = $donor_phone_number;
        $this->donor_address = $donor_address;
        $this->donor_amount = $donor_amount;
        $this->donor_payment_method = $donor_payment_method;
        $this->donor_message = $donor_message;
        $this->donation_number = $donation_number;
        $this->created_at = $created_at;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Donation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.donation',
            with: [
                'donor_name' => $this->donor_name,
                'donor_email' => $this->donor_email,
                'donor_phone_number' => $this->donor_phone_number,
                'donor_address' => $this->donor_address,
                'donor_amount' => $this->donor_amount,
                'donor_payment_method' => $this->donor_payment_method,
                'donor_message' => $this->donor_message,
                'donation_number' => $this->donation_number,
                'created_at' => $this->created_at,
                'url' => config('app.url'),
            ]
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

