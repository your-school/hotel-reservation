<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image'];

    public function hotelPlans()
    {
        return $this->hasMany(HotelPlan::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function roomTypeFiles()
    {
        return $this->hasMany(RoomTypeFile::class, 'room_type_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
