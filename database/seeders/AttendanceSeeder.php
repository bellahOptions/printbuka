<?php
// database/seeders/AttendanceSeeder.php
namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $admins = Admin::where('is_active', true)->get();
        $allAdmins = Admin::all();
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        $attendanceStatuses = [
            '✅ Present',
            '🕐 Late (< 30 min)',
            '⏰ Late (> 30 min)',
            '❌ Absent — No Notice',
            '🏥 Sick Leave',
            '📋 Approved Leave'
        ];

        $attendances = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            foreach ($admins as $admin) {
                // Skip weekends for some randomness
                if ($date->isWeekend() && rand(1, 100) < 70) {
                    continue;
                }

                $status = $attendanceStatuses[array_rand($attendanceStatuses)];
                $scheduledIn = Carbon::createFromTime(9, 0, 0); // 9:00 AM
                $actualArrival = null;
                $actualDeparture = null;
                $hoursWorked = null;
                $lateMinutes = null;
                $overtimeHours = null;
                $absenceReason = null;

                switch ($status) {
                    case '✅ Present':
                        $actualArrival = Carbon::createFromTime(8, rand(45, 59), 0);
                        $actualDeparture = Carbon::createFromTime(17, rand(0, 30), 0);
                        $hoursWorked = 8 + rand(0, 5) / 10;
                        $lateMinutes = 0;
                        $overtimeHours = max(0, $hoursWorked - 8);
                        break;
                        
                    case '🕐 Late (< 30 min)':
                        $lateMins = rand(5, 25);
                        $actualArrival = Carbon::createFromTime(9, $lateMins, 0);
                        $actualDeparture = Carbon::createFromTime(17, rand(0, 30), 0);
                        $hoursWorked = 8 - ($lateMins / 60) + rand(0, 3) / 10;
                        $lateMinutes = $lateMins;
                        $overtimeHours = max(0, $hoursWorked - 8);
                        break;
                        
                    case '⏰ Late (> 30 min)':
                        $lateMins = rand(35, 120);
                        $actualArrival = Carbon::createFromTime(9, 0, 0)->addMinutes($lateMins);
                        $actualDeparture = Carbon::createFromTime(17, rand(0, 30), 0);
                        $hoursWorked = max(6, 8 - ($lateMins / 60) + rand(0, 2) / 10);
                        $lateMinutes = $lateMins;
                        $overtimeHours = 0;
                        break;
                        
                    case '❌ Absent — No Notice':
                        $absenceReason = 'Did not show up or call';
                        break;
                        
                    case '🏥 Sick Leave':
                        $absenceReason = 'Feeling unwell, doctor\'s appointment';
                        break;
                        
                    case '📋 Approved Leave':
                        $absenceReason = 'Pre-approved vacation day';
                        break;
                }

                $loggedBy = $allAdmins->where('admin_status', 'manager')->random();

                $attendances[] = [
                    'date' => $date->format('Y-m-d'),
                    'admin_id' => $admin->id,
                    'scheduled_in' => '09:00:00',
                    'actual_arrival' => $actualArrival?->format('H:i:s'),
                    'actual_departure' => $actualDeparture?->format('H:i:s'),
                    'hours_worked' => $hoursWorked,
                    'attendance_status' => $status,
                    'late_minutes' => $lateMinutes,
                    'absence_reason' => $absenceReason,
                    'overtime_hours' => $overtimeHours,
                    'logged_by' => $loggedBy->id,
                    'remarks' => rand(1, 10) > 7 ? 'Follow up required' : null,
                    'created_at' => $date->copy()->setTime(rand(17, 19), rand(0, 59)),
                    'updated_at' => $date->copy()->setTime(rand(17, 19), rand(0, 59)),
                ];
            }
        }

        foreach ($attendances as $attendance) {
            Attendance::create($attendance);
        }
    }
}