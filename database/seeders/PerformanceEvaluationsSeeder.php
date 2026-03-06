<?php
// database/seeders/PerformanceEvaluationSeeder.php
namespace Database\Seeders;

use App\Models\PerformanceEvaluation;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PerformanceEvaluationSeeder extends Seeder
{
    public function run(): void
    {
        $admins = Admin::where('is_active', true)->get();
        
        $departments = ['HR', 'IT', 'Operations', 'Design', 'Production', 'QC', 'Customer Service'];
        $tenureOptions = ['Less than 6 months', '6-12 months', '1-2 years', '2-3 years', '3-5 years', '5+ years'];
        $deadlineMissFrequency = ['Never', 'Rarely', 'Sometimes', 'Often', 'Always'];
        $underperformanceReasons = [
            'Lack of clear direction',
            'Insufficient training',
            'Personal issues',
            'Workload too high',
            'Unclear expectations',
            'Resource constraints',
            null,
        ];
        $madeError = ['Yes', 'No', 'Prefer not to say'];
        $futurePlans = [
            'Seeking promotion within company',
            'Looking for new challenges',
            'Planning to start own business',
            'Considering further education',
            'Happy in current role',
            'Exploring other departments',
        ];
        $improvementAreas = [
            'Communication skills',
            'Technical knowledge',
            'Time management',
            'Team collaboration',
            'Leadership skills',
            'Process efficiency',
            null,
        ];
        $salarySatisfaction = ['Very satisfied', 'Satisfied', 'Neutral', 'Dissatisfied', 'Very dissatisfied'];
        $salaryImpact = ['Significantly positive', 'Somewhat positive', 'Neutral', 'Somewhat negative', 'Significantly negative'];

        $evaluations = [];

        foreach ($admins as $admin) {
            // Some admins might have multiple evaluations over time
            $numEvaluations = rand(1, 3);
            
            for ($i = 0; $i < $numEvaluations; $i++) {
                $createdAt = Carbon::now()->subMonths(rand(1, 12));
                
                $evaluations[] = [
                    // Section 1
                    'full_name' => $admin->first_name . ' ' . $admin->last_name,
                    'email' => $admin->email,
                    'phone' => $admin->phone,
                    'department' => $admin->staff_role,
                    'tenure' => $tenureOptions[array_rand($tenureOptions)],
                    
                    // Section 2 - Ratings
                    'rating_quality' => rand(3, 5),
                    'rating_timeliness' => rand(3, 5),
                    'rating_communication' => rand(3, 5),
                    'rating_initiative' => rand(3, 5),
                    'rating_tools_knowledge' => rand(3, 5),
                    'rating_attitude' => rand(3, 5),
                    'rating_client_satisfaction' => rand(3, 5),
                    
                    // Section 3
                    'daily_responsibilities' => 'Managing daily tasks including ' . 
                        match($admin->staff_role) {
                            'Designer' => 'creating designs, client consultations, and file preparation',
                            'IT' => 'system maintenance, troubleshooting, and user support',
                            'HR' => 'recruitment, employee relations, and policy implementation',
                            'QC' => 'quality inspections, documentation, and process improvement',
                            'Finance' => 'invoicing, reconciliations, and financial reporting',
                            default => 'task management, client communication, and quality control',
                        },
                    'workflow_process' => 'Follow standard operating procedures with regular checkpoints and team collaboration',
                    'task_tracking_methods' => json_encode(array_rand(array_flip(['Asana', 'Trello', 'Jira', 'Excel', 'Physical Board']), rand(1, 3))),
                    'deadline_miss_frequency' => $deadlineMissFrequency[array_rand($deadlineMissFrequency)],
                    
                    // Section 4
                    'underperformance_reason' => $underperformanceReasons[array_rand($underperformanceReasons)],
                    'made_error' => $madeError[array_rand($madeError)],
                    'error_description' => rand(1, 10) > 7 ? 'Minor data entry error in report' : null,
                    'team_issues' => rand(1, 10) > 8 ? 'Occasional communication gaps with design team' : null,
                    
                    // Section 5
                    'skills_growth' => 'Completed training courses and improved technical skills significantly',
                    'commitment_level' => rand(4, 5),
                    'future_plans' => $futurePlans[array_rand($futurePlans)],
                    'motivation_factors' => 'Professional growth, team collaboration, and challenging projects',
                    
                    // Section 6
                    'improvement_area' => $improvementAreas[array_rand($improvementAreas)],
                    'one_change' => rand(1, 10) > 5 ? 'More cross-departmental collaboration' : null,
                    'open_feedback' => rand(1, 10) > 6 ? 'Enjoy working here, good team culture' : null,
                    
                    // Section 7
                    'current_salary' => rand(30000, 80000),
                    'salary_satisfaction' => $salarySatisfaction[array_rand($salarySatisfaction)],
                    'salary_impact' => $salaryImpact[array_rand($salaryImpact)],
                    'financial_pressures' => json_encode(array_rand(array_flip(['Mortgage/Rent', 'Family support', 'Debt', 'Education', 'Healthcare']), rand(0, 3))),
                    'expected_salary' => rand(35000, 90000),
                    'salary_justification' => 'Based on performance, experience, and market rates',
                    'desired_benefits' => json_encode(array_rand(array_flip(['Health insurance', 'Remote work', 'Flexible hours', 'Training budget', 'Extra leave'], rand(1, 4)))),
                    
                    'declaration_agreed' => true,
                    'ip_address' => '192.168.' . rand(1, 255) . '.' . rand(1, 255),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];
            }
        }

        foreach ($evaluations as $evaluation) {
            PerformanceEvaluation::create($evaluation);
        }
    }
}