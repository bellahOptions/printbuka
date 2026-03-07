<?php
// app/Models/Job.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;
    protected $table = 'job'; // Explicitly set the table name

    protected $fillable = [
        'job_order', 'invoice_number', 'date_logged',
        'client_name', 'client_phone', 'client_email', 'client_address',
        'job_type', 'size_format', 'quantity', 'material', 'finish',
        'brief_received_by', 'brief_date', 'priority',
        'assigned_designer', 'design_start_date', 'design_approved_by_client',
        'design_approval_date', 'design_file_path',
        'production_officer', 'production_start_date', 'production_end_date',
        'qc_checked_by', 'qc_date', 'qc_result', 'qc_notes',
        'estimated_delivery_date', 'actual_delivery_date',
        'delivery_method', 'delivered_by',
        'client_review_status', 'after_sales_action', 'after_sales_resolved_date',
        'invoice_amount', 'amount_paid', 'payment_status',
        'job_status', 'internal_notes', 'created_by'
    ];

    protected $casts = [
        'date_logged' => 'date',
        'brief_date' => 'date',
        'design_start_date' => 'date',
        'design_approval_date' => 'date',
        'production_start_date' => 'date',
        'production_end_date' => 'date',
        'qc_date' => 'date',
        'estimated_delivery_date' => 'date',
        'actual_delivery_date' => 'date',
        'after_sales_resolved_date' => 'date',
        'design_approved_by_client' => 'boolean',
        'invoice_amount' => 'decimal:2',
        'amount_paid' => 'decimal:2',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(JobComment::class);
    }

    public function sopChecklist()
{
    return $this->hasOne(SopChecklist::class);
}

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function canUserViewFinancials(Admin $user): bool
    {
        return in_array($user->staff_role, ['IT', 'Finance']) || $user->isSuperAdmin();
    }

    public function canUserEdit(Admin $user): bool
    {
        if ($user->isSuperAdmin()) return true;
        
        return match($user->staff_role) {
            'Operations Manager' => true,
            'Operations' => true,
            'Designer' => $this->job_status === 'Design / Artwork Preparation',
            'QC' => $this->job_status === 'Quality Check & Packaging',
            'customer_service' => in_array($this->job_status, ['Analyzing Job Brief', 'Delivery In Progress']),
            default => false
        };
    }

    public function updateStatusFromPhase(): void
    {
        $phase = match(true) {
            $this->qc_result && $this->actual_delivery_date => 'Delivered',
            $this->actual_delivery_date => 'Delivery In Progress',
            $this->qc_date => 'Quality Check & Packaging',
            $this->production_start_date => 'In Production',
            $this->design_start_date => 'Design / Artwork Preparation',
            default => 'Analyzing Job Brief'
        };
        
        $this->job_status = $phase;
        $this->saveQuietly();
    }
}