<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobComment extends Model
{
    protected $table = 'job_comments';

    protected $fillable = [
        'job_id',
        'admin_id',
        'phase',
        'comment',
        'is_approved_by_manager',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'is_approved_by_manager' => 'boolean',
        'approved_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Phase Constants
    |--------------------------------------------------------------------------
    */

    const PHASE_INTAKE = 'Intake';
    const PHASE_DESIGN = 'Design';
    const PHASE_PRODUCTION = 'Production';
    const PHASE_QC = 'QC';
    const PHASE_DELIVERY = 'Delivery';
    const PHASE_REVIEW = 'Review';
    const PHASE_GENERAL = 'General';

    public static function phases()
    {
        return [
            self::PHASE_INTAKE,
            self::PHASE_DESIGN,
            self::PHASE_PRODUCTION,
            self::PHASE_QC,
            self::PHASE_DELIVERY,
            self::PHASE_REVIEW,
            self::PHASE_GENERAL,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function approver()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function approve($admin)
    {
        $this->update([
            'is_approved_by_manager' => true,
            'approved_by' => $admin->id,
            'approved_at' => now(),
        ]);
    }
}