<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelPlan;
use App\Models\RoomTypeFile;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::get();
        return view('user.hotel-plans.index', compact('hotels'));
    }

    public function search(Request $request)
    {
        $hotels = Hotel::get();
        // Hotelモデルのsearchメソッドを呼び出し
        $items = Hotel::search($request);
        return view('user.hotel-plans.index', compact('items', 'hotels'));
    }

    public function show(HotelPlan $plan)
    {
        $hotel = $plan->hotel;
        $hotelPlanId = $plan->id;
        $file = RoomTypeFile::where('hotel_plan_id', $hotelPlanId)->get();

        return view('user.hotel-plans.show', compact('hotel', 'plan', 'file'));
    }

    public function create(HotelPlan $plan)
    {
        return view('user.hotel-plans.create', compact('plan'));
    }

    public function store(Request $request, HotelPlan $plan)
    {
        HotelPlan::Reservation($request, $plan);

        return redirect()->route('user.hotel-plans.create', ['plan' => $plan->id])->with('success', '予約が完了しました');
    }
}
