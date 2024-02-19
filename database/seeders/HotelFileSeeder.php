<?php

namespace Database\Seeders;

use App\Models\HotelFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class HotelFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageData = [
            ['hotel_id' => 1, 'file_name' => '東京ホテル.jpeg'],
            ['hotel_id' => 2, 'file_name' => '千葉県ホテル.jpeg'],
            ['hotel_id' => 3, 'file_name' => '京都ホテル.jpeg'],
            ['hotel_id' => 4, 'file_name' => '福岡ホテル.jpeg'],
        ];

        foreach ($imageData as $data) {
            $this->saveImage($data['hotel_id'], $data['file_name']);
        }
    }

    private function saveImage($hotelId, $fileName)
    {
        $imagePath = public_path('hotels/' . $fileName);

        // storage/app/public ディレクトリが存在しない場合は作成する
        $storagePath = storage_path('app/public/hotel-files');
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        $imageCopyPath = 'hotel-files/' . $fileName; // パスを修正
        copy($imagePath, storage_path('app/public/' . $imageCopyPath));

        HotelFile::create([
            'hotel_id' => $hotelId,
            'file_path' => $imageCopyPath, // パスを修正
        ]);
    }
}
