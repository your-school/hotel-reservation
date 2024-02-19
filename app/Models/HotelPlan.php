<?php

namespace App\Models;

use App\Mail\AdminReservationConfirmation;
use App\Mail\UserReservationConfirmation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HotelPlan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'room_type_id', 'hotel_id'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function hotelPlanFiles()
    {
        return $this->hasMany(HotelPlanFile::class);
    }
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function roomTypeFiles()
    {
        return $this->hasMany(RoomTypeFile::class, 'room_type_id');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public static function sendReservationConfirmationEmail($user, $reservation)
    {
        Mail::to($user->email)->send(new UserReservationConfirmation($user, $reservation));
    }

    public static function sendAdminReservationNotification($user, $reservation)
    {
        Mail::to('admintest@test.com')->send(new AdminReservationConfirmation($user, $reservation));
    }

    public static function Reservation($request, $plan)
    {
        // トランザクション開始
        DB::beginTransaction();

        try {
            // バリデーション
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                // 'password' => 'required|string|min:8',
                'reservation_date' => 'required|string',
                'message' => 'nullable|string', // 必要に応じて追加
            ]);

            // 既存ユーザーが存在するか確認
            $existingUser = User::where(function ($query) use ($validatedData) {
                $query->where('email', $validatedData['email'])
                    ->orWhere('phone', $validatedData['phone']);
            })
                ->first();


            // ユーザーが存在しない場合は新規作成
            if (!$existingUser) {
                $user = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'address' => $validatedData['address'],
                    'phone' => $validatedData['phone'],
                    // 'password' => bcrypt($validatedData['password']),
                ]);
            } else {
                // 既存ユーザーが存在する場合はそれを使用
                $user = $existingUser;
            }

            // 入力データから日付を取得
            $dateRange = explode(' to ', $validatedData['reservation_date']);
            $checkInDate = Carbon::parse($dateRange[0]);
            $checkOutDate = Carbon::parse($dateRange[1]);

            // 予約情報を保存
            $reservationData = [
                'user_id' => $user->id,
                'hotel_plan_id' => $plan->id,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'status' => '予約中',
            ];

            // 'message' キーが存在する場合のみ追加
            if (isset($validatedData['message'])) {
                $reservationData['message'] = $validatedData['message'];
            }

            $reservation = Reservation::create($reservationData);

            // 在庫情報を更新
            $stocks = Stock::where('hotel_plan_id', $plan->id)
                ->whereBetween('day', [$checkInDate, $checkOutDate])
                ->get();

            foreach ($stocks as $stock) {
                // 在庫が負の値にならないように確認
                $stock->decrement('stock', min($stock->stock, 1));
            }

            // 予約者に予約受付メールを送信
            self::sendReservationConfirmationEmail($user, $reservation);

            // 管理者に予約受付メールを送信
            self::sendAdminReservationNotification($user, $reservation);

            // トランザクションコミット
            DB::commit();
        } catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollBack();
            // エラーメッセージをセッションにフラッシュ
            session()->flash('error', '予約の作成中にエラーが発生しました。もう一度お試しください。');

            // リダイレクト
            return redirect()->back();
        }
    }
}
