<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotels')->delete();

        $data = [
            [
                'name' => 'Hotel 東京',
                'location' => '東京港区',
                'description' => '東京にあるラグジュアリーなホテルになります',
            ],
            [
                'name' => 'Hotel 千葉',
                'location' => '千葉県千葉市',
                'description' => '千葉にある、いい感じなホテルになります',
            ],
            [
                'name' => 'Hotel 京都',
                'location' => '京都府',
                'description' => '京都にある旅館ですホテルになります',
            ],
            [
                'name' => 'Hotel 福岡',
                'location' => '福岡',
                'description' => '天神にあるホテルになります',
            ],
        ];

        DB::table('hotels')->insert($data);
    }
}
