<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;

class InvoiceReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $pdfPath;

    public function __construct(Invoice $invoice, $pdfPath)
    {
        $this->invoice = $invoice;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Your Payment Receipt - PrintBuka')
                    ->view('emails.invoice_receipt')
                    ->attach($this->pdfPath);
    }
}