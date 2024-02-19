<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_plan_id', 'day', 'stock'];

    // HotelPlan モデルへのリレーション
    public function hotelPlan()
    {
        return $this->belongsTo(HotelPlan::class);
    }
}
