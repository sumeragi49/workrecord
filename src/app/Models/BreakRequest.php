<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'break_id',
        'request_break_start',
        'request_break_end',
    ];

    public function breakTime()
    {
        return $this->belongsTo(BreakTime::class);
    }
}
