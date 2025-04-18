<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderPlanned extends Mailable
{
    use Queueable, SerializesModels;

    public $reminderPlanned;

    /**
     * Create a new message instance.
     */
    public function __construct($reminderPlanned)
    {
        $this->reminderPlanned = $reminderPlanned;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reminder: Your Planned Payment is Due Soon',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.emails.reminderPlanned',
            with: [
                'reminderPlanned' => $this->reminderPlanned,
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
