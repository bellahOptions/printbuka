<?php

namespace App\Mail;

use App\Models\PerformanceEvaluation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EvaluationStaffConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public PerformanceEvaluation $evaluation) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Performance Evaluation Has Been Received — Printbuka',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.staff-confirmation',
        );
    }
}
