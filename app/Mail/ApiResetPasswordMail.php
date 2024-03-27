<?php

namespace App\Mail;

use App\Models\ApiPasswordResetToken;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApiResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public ApiPasswordResetToken $apiPasswordResetToken;
    /**
     * Create a new message instance.
     */
    public function __construct(ApiPasswordResetToken $apiPasswordResetToken)
    {
        $this->apiPasswordResetToken = $apiPasswordResetToken;
        return $apiPasswordResetToken;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'mkbcentral@gmail.com',
            to: $this->apiPasswordResetToken->user->email,
            subject: 'Api Reset Password Mail',

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.api-reset-password-mail',
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
