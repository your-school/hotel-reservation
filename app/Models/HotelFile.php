<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id', // 追加するプロパティ
        'file_path',
    ];

    public function hotel()
    {
        return $this->belongsTo(RoomType::class);
    }
}
