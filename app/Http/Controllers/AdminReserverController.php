<?php

namespace App\Http\Controllers;

use App\Mail\UserReservationCancellationConfirmation;
use App\Models\Reservation;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminReserverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();

        return view('admin.reservers.index', compact('reservations'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservers.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $reservations = Reservation::userNamePhonesearch($request);
        return view('admin.reservers.index', compact('reservations'));
    }

    public function cancel($id)
    {
        // 予約を取得
        $reservation = Reservation::findOrFail($id);

        // トランザクション開始
        DB::beginTransaction();

        try {
            // 在庫情報を更新
            $stocks = Stock::where('hotel_plan_id', $reservation->hotel_plan_id)
                ->whereBetween('day', [$reservation->check_in_date, $reservation->check_out_date])
                ->get();

            foreach ($stocks as $stock) {
                // 在庫を1つ増やす
                $stock->increment('stock', 1);
            }

            // 予約を削除
            $reservation->delete();

            // キャンセル完了メールを送信
            Mail::to($reservation->user->email)->send(new UserReservationCancellationConfirmation($reservation->user, $reservation));

            // トランザクションコミット
            DB::commit();

            // キャンセル成功のフラッシュメッセージをセット
            session()->flash('success', '予約がキャンセルされました。');
        } catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollBack();

            // エラーメッセージをセッションにセット
            session()->flash('error', '予約のキャンセル中にエラーが発生しました。');
        }

        // 予約一覧ページにリダイレクト
        return redirect()->route('admin.reservers.index');
    }
}
