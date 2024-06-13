<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public string $name, public string $email, public string $body)
    {
        /* Questi dati verranno utilizzati nella vista dell'email. */
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        /* Specifica il soggetto dell'email. */
        return new Envelope(
            subject: 'Email dal portfolio',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        /* Restituisce un oggetto Content che specifica quale vista utilizzare per il corpo dell'email (emails.contact) e quali dati passare alla vista (name, email, body). */
        return new Content(
            view: 'emails.contact',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'body' => $this->body,
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