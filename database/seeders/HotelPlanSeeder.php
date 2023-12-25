<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotel_plans')->delete();
        $data = [
            [
                'title' => 'スタンダードプラン',
                'description' => 'シンプルなスタンダードプラン',
                'price' => '10000',
                'room_type_id' => 1, // シングルルームの ID
            ],
            [
                'title' => 'デラックスプラン',
                'description' => '贅沢なデラックスプラン',
                'price' => '20000',
                'room_type_id' => 2, // ダブルルームの ID
            ],
            [
                'title' => 'スイートプラン',
                'description' => '広々としたスイートプラン',
                'price' => '30000',
                'room_type_id' => 3, // スイートルームの ID
            ],
            // 他にも必要ならばデータを追加
        ];

        DB::table('hotel_plans')->insert($data);
    }
}
