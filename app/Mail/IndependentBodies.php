<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class IndependentBodies extends Mailable
{
    use Queueable, SerializesModels;

    public string $title;
    public string $name;
    public string $phone;
    public string $email;
    public string $message;
    public $attachment;

    /**
     * Create a new message instance.
     */
    public function __construct(string $title, string $name, string $phone, string $email, string $subject, string $message, $attachment)
    {
        $this->title = $title;
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->phone = $phone;
        $this->message = $message;
        $this->attachment = $attachment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email, $this->name),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.sendMessage',
            with: [
                'titel' => $this->title,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'messageBody' => $this->message,
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
        return [
            Attachment::fromPath($this->attachment)->as('attachement.pdf')->withMime('application/pdf')
        ];
    }
}
