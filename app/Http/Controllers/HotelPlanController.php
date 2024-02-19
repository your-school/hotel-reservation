<?php

namespace App\Http\Controllers;

use App\Models\HotelPlan;
use Illuminate\Http\Request;

class HotelPlanController extends Controller
{
    public function index()
    {
        // データベースから宿泊プランの一覧を取得
        $hotels = HotelPlan::with(['hotel.hotelFiles'])->get();
        // 取得したデータをビューに渡して宿泊プラン一覧画面を表示
        return view('user.hotel-plans.index', compact('hotels'));
    }
}
