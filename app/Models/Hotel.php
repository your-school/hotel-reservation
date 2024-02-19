<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hotel extends Model
{
    protected $fillable = ['name', 'description', 'location'];

    use HasFactory;

    public function roomTypes()
    {
        return $this->hasMany(RoomType::class);
    }

    public function hotelPlans()
    {
        return $this->hasMany(HotelPlan::class);
    }
    public function hotelFiles()
    {
        return $this->hasMany(HotelFile::class);
    }

    public static function search($request)
    {
        // 入力された検索条件を取得
        $hotelName = trim($request->input('hotel_name'));
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        // ホテルプランとホテルを結合したクエリを作成
        $query = Hotel::query()
            ->select('hotel_plans.*', 'hotels.name as hotel_name')
            ->leftJoin('hotel_plans', 'hotels.id', '=', 'hotel_plans.hotel_id');

        // ホテル名の条件があれば追加
        if ($hotelName) {
            $query->where('hotels.name', 'like', "%$hotelName%");
        }

        // 料金下限の条件があれば追加
        if ($priceMin) {
            $query->where('price', '>=', $priceMin);
        }

        // 料金上限の条件があれば追加
        if ($priceMax) {
            $query->where('price', '<=', $priceMax);
        }

        // 検索結果を取得
        $hotels = $query->get();
        return $hotels;
    }

    public function storeWithImage($validatedData, $image)
    {
        // トランザクションを開始
        DB::beginTransaction();

        try {
            // Hotel を作成
            $hotel = $this->create([
                'name' => $validatedData['name'],
                'location' => $validatedData['location'],
                'description' => $validatedData['description'],
            ]);

            // ファイル名を生成
            $fileName = time() . '_' . $image->getClientOriginalName();

            // ファイルを保存
            $image->storeAs('public/hotel-files', $fileName);
            public_path('hotels/' . $fileName);

            // HotelFile を作成
            HotelFile::create([
                'hotel_id' => $hotel->id,
                'file_path' => 'hotel-files/' . $fileName,
            ]);

            // トランザクションをコミット
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // トランザクションをロールバック
            DB::rollBack();
            return false;
        }
    }

    public function updateWithImage($hotelId, $validatedData, $image)
    {
        // トランザクションを開始
        DB::beginTransaction();

        try {
            // Hotelを更新
            $hotel = Hotel::findOrFail($hotelId);
            $hotel->update([
                'name' => $validatedData['name'],
                'location' => $validatedData['location'],
                'description' => $validatedData['description'],
            ]);

            // ファイル名を生成
            $fileName = time() . '_' . $image->getClientOriginalName();

            // ファイルを保存
            $image->storeAs('public/hotel-files', $fileName);
            public_path('hotels/' . $fileName);
            // HotelFileを作成または更新
            $hotelFile = HotelFile::where('hotel_id', $hotelId)->first();
            if ($hotelFile) {
                // 既に関連するHotelFileがある場合は更新
                $hotelFile->update([
                    'file_path' => 'hotel-files/' . $fileName,
                ]);
            } else {
                // 関連するHotelFileがない場合は新規作成
                HotelFile::create([
                    'hotel_id' => $hotelId,
                    'file_path' => 'hotel-files/' . $fileName,
                ]);
            }

            // トランザクションをコミット
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // トランザクションをロールバック
            DB::rollBack();
            return false;
        }
    }
}
