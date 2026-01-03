<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountActivationCode extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public $user,
        public $code
    ) {
        $this->onConnection('database');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Account Activation Code',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.account-activation',
            with: [
                'user' => $this->user,
                'code' => $this->code,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
