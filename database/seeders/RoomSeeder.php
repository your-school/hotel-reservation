<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->delete();

        $data = [
            [
                'room_type_id' => 1, // シングルルーム
                'number' => '101',
            ],
            [
                'room_type_id' => 1, // シングルルーム
                'number' => '102',
            ],
            [
                'room_type_id' => 1, // シングルルーム
                'number' => '103',
            ],
            [
                'room_type_id' => 1, // シングルルーム
                'number' => '104',
            ],
            [
                'room_type_id' => 1, // シングルルーム
                'number' => '105',
            ],
            [
                'room_type_id' => 1, // シングルルーム
                'number' => '106',
            ],
            [
                'room_type_id' => 1, // シングルルーム
                'number' => '107',
            ],
            [
                'room_type_id' => 1, // シングルルーム
                'number' => '108',
            ],
            [
                'room_type_id' => 2, // ダブルルーム
                'number' => '201',
            ],
            [
                'room_type_id' => 2, // ダブルルーム
                'number' => '202',
            ],
            [
                'room_type_id' => 2, // ダブルルーム
                'number' => '203',
            ],
            [
                'room_type_id' => 2, // ダブルルーム
                'number' => '204',
            ],
            [
                'room_type_id' => 2, // ダブルルーム
                'number' => '205',
            ],
            [
                'room_type_id' => 2, // ダブルルーム
                'number' => '206',
            ],
            [
                'room_type_id' => 2, // ダブルルーム
                'number' => '207',
            ],
            [
                'room_type_id' => 3, // スイートルーム
                'number' => '301',
            ],
            [
                'room_type_id' => 3, // スイートルーム
                'number' => '302',
            ],
            [
                'room_type_id' => 3, // スイートルーム
                'number' => '303',
            ],
        ];

        DB::table('rooms')->insert($data);
    }
}
