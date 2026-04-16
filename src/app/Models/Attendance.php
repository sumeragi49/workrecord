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

    public function getBreakTotalMinutesAttribute()
    {
        $totalMinutes = $this->breaks->reduce(function ($carry, $break) {
            if ($break->break_start && $break->break_end) {
                return $carry + $break->break_start->diffInMinutes($break->break_end);
            }
            return $carry;
        }, 0);

        if ($totalMinutes === 0) return '00:00';

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public function getWorkTotalMinutesAttribute()
    {
        if (!$this->time_start || !$this->time_end) return '';

        $totalMinutes = $this->time_start->diffInMinutes($this->time_end);
        $breakMinutes = $this->breaks->sum(function($break) {
            return $break->break_start->diffInMinutes($break->break_end);
        });

        $workMinutes = $totalMinutes - $breakMinutes;

        return sprintf('%02d:%02d', floor($workMinutes / 60), $workMinutes % 60);
    }
}
