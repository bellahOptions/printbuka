<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public string $verificationUrl;

    public function __construct(public Admin $admin, string $token)
    {
        $this->verificationUrl = route('admin.verify.email', ['token' => $token]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Your Email — Printbuka Staff Portal',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-verify',
        );
    }
}
