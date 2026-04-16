<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\BreakTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AttendanceController extends Controller
{
    public function attendance()
    {
        $user = Auth::user();


        $attendance = Attendance::with('breaks')
                    -> where('user_id', $user['id'])
                    -> whereDate('date', Carbon::today())
                    -> first();

        $status = 'not_started';
        if ($attendance) {
            if ($attendance['time_end']) {
                $status = 'finished';
            } elseif ($attendance->breaks()->whereNull('break_end')->exists()) {
                $status = 'breaking';
            } elseif ($attendance['time_start']) {
                $status = 'working';
            }
        }

        return view('staff.attendance', compact('user', 'attendance', 'status'));
    }

    public function workStart(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();

        Attendance::create([
            'user_id' => $user['id'],
            'date' => $now,
            'time_start' => Carbon::now(),
        ]);

        return redirect('/attendance');
    }

    public function workEnd(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();

        $attendance = Attendance::where('user_id', $user['id'])
                                ->whereDate('date', $now)
                                ->whereNotNull('time_start')
                                ->whereNull('time_end')
                                ->first();
        //attendance tableに登録日の「time_end」のデータがない時
        if ($attendance) {
            $attendance->update([
                'time_end' => Carbon::now()
            ]);

            return redirect('/attendance');
        }

        return redirect('/attendance');
    }

    public function breakStart(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();

        $attendance = Attendance::where('user_id', $user['id'])
                                ->whereDate('date', $now)
                                ->whereNotNull('time_start')
                                ->whereNull('time_end')
                                ->first();

        BreakTime::create([
            'user_id' => $user['id'],
            'attendance_id' => $attendance['id'],
            'break_start' => Carbon::now(),
        ]);

        return redirect('/attendance');
    }

    public function breakEnd(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();

        $breaks = BreakTime::whereNotNull('break_start')
                ->whereNull('break_end')
                ->first();
        //attendance tableに登録日の「time_end」のデータがない時
        if ($breaks) {
            $breaks->update([
                'break_end' => Carbon::now()
            ]);

            return redirect('/attendance');
        }

        return redirect('/attendance');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $month = $request->input('month', Carbon::now()->format('Y-m'));
        $targetMonth = Carbon::parse($month);

        $prevMonth = $targetMonth->copy()->subMonthNoOverflow()->format('Y-m');
        $nextMonth = $targetMonth->copy()->addMonthNoOverflow()->format('Y-m');

        $startDate = $targetMonth->copy()->startOfMonth();
        $endDate = $targetMonth->copy()->endOfMonth();

        $attendances = Attendance::where('user_id', $user['id'])
                    ->with('breaks')
                    ->whereBetween('time_start', [$startDate, $endDate])
                    ->get()
                    ->keyBy(function($item) {
                        return Carbon::parse($item->time_start)->isoFormat('MM/DD(ddd)');
                    });

        $days = [];
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $currentDate = $date->isoFormat('MM/DD(ddd)');
                $attendance = $attendances->get($currentDate);

                $totalBreak = $attendance ? $attendance->breaks->sum('duration') : 0;

                $days[] = [
                    'date' => $currentDate,
                    'attendance' => $attendance,
                    'total_break' => $totalBreak,
                ];
            }

        return view('staff.index', compact('user', 'days', 'month', 'prevMonth', 'nextMonth'));
    }

    public function show($attendanceId)
    {
        $user = Auth::user();

        $attendances = Attendance::with(['breaks'])
                    -> findOrFail($attendanceId);

        return view('detail', compact('user', 'attendances'));
    }
}
