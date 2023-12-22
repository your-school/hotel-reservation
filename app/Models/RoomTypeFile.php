<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeFile extends Model
{
    use HasFactory;
    protected $fillable = ['room_type_id', 'file_path'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
