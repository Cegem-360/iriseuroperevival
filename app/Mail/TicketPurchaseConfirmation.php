<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketPurchaseConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Registration $registration,
    ) {
        $this->locale($registration->locale ?: app()->getLocale());
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Thank you for your ticket purchase — Europe Revival 2026'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.registration.ticket-purchase',
            with: [
                'registration' => $this->registration,
                'url' => route('register.success', $this->registration->uuid),
            ],
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
