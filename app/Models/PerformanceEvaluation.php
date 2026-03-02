<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceEvaluation extends Model
{
    protected $fillable = [
        // Section 1
        'full_name', 'email', 'phone', 'department', 'tenure',

        // Section 2
        'rating_quality', 'rating_timeliness', 'rating_communication',
        'rating_initiative', 'rating_tools_knowledge', 'rating_attitude',
        'rating_client_satisfaction',

        // Section 3
        'daily_responsibilities', 'workflow_process',
        'task_tracking_methods', 'deadline_miss_frequency',

        // Section 4
        'underperformance_reason', 'made_error',
        'error_description', 'team_issues',

        // Section 5
        'skills_growth', 'commitment_level', 'future_plans', 'motivation_factors',

        // Section 6
        'improvement_area', 'one_change', 'open_feedback',

        // Section 7
        'current_salary', 'salary_satisfaction', 'salary_impact',
        'financial_pressures', 'expected_salary', 'salary_justification',
        'desired_benefits',

        'declaration_agreed', 'ip_address',
    ];

    protected $casts = [
        'task_tracking_methods' => 'array',
        'financial_pressures'   => 'array',
        'desired_benefits'      => 'array',
        'declaration_agreed'    => 'boolean',
    ];

    /**
     * Average self-performance rating across all categories.
     */
    public function getAverageRatingAttribute(): float|null
    {
        $ratings = array_filter([
            $this->rating_quality,
            $this->rating_timeliness,
            $this->rating_communication,
            $this->rating_initiative,
            $this->rating_tools_knowledge,
            $this->rating_attitude,
            $this->rating_client_satisfaction,
        ]);

        return count($ratings) ? round(array_sum($ratings) / count($ratings), 1) : null;
    }
}
