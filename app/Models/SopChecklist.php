<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SopChecklist extends Model
{
    protected $table = 'sop_checklist';

    protected $fillable = [
        'job_id',
        'phase',
        'step_number',
        'task',
        'responsible',
        'status',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
