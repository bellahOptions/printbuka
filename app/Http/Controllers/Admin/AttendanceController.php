<?php
// app/Http/Controllers/Admin/AttendanceController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $admin = auth()->admin();
        
        if (!$admin->canViewAttendance()) {
            abort(403);
        }

        $query = Attendance::with('admin');
        
        if ($request->month) {
            $query->whereMonth('date', $request->month);
        }
        
        if ($request->year) {
            $query->whereYear('date', $request->year ?? now()->year);
        }

        $attendances = $query->orderBy('date', 'desc')->paginate(30);
        
        $summary = Admin::where('is_active', true)
            ->get()
            ->map(function($staff) use ($request) {
                $logs = Attendance::where('admin_id', $staff->id)
                    ->whereMonth('date', $request->month ?? now()->month)
                    ->whereYear('date', $request->year ?? now()->year)
                    ->get();
                
                return [
                    'staff' => $staff,
                    'present' => $logs->where('attendance_status', '✅ Present')->count(),
                    'late' => $logs->whereIn('attendance_status', ['🕐 Late (< 30 min)', '⏰ Late (> 30 min)'])->count(),
                    'absent' => $logs->where('attendance_status', '❌ Absent — No Notice')->count(),
                    'sick' => $logs->where('attendance_status', '🏥 Sick Leave')->count(),
                    'leave' => $logs->where('attendance_status', '📋 Approved Leave')->count(),
                    'percentage' => $logs->count() > 0 
                        ? round(($logs->where('attendance_status', '✅ Present')->count() / $logs->count()) * 100, 1)
                        : 0,
                ];
            });

        return view('admin.attendance.index', [
            'admin' => $admin,
            'attendances' => $attendances,
            'summary' => $summary,
            'staff' => Admin::where('is_active', true)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $admin = auth()->user();
        
        if (!$admin->canViewAttendance()) {
            abort(403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'admin_id' => 'required|exists:admins,id',
            'scheduled_in' => 'nullable|date_format:H:i',
            'actual_arrival' => 'nullable|date_format:H:i',
            'actual_departure' => 'nullable|date_format:H:i',
            'attendance_status' => 'required|in:✅ Present,🕐 Late (< 30 min),⏰ Late (> 30 min),❌ Absent — No Notice,🏥 Sick Leave,📋 Approved Leave',
            'absence_reason' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        // Calculate hours worked
        $hoursWorked = null;
        if ($validated['actual_arrival'] && $validated['actual_departure']) {
            $start = \Carbon\Carbon::createFromFormat('H:i', $validated['actual_arrival']);
            $end = \Carbon\Carbon::createFromFormat('H:i', $validated['actual_departure']);
            $hoursWorked = round($end->diffInMinutes($start) / 60, 2);
        }

        // Calculate late minutes
        $lateMinutes = null;
        if ($validated['scheduled_in'] && $validated['actual_arrival']) {
            $scheduled = \Carbon\Carbon::createFromFormat('H:i', $validated['scheduled_in']);
            $actual = \Carbon\Carbon::createFromFormat('H:i', $validated['actual_arrival']);
            if ($actual > $scheduled) {
                $lateMinutes = $actual->diffInMinutes($scheduled);
            }
        }

        // Calculate overtime
        $overtime = null;
        if ($hoursWorked && $hoursWorked > 8) {
            $overtime = $hoursWorked - 8;
        }

        Attendance::updateOrCreate(
            [
                'date' => $validated['date'],
                'admin_id' => $validated['admin_id'],
            ],
            [
                'scheduled_in' => $validated['scheduled_in'],
                'actual_arrival' => $validated['actual_arrival'],
                'actual_departure' => $validated['actual_departure'],
                'hours_worked' => $hoursWorked,
                'attendance_status' => $validated['attendance_status'],
                'late_minutes' => $lateMinutes,
                'absence_reason' => $validated['absence_reason'],
                'overtime_hours' => $overtime,
                'logged_by' => $admin->id,
                'remarks' => $validated['remarks'],
            ]
        );

        return redirect()->back()->with('success', 'Attendance recorded successfully');
    }
}