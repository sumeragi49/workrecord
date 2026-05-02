<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition(): array
    {
        $hour = rand(8, 9);
        $minute = rand(0, 59);

        $startTime = sprintf('%02d:%02d:00', $hour, $minute);
        $endTime = date('H:i:s', strtotime($startTime . ' +9 hours'));

        return [
            'user_id' => null,
            'date' => null,
            'time_start' => $startTime,
            'time_end' => $endTime,
            'status' => '0',
        ];
    }
}
