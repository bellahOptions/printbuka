<?php
// database/seeders/DailyStaffLogSeeder.php
namespace Database\Seeders;

use App\Models\DailyStaffLog;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DailyStaffLogSeeder extends Seeder
{
    public function run(): void
    {
        $admins = Admin::where('is_active', true)->get();
        $managers = Admin::whereIn('admin_status', ['super_admin', 'manager'])->get();
        
        $departments = ['HR', 'IT', 'Operations', 'Design', 'Production', 'QC', 'Customer Service'];
        $initiativeActions = [
            'Suggested process improvement for inventory management',
            'Created new template for client reports',
            'Trained new team member on software',
            'Organized team building activity',
            'Implemented new filing system',
            'Volunteered for weekend shift',
            'Developed training documentation',
            'Optimized workflow for faster processing',
            null,
            null,
            null,
        ];
        
        $errorDescriptions = [
            'Data entry error in client database',
            'Miscommunication with client about deadline',
            'Calculation mistake in invoice',
            'Quality issue in final product',
            'Delay in response to client query',
            null,
            null,
            null,
        ];

        $logs = [];
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            // Skip some weekends
            if ($date->isWeekend() && rand(1, 100) < 60) {
                continue;
            }

            foreach ($admins as $admin) {
                $jobsAssigned = rand(1, 15);
                $jobsCompleted = rand(0, $jobsAssigned);
                $errorsReported = rand(0, 3);
                $clientComplaints = rand(0, 2);
                
                $logs[] = [
                    'date' => $date->format('Y-m-d'),
                    'admin_id' => $admin->id,
                    'department' => $admin->staff_role,
                    'jobs_assigned' => $jobsAssigned,
                    'jobs_completed' => $jobsCompleted,
                    // jobs_pending is calculated automatically
                    'errors_reported' => $errorsReported,
                    'error_description' => $errorsReported > 0 ? $errorDescriptions[array_rand($errorDescriptions)] : null,
                    'client_complaints' => $clientComplaints,
                    'initiative_action' => rand(1, 10) > 7 ? $initiativeActions[array_rand($initiativeActions)] : null,
                    'teamwork_rating' => rand(3, 5),
                    'supervisor_rating' => rand(3, 5),
                    'supervisor_notes' => rand(1, 10) > 8 ? 'Good performance, keep it up' : null,
                    'logged_by' => $managers->random()->id,
                    'created_at' => $date->copy()->setTime(rand(16, 18), rand(0, 59)),
                    'updated_at' => $date->copy()->setTime(rand(16, 18), rand(0, 59)),
                ];
            }
        }

        foreach ($logs as $log) {
            DailyStaffLog::create($log);
        }
    }
}