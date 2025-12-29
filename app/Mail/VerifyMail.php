<?php

namespace App\Mail;

use App\Models\RegisterRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user, public string $userPassword)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        $name = $this->user->name;

        return new Envelope(
            from: env('MAIL_FROM_ADDRESS', 'no-reply'),
//            to: 'jeffrey_epstain@yahoo.com',
            subject: 'Подтверждение почты ' . $name,
            metadata: (array)'Тест',

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.verify_mail',
            with: [
                'url' => url(route('verification.mail',
                    ['id' => $this->user->id])),
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
