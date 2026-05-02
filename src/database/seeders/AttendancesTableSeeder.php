<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Attendance;
use App\Models\BreakTime;
use Carbon\Carbon;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffs = User::where('role', 0)->get();
        $startDate = Carbon::create(2026, 1, 1);
        $endDate = Carbon::create(2026, 1, 31);

        foreach ($staffs as $staff) {
            for ($date = clone $startDate; $date->lte($endDate); $date->addDay()) {
                if ($date->isWeekend()) continue;

                $dateStr = $date->format('Y-m-d');

                $attendance = Attendance::factory()->create([
                    'user_id' => $staff->id,
                    'date' => $dateStr,
                    'time_start' => $dateStr . '' . '09:00:00',
                    'time_end' => $dateStr . '' . '18:00:00',
                ]);

                BreakTime::factory()->create([
                    'attendance_id' => $attendance->id,
                    'break_start' => $dateStr . '' . '13:00:00',
                    'break_end' => $dateStr . '' . '14:00:00',
                ]);
            }
        }
    }
}
