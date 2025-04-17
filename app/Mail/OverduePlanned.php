<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OverduePlanned extends Mailable
{
    use Queueable, SerializesModels;

    public $overduePlanned;

    /**
     * Create a new message instance.
     */

    public function __construct($overduePlanned)
    {
        $this->overduePlanned = $overduePlanned;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Overdue: Your Planned Payment is Overdue',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.emails.overduePlanned',
            with: [
                'overduePlanned' => $this->overduePlanned,
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
