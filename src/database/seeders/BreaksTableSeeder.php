<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreaksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'attendance_id' => '1',
            'break_start' => '2026-01-01 13:00:00',
            'break_end' => '2026-01-01 14:00:00',
        ];
        DB::table('breaks')->insert($param);

        $param = [
            'attendance_id' => '1',
            'break_start' => '2026-01-02 13:00:00',
            'break_end' => '2026-01-02 14:00:00',
        ];
        DB::table('breaks')->insert($param);

        $param = [
            'attendance_id' => '1',
            'break_start' => '2026-01-03 13:00:00',
            'break_end' => '2026-01-03 14:00:00',
        ];
        DB::table('breaks')->insert($param);

        $param = [
            'attendance_id' => '1',
            'break_start' => '2026-01-04 13:00:00',
            'break_end' => '2026-01-04 14:00:00',
        ];
        DB::table('breaks')->insert($param);

        $param = [
            'attendance_id' => '1',
            'break_start' => '2026-01-05 13:00:00',
            'break_end' => '2026-01-05 14:00:00',
        ];
        DB::table('breaks')->insert($param);
    }
}
