<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'job_id',
        'date_issued',
        'payment_due_by',
        'client_name',
        'client_phone',
        'client_email',
        'client_address',
        'items',
        'subtotal',
        'vat',
        'discount',
        'total_due',
        'amount_paid',
        'balance',
        'payment_status',
        'payment_method',
        'payment_date',
        'created_by',
    ];

    protected $casts = [
        'date_issued'      => 'date',
        'payment_due_by'   => 'date',
        'payment_date'     => 'date',
        'items'            => 'array',
        'subtotal'         => 'decimal:2',
        'vat'              => 'decimal:2',
        'discount'         => 'decimal:2',
        'total_due'        => 'decimal:2',
        'amount_paid'      => 'decimal:2',
        'balance'          => 'decimal:2',
    ];

    // Relationships
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    /**
     * Boot method to handle model events
     */
    protected static function booted()
    {
        // Before creating a new invoice
        static::creating(function ($invoice) {
            // Generate invoice number if not set
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = self::generateInvoiceNumber();
            }

            // Calculate balance
            $invoice->balance = $invoice->total_due - $invoice->amount_paid;
        });

        // Before updating an invoice
        static::updating(function ($invoice) {
            // Recalculate balance
            $invoice->balance = $invoice->total_due - $invoice->amount_paid;
        });
    }

    /**
     * Generate a unique invoice number
     */
    public static function generateInvoiceNumber()
    {
        // Example: INV-2026-0001
        $lastInvoice = self::latest('id')->first();
        $nextNumber = $lastInvoice ? $lastInvoice->id + 1 : 1;
        $year = now()->year;

        return 'INV-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}