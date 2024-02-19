<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RoomTypeFile extends Model
{
    use HasFactory;
    protected $fillable = ['room_type_id', 'hotel_plan_id', 'file_path'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function hotelPlan()
    {
        return $this->belongsTo(HotelPlan::class);
    }

    public function saveFile($file)
    {
        $path = Storage::putFile('room-type-files', $file);
        $this->file_path = $path;
        $this->save();
    }

    public static function saveImage($roomTypeId, $fileName, $hotelPlanId)
    {
        $imagePath = public_path('rooms/' . $fileName);

        // storage/app/public/room-type-files ディレクトリが存在しない場合は作成する
        $storagePath = storage_path('app/public/room-type-files');
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        $imageCopyPath = 'room-type-files/' . $fileName; // パスを修正

        self::create([
            'room_type_id' => $roomTypeId,
            'hotel_plan_id' => $hotelPlanId,
            'file_path' => $imageCopyPath, // パスを修正
        ]);
    }
}
