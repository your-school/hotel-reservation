<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelPlan;
use App\Models\Reservation;
use App\Models\RoomType;
use App\Models\RoomTypeFile;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index()
    {
        // 1ページあたりのアイテム数を設定
        $perPage = 10;
        $plans = HotelPlan::with('hotel', 'roomType', 'stocks')->paginate($perPage);
        return view('admin.reservation_frames.index', ['plans' => $plans]);
    }

    public function create()
    {

        $hotels = Hotel::all();

        $rooms = RoomType::all();
        return view('admin.reservation_frames.create', compact('hotels', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // 最大2MBのJPEG、PNG、JPGファイル
            'day.*' => 'required|date',
            'stock.*' => 'required|numeric|min:0',
        ]);

        $hotel = Hotel::findOrFail($request->hotel_id);

        $hotelPlanData = $request->only(['title', 'description', 'price', 'meal', 'room_type_id', 'hotel_id']);
        $hotelPlan = $hotel->hotelPlans()->create($hotelPlanData);

        $stocksData = [];
        foreach ($request->day as $key => $day) {
            $stocksData[] = [
                'day' => $day,
                'stock' => $request->stock[$key],
            ];
        }

        $hotelPlan->stocks()->createMany($stocksData);

        // 画像を保存してファイルを登録
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();

            // 画像を保存
            $image->storeAs('public/room-type-files', $fileName);

            // ファイルをDBに登録
            RoomTypeFile::saveImage($request->room_type_id, $fileName, $hotelPlan->id);
        }

        return redirect()->route('admin.reservation_frames.index')->with('success', '宿泊プランが作成されました');
    }

    public function edit(HotelPlan $hotelPlan)
    {
        $hotels = Hotel::all();
        $rooms = RoomType::all();

        return view('admin.reservation_frames.edit', compact('hotelPlan', 'hotels', 'rooms'));
    }

    public function update(Request $request, HotelPlan $hotelPlan)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'title' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // 最大2MBのJPEG、PNG、JPGファイル
            'day' => 'required|array',
            'day.*' => 'required|date',
            'stock' => 'required|array',
            'stock.*' => 'required|numeric',
        ]);

        $hotelPlan->update([
            'hotel_id' => $request->input('hotel_id'),
            'room_type_id' => $request->input('room_type_id'),
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);

        // 既存の日付・ストックを削除
        $hotelPlan->stocks()->delete();

        // 新しい日付・ストックを登録
        $stocksData = [];
        foreach ($request->day as $key => $day) {
            $stocksData[] = [
                'hotel_plan_id' => $hotelPlan->id,
                'day' => $day,
                'stock' => $request->stock[$key],
            ];
        }

        $hotelPlan->stocks()->createMany($stocksData);

        // 画像を保存してファイルを登録
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();

            // 画像を保存
            $image->storeAs('public/room-type-files', $fileName);

            // ファイルをDBに登録
            RoomTypeFile::saveImage($request->room_type_id, $fileName, $hotelPlan->id);
        }
        return redirect()->route('admin.reservation_frames.edit', $hotelPlan)
            ->with('success', '宿泊プランの編集が完了しました。');
    }


    public function destroy(Request $request, HotelPlan $hotelPlan)
    {
        $hotelPlan->delete();

        return redirect()->route('admin.reservation_frames.index')
            ->with('success', '宿泊プランが削除されました');
    }
}
