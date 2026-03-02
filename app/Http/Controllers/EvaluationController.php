<?php

namespace App\Http\Controllers;

use App\Mail\EvaluationHrNotification;
use App\Mail\EvaluationStaffConfirmation;
use App\Models\PerformanceEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EvaluationController extends Controller
{
    /**
     * Show the evaluation form.
     */
    public function create()
    {
        return view('evaluation.create');
    }

    /**
     * Store the evaluation and send emails.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Section 1
            'full_name'   => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'nullable|string|max:30',
            'department'  => 'required|string|max:100',
            'tenure'      => 'required|string|max:100',

            // Section 2
            'rating_quality'             => 'nullable|integer|min:1|max:5',
            'rating_timeliness'          => 'nullable|integer|min:1|max:5',
            'rating_communication'       => 'nullable|integer|min:1|max:5',
            'rating_initiative'          => 'nullable|integer|min:1|max:5',
            'rating_tools_knowledge'     => 'nullable|integer|min:1|max:5',
            'rating_attitude'            => 'nullable|integer|min:1|max:5',
            'rating_client_satisfaction' => 'nullable|integer|min:1|max:5',

            // Section 3
            'daily_responsibilities'    => 'required|string',
            'workflow_process'          => 'nullable|string',
            'task_tracking_methods'     => 'nullable|array',
            'task_tracking_methods.*'   => 'string',
            'deadline_miss_frequency'   => 'nullable|string',

            // Section 4
            'underperformance_reason' => 'nullable|string',
            'made_error'              => 'nullable|string',
            'error_description'       => 'nullable|string',
            'team_issues'             => 'nullable|string',

            // Section 5
            'skills_growth'    => 'required|string',
            'commitment_level' => 'nullable|integer|min:1|max:5',
            'future_plans'     => 'nullable|string',
            'motivation_factors' => 'required|string',

            // Section 6
            'improvement_area' => 'nullable|string',
            'one_change'       => 'nullable|string',
            'open_feedback'    => 'nullable|string',

            // Section 7
            'current_salary'       => 'nullable|string|max:50',
            'salary_satisfaction'  => 'nullable|string',
            'salary_impact'        => 'nullable|string',
            'financial_pressures'  => 'nullable|array',
            'financial_pressures.*'=> 'string',
            'expected_salary'      => 'nullable|string|max:50',
            'salary_justification' => 'nullable|string',
            'desired_benefits'     => 'nullable|array',
            'desired_benefits.*'   => 'string',

            'declaration_agreed' => 'required|accepted',
        ], [
            'declaration_agreed.accepted' => 'You must confirm the declaration before submitting.',
            'daily_responsibilities.required' => 'Please describe your daily responsibilities in Section 03.',
            'skills_growth.required' => 'Please fill in the skills you\'re developing in Section 05.',
            'motivation_factors.required' => 'Please tell us what would make you more productive in Section 05.',
        ]);

        $evaluation = PerformanceEvaluation::create([
            ...$validated,
            'declaration_agreed' => true,
            'ip_address'         => $request->ip(),
        ]);

        // Send confirmation to staff
        Mail::to($evaluation->email)
            ->send(new EvaluationStaffConfirmation($evaluation));

        // Send notification to HR
        Mail::to(config('mail.hr_email'))
            ->send(new EvaluationHrNotification($evaluation));

        return redirect()->route('evaluation.success')
            ->with('submitted_name', $evaluation->full_name);
    }

    /**
     * Show success page.
     */
    public function success()
    {
        if (! session()->has('submitted_name')) {
            return redirect()->route('evaluation.create');
        }

        return view('evaluation.success', [
            'name' => session('submitted_name'),
        ]);
    }
    public function show()
    {
        $evaluations = PerformanceEvaluation::latest()->get();
        return view('evaluation.show', compact('evaluations'));
    }
    public function showDetail($id)
{
    $evaluation = PerformanceEvaluation::findOrFail($id);
    return view('evaluation.showDetail', compact('evaluation'));
}
}
