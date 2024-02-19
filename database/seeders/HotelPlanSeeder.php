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
                'title' => '和室/2食付き 禁煙',
                'description' => 'ゆったりとくつろげる和室のタイプになります',
                'price' => '15000',
                'room_type_id' => 2,
                'meal' => 3,
                'hotel_id' => 1,
            ],
            [
                'title' => '半露天風呂付き洋室ツイン 朝食付き 禁煙',
                'description' => 'ツインベッドのプランになります。(食事なし)',
                'price' => '12000',
                'room_type_id' => 2,
                'meal' => 1,
                'hotel_id' => 1,
            ],
            [
                'title' => '檜露天風呂付き/2食付き 禁煙',
                'description' => '檜露天風呂付きの豪華なお部屋になります。',
                'price' => '22000',
                'room_type_id' => 2,
                'meal' => 3,
                'hotel_id' => 1,
            ],
            [
                'title' => '【温泉露天風呂付き】和室（ローベッド4台）夕食付き 禁煙',
                'description' => '緑の森の中に浮かぶような風景を一望できます',
                'price' => '20000',
                'room_type_id' => 3,
                'meal' => 2,
                'hotel_id' => 2,
            ],
            [
                'title' => '【温泉露天風呂付き】和ツインデラックス（ローベッド2台）朝食付き 禁煙',
                'description' => '緑の森の中に浮かぶような風景を一望できます。贅沢なデラックスプラン',
                'price' => '22000',
                'room_type_id' => 2,
                'meal' => 1,
                'hotel_id' => 2,
            ],
            [
                'title' => 'デラックスツイン／スタンダードフロア 素泊まり 禁煙',
                'description' => 'セミダブルサイズのベッドを2台配し、ゆったりとお寛ぎいただける間取りはご夫婦やカップルにおすすめです。',
                'price' => '30000',
                'room_type_id' => 2,
                'meal' => 0,
                'hotel_id' => 3,
            ],
            [
                'title' => '温泉露天風呂付きダブルルーム(2名定員) 素泊まり 禁煙',
                'description' => '広々としたスイートプラン',
                'price' => '32000',
                'room_type_id' => 2,
                'meal' => 0,
                'hotel_id' => 3,
            ],
            [
                'title' => '【温泉露天風呂付き】和ツインデラックス 朝食付き 電子タバコのみ',
                'description' => '絶景です',
                'price' => '33000',
                'room_type_id' => 2,
                'meal' => 1,
                'hotel_id' => 3,
            ],
            [
                'title' => '【温泉露天風呂付き】和室 2食付き 電子タバコのみ',
                'description' => '絶景な和室です',
                'price' => '35000',
                'room_type_id' => 2,
                'meal' => 3,
                'hotel_id' => 3,
            ],
        ];

        DB::table('hotel_plans')->insert($data);
    }
}
