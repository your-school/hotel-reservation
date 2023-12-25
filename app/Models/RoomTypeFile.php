<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RoomTypeFile extends Model
{
    use HasFactory;
    protected $fillable = ['room_type_id', 'file_path'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function saveFile($file)
    {
        $path = Storage::putFile('room-type-files', $file);
        $this->file_path = $path;
        $this->save();
    }
}
