<?php

namespace Database\Seeders;

use App\Models\RoomTypeFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RoomTypeFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageData = [
            ['room_type_id' => 1, 'hotel_plan_id' => 1, 'file_name' => 'シングル.jpeg'],
            ['room_type_id' => 1, 'hotel_plan_id' => 2, 'file_name' => 'シングル2.jpeg'],
            ['room_type_id' => 3, 'hotel_plan_id' => 3, 'file_name' => 'スイート.jpeg'],
            ['room_type_id' => 2, 'hotel_plan_id' => 4, 'file_name' => 'ダブル.jpeg'],
            ['room_type_id' => 2, 'hotel_plan_id' => 5, 'file_name' => 'ダブル2.jpeg'],
            ['room_type_id' => 3, 'hotel_plan_id' => 6, 'file_name' => 'ダブル2.jpeg'],
            ['room_type_id' => 1, 'hotel_plan_id' => 7, 'file_name' => 'ダブル2.jpeg'],
            ['room_type_id' => 2, 'hotel_plan_id' => 8, 'file_name' => 'ダブル2.jpeg'],

        ];

        foreach ($imageData as $data) {
            $this->saveImage($data['room_type_id'], $data['file_name'], $data['hotel_plan_id']);
        }
    }

    private function saveImage($roomTypeId, $fileName, $hotelPlanId)
    {
        $imagePath = public_path('rooms/' . $fileName);

        // storage/app/public/room-type-files ディレクトリが存在しない場合は作成する
        $storagePath = storage_path('app/public/room-type-files');
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        $imageCopyPath = 'room-type-files/' . $fileName; // パスを修正
        copy($imagePath, storage_path('app/public/' . $imageCopyPath));

        RoomTypeFile::create([
            'room_type_id' => $roomTypeId,
            'hotel_plan_id' => $hotelPlanId,
            'file_path' => $imageCopyPath, // パスを修正
        ]);
    }
}
