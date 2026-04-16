<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'time_start',
        'time_end',
        'content',
        'request',
        'approval',
    ];

    protected $casts = [
        'date' => 'date',
        'time_start' => 'datetime',
        'time_end' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breaks()
    {
        return $this->hasMany(BreakTime::class);
    }

    public function attendanceRequest()
    {
        return $this->hasOne(AttendanceRequest::class);
    }

    public function getWorkDurationAttribute()
    {
        if (!$this->time_start || !$this->time_end) return 0;

        $timeStart = Carbon::parse($this->time_start);
        $timeEnd = Carbon::parse($this->time_end);

        $totalBreakMinutes = $this->breaks->sum(function($break) {
            return Carbon::parse($break['break_start'])->diffInMinutes($break['break_end']);
        });

        return $timeStart->diffInMinutes($timeEnd) - $totalBreakMinutes;
    }
}
