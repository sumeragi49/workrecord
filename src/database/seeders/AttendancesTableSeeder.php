<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '1',
            'date' => '2026-01-01',
            'time_start' => '2026-01-01 10:00:00',
            'time_end' => '2026-01-01 18:00:00',
            'content' => '',
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '1',
            'date' => '2026-01-02',
            'time_start' => '2026-01-02 10:00:00',
            'time_end' => '2026-01-02 18:00:00',
            'content' => '',
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '1',
            'date' => '2026-01-03',
            'time_start' => '2026-01-03 10:20:00',
            'time_end' => '2026-01-03 18:00:00',
            'content' => '電車遅延のため遅刻',
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '1',
            'date' => '2026-01-04',
            'time_start' => '2026-01-04 10:15:00',
            'time_end' => '2026-01-04 18:00:00',
            'content' => '遅延のため',
            'status' => '2',
            'created_at' => '2026-01-04 10:15:00',
            'updated_at' => '2026-04-22 00:00:00',
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '1',
            'date' => '2026-01-05',
            'time_start' => '2026-01-05 10:00:00',
            'time_end' => '2026-01-05 18:00:00',
            'content' => '遅延のため',
            'status' => '2',
            'created_at' => '2026-01-05 10:00:00',
            'updated_at' => '2026-04-22 00:00:00',
        ];
        DB::table('attendances')->insert($param);
    }
}
