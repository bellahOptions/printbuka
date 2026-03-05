<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;

// Import related models
use App\Models\Job;
use App\Models\JobComment;
use App\Models\Attendance;
use App\Models\DailyStaffLog;
use App\Models\SopChecklist;
use App\Models\Invoice;

class Admin extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    MustVerifyEmail
{
    use Authenticatable, Authorizable, CanResetPassword, HasFactory, Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'first_name', 'last_name', 'phone', 'address', 'email',
        'email_verified_at', 'email_verification_token', 'password',
        'admin_status', 'is_active', 'staff_role', 'other_role',
        'date_of_birth', 'photo',
    ];

    protected $hidden = ['password', 'remember_token', 'email_verification_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth'     => 'date',
        'is_active'         => 'boolean',
    ];

    /**
     * Get the full name attribute.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the email address that should be used for verification.
     * Required by MustVerifyEmail interface.
     */
    public function getEmailForVerification(): string
    {
        return $this->email;
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
    }

    /**
     * Mark the email as verified.
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Get the photo URL attribute.
     */
    public function getPhotoUrlAttribute(): string
    {
        return $this->photo
            ? Storage::url("photos/{$this->photo}")
            : asset('images/default-avatar.png');
    }

    /**
     * Get the display role attribute.
     */
    public function getDisplayRoleAttribute(): string
    {
        return $this->staff_role === 'other' && $this->other_role
            ? $this->other_role
            : $this->staff_role;
    }

    /**
     * Check if the admin is a super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->admin_status === 'super_admin';
    }

    /**
     * Check if the email is verified.
     */
    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * Check if the admin is fully active.
     */
    public function isFullyActive(): bool
    {
        return $this->hasVerifiedEmail() && $this->is_active;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function jobsCreated()
    {
        return $this->hasMany(Job::class, 'created_by');
    }

    public function jobComments()
    {
        return $this->hasMany(JobComment::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function dailyLogs()
    {
        return $this->hasMany(DailyStaffLog::class);
    }

    public function sopVerifications()
    {
        return $this->hasMany(SopChecklist::class, 'verified_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Permission Checks
    |--------------------------------------------------------------------------
    */
    public function canAccessFinancials(): bool
    {
        return $this->isSuperAdmin() || in_array($this->staff_role, ['IT', 'Finance']);
    }

    public function canManageJobs(): bool
    {
        return $this->isSuperAdmin() || in_array($this->staff_role, [
            'Operations', 'Operations Manager', 'customer_service'
        ]);
    }

    public function canApproveJobPhase(): bool
    {
        return $this->isSuperAdmin() || $this->staff_role === 'Operations Manager';
    }

    public function canViewCustomerData(): bool
    {
        return $this->isSuperAdmin() || in_array($this->staff_role, [
            'customer_service', 'Operations', 'Operations Manager', 'Designer', 'QC', 'Finance'
        ]);
    }

    public function canManageInvoices(): bool
    {
        return $this->isSuperAdmin() || in_array($this->staff_role, [
            'customer_service', 'Finance'
        ]);
    }

    public function canViewAttendance(): bool
    {
        return $this->isSuperAdmin() || in_array($this->staff_role, [
            'HR', 'Operations Manager'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Data
    |--------------------------------------------------------------------------
    */
    public function getDashboardData()
    {
        return match($this->staff_role) {
            'IT' => $this->getItDashboardData(),
            'HR' => $this->getHrDashboardData(),
            'Operations Manager' => $this->getOperationsManagerDashboardData(),
            'Operations' => $this->getOperationsDashboardData(),
            'Designer' => $this->getDesignerDashboardData(),
            'QC' => $this->getQcDashboardData(),
            'customer_service' => $this->getCustomerServiceDashboardData(),
            'Finance' => $this->getFinanceDashboardData(),
            default => $this->getDefaultDashboardData(),
        };
    }

    protected function getItDashboardData()
    {
        return [
            'total_jobs' => Job::count(),
            'active_jobs' => Job::whereNotIn('job_status', ['Delivered', 'Cancelled'])->count(),
            'total_staff' => Admin::count(),
            'pending_activations' => Admin::where('is_active', false)->count(),
            'recent_jobs' => Job::with('creator')->latest()->take(10)->get(),
            'system_alerts' => [
                'pending_activations' => Admin::where('is_active', false)->count(),
            ]
        ];
    }

    protected function getHrDashboardData()
    {
        return [
            'total_staff' => Admin::count(),
            'attendance_today' => Attendance::whereDate('date', today())->count(),
            'on_leave' => Attendance::whereDate('date', today())
                ->where('attendance_status', '📋 Approved Leave')->count(),
            'pending_evaluations' => DailyStaffLog::whereDate('date', today())
                ->whereNull('supervisor_rating')->count(),
            'attendance_summary' => Attendance::with('admin')
                ->whereMonth('date', now()->month)
                ->get()
                ->groupBy('admin_id')
                ->map(fn($logs) => [
                    'present' => $logs->where('attendance_status', '✅ Present')->count(),
                    'late' => $logs->whereIn('attendance_status', ['🕐 Late (< 30 min)', '⏰ Late (> 30 min)'])->count(),
                    'absent' => $logs->where('attendance_status', '❌ Absent — No Notice')->count(),
                ]),
        ];
    }

    protected function getOperationsManagerDashboardData()
    {
        return [
            'jobs_by_phase' => [
                'intake' => Job::where('job_status', 'Analyzing Job Brief')->count(),
                'design' => Job::where('job_status', 'Design / Artwork Preparation')->count(),
                'production' => Job::where('job_status', 'In Production')->count(),
                'qc' => Job::where('job_status', 'Quality Check & Packaging')->count(),
                'delivery' => Job::where('job_status', 'Delivery In Progress')->count(),
            ],
            'pending_approvals' => JobComment::where('is_approved_by_manager', false)
                ->with('job', 'admin')
                ->latest()
                ->take(10)
                ->get(),
            'late_jobs' => Job::whereNotNull('estimated_delivery_date')
                ->whereDate('estimated_delivery_date', '<', today())
                ->whereNotIn('job_status', ['Delivered'])
                ->count(),
            'team_performance' => DailyStaffLog::with('admin')
                ->whereMonth('date', now()->month)
                ->get()
                ->groupBy('admin_id')
                ->map(fn($logs) => [
                    'avg_rating' => round($logs->avg('supervisor_rating'), 1),
                    'jobs_completed' => $logs->sum('jobs_completed'),
                ]),
        ];
    }

    protected function getDesignerDashboardData()
    {
        return [
            'pending_jobs' => Job::where('assigned_designer', $this->full_name)
                ->where('job_status', 'Design / Artwork Preparation')
                ->count(),
            'active_jobs' => Job::where('assigned_designer', $this->full_name)
                ->whereIn('job_status', ['Design / Artwork Preparation', 'In Production'])
                ->count(),
            'completed_this_month' => Job::where('assigned_designer', $this->full_name)
                ->whereMonth('updated_at', now()->month)
                ->where('job_status', 'Delivered')
                ->count(),
            'my_jobs' => Job::where('assigned_designer', $this->full_name)
                ->latest()
                ->take(10)
                ->get(),
        ];
    }

    protected function getQcDashboardData()
    {
        return [
            'pending_qc' => Job::where('job_status', 'Quality Check & Packaging')
                ->whereNull('qc_checked_by')
                ->count(),
            'today_qc' => Job::whereDate('qc_date', today())->count(),
            'failed_qc' => Job::where('qc_result', '❌ Failed - Reprint')
                ->whereMonth('created_at', now()->month)
                ->count(),
            'jobs_for_qc' => Job::where('job_status', 'Quality Check & Packaging')
                ->with('creator')
                ->latest()
                ->take(20)
                ->get(),
        ];
    }

    protected function getCustomerServiceDashboardData()
    {
        return [
            'new_inquiries' => Job::where('job_status', 'Analyzing Job Brief')
                ->whereDate('created_at', today())
                ->count(),
            'pending_invoices' => Job::where('payment_status', 'Awaiting Invoice')
                ->count(),
            'jobs_for_delivery' => Job::where('job_status', 'Delivery In Progress')
                ->count(),
            'recent_jobs' => Job::latest()->take(10)->get(),
            'pending_feedback' => Job::where('client_review_status', 'Pending Client Feedback')
                ->where('job_status', 'Delivered')
                ->count(),
        ];
    }

    protected function getFinanceDashboardData()
    {
        return [
            'monthly_revenue' => Job::whereMonth('created_at', now()->month)
                ->sum('invoice_amount'),
            'monthly_collected' => Job::whereMonth('created_at', now()->month)
                ->sum('amount_paid'),
            'outstanding' => Job::where('payment_status', '!=', 'Invoice Settled (100%)')
                ->whereNotNull('invoice_amount')
                ->sum(DB::raw('invoice_amount - amount_paid')),
            'recent_invoices' => Invoice::with('job')
                ->latest()
                ->take(10)
                ->get(),
            'payment_status_summary' => Job::select('payment_status', DB::raw('count(*) as total'))
                ->groupBy('payment_status')
                ->get(),
        ];
    }

    protected function getOperationsDashboardData()
    {
        return [
            'my_jobs' => Job::where('production_officer', $this->full_name)
                ->whereIn('job_status', ['In Production', 'Quality Check & Packaging'])
                ->count(),
            'pending_production' => Job::where('job_status', 'In Production')
                ->whereNull('production_officer')
                ->count(),
            'recent_assignments' => Job::where('production_officer', $this->full_name)
                ->latest()
                ->take(10)
                ->get(),
        ];
    }

    protected function getDefaultDashboardData()
    {
        return [
            'recent_activity' => JobComment::where('admin_id', $this->id)
                ->latest()
                ->take(10)
                ->get(),
        ];
    }
}