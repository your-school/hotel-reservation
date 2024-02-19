<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'hotel_plan_id', 'check_in_date', 'check_out_date', 'message', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotelPlan()
    {
        return $this->belongsTo(HotelPlan::class);
    }

    public function getNumberOfNights()
    {
        $checkInDate = new DateTime($this->check_in_date);
        $checkOutDate = new DateTime($this->check_out_date);
        $interval = $checkInDate->diff($checkOutDate);
        return $interval->days;
    }

    public static function userNamePhonesearch($request)
    {
        $keyword = $request->input('keyword');

        // 名前または電話番号がキーワードに一致するユーザーを取得
        return self::leftJoin('users', 'reservations.user_id', '=', 'users.id')
            ->select('users.phone', 'users.name', 'reservations.*')
            ->where('name', 'like', "%$keyword%")
            ->orWhere('phone', 'like', "%$keyword%")
            ->get();
    }
}
