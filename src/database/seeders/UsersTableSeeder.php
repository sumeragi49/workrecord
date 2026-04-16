<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '山田太郎',
            'email' => 'test1@example.com',
            'password' => Hash::make('coachtech1001'),
            'role' => '0',
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => '西伶奈',
            'email' => 'test2@example.com',
            'password' => Hash::make('coachtech1002'),
            'role' => '0',
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => '増田一世',
            'email' => 'test3@example.com',
            'password' => Hash::make('coachtech1003'),
            'role' => '0',
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => '山本敬吉',
            'email' => 'test4@example.com',
            'password' => Hash::make('coachtech1004'),
            'role' => '0',
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => '秋田朋美',
            'email' => 'test5@example.com',
            'password' => Hash::make('coachtech1005'),
            'role' => '0',
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => '中西敦夫',
            'email' => 'test6@example.com',
            'password' => Hash::make('coachtech1006'),
            'role' => '0',
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => '山田花子',
            'email' => 'test7@example.com',
            'password' => Hash::make('coachtech1007'),
            'role' => '1',
        ];
        DB::table('users')->insert($param);
    }
}
