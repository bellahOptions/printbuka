<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Attendance;
use App\Models\DailyStaffLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        $dashboardData = $admin->getDashboardData();
        
        // Common data for all dashboards
        $data = array_merge([
            'admin' => $admin,
            'pendingJobsCount' => Job::where('job_status', 'Design / Artwork Preparation')->count(),
            'myJobsCount' => $this->getMyJobsCount($admin),
            'pendingActivationsCount' => $admin->isSuperAdmin() 
                ? \App\Models\Admin::where('is_active', false)->count() 
                : 0,
        ], $dashboardData);

        return view('internalMGT.dashboard', $data);
    }

    protected function getMyJobsCount($admin)
    {
        return match($admin->staff_role) {
            'Designer' => Job::where('assigned_designer', $admin->full_name)
                ->where('job_status', 'Design / Artwork Preparation')
                ->count(),
            'Operations' => Job::where('production_officer', $admin->full_name)
                ->whereIn('job_status', ['In Production', 'Quality Check & Packaging'])
                ->count(),
            'QC' => Job::where('job_status', 'Quality Check & Packaging')
                ->whereNull('qc_checked_by')
                ->count(),
            default => 0,
        };
    }
}