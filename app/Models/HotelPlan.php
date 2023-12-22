<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelPlan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'room_type_id'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function hotelPlanFiles()
    {
        return $this->hasMany(HotelPlanFile::class);
    }
}
