<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakRequest extends Model
{
    use HasFactory;

    protected $table = 'break_correct_requests';

    protected $fillable = [
        'attendance_correct_request_id',
        'break_id',
        'request_break_start',
        'request_break_end',
        'new_break_start',
        'new_break_end',
    ];

    protected $casts = [
        'request_break_start' => 'datetime',
        'request_break_end' => 'datetime',
        'new_break_start' => 'datetime',
        'new_break_end' => 'datetime',
    ];

    public function breakTime()
    {
        return $this->belongsTo(BreakTime::class);
    }

    public function attendanceRequest()
    {
        return $this->belongsTo(AttendanceRequest::class);
    }
}
