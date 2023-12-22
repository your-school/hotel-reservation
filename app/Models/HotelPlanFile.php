<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelPlanFile extends Model
{
    use HasFactory;
    protected $fillable = ['hotel_plan_id', 'file_path'];

    public function hotelPlan()
    {
        return $this->belongsTo(HotelPlan::class);
    }
}
