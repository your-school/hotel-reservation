<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_types')->delete();

        $data = [
            [
                'title' => 'シングルルーム',
                'description' => 'シングルベッド1台',
            ],
            [
                'title' => 'ダブルルーム',
                'description' => 'ダブルベッド1台',
            ],
            [
                'title' => 'スイートルーム',
                'description' => '広いスイートルーム',
            ],
        ];

        DB::table('room_types')->insert($data);
    }
}
