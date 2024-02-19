<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class AdminHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 予約枠データを取得するロジックを追加
        $hotels = Hotel::all();

        return view('admin.hotels.index', ['hotels' => $hotels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // 最大2MBのJPEG、PNG、JPGファイル
        ]);

        $hotel = new Hotel;

        // Hotel モデルの storeWithImage メソッドを呼び出し
        if ($hotel->storeWithImage($validatedData, $request->file('image'))) {
            // 成功時のリダイレクトなどを追加
            return redirect()->route('admin.hotels.index')->with('success', '宿泊施設が正常に登録されました。');
        } else {
            // エラーメッセージを表示してフォームに戻るなどの処理を行う
            return back()->with('error', '宿泊施設の登録中にエラーが発生しました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', ['hotel' => $hotel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        // バリデーション
        $validatedData = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // 最大2MBのJPEG、PNG、JPGファイル
        ]);

        // Hotel モデルの storeWithImage メソッドを呼び出し
        if ($hotel->updateWithImage($hotel->id, $validatedData, $request->file('image'))) {
            // 成功時のリダイレクトなどを追加
            return redirect()->route('admin.hotels.index')->with('success', '宿泊施設が正常に更新されました。');
        } else {
            // エラーメッセージを表示してフォームに戻るなどの処理を行う
            return back()->with('error', '宿泊施設の登録中にエラーが発生しました。');
        }
        return redirect()->route('admin.hotels.index')->with('success', 'ホテル情報が更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        // ホテルの削除
        $hotel->delete();

        // 成功時のリダイレクト
        return redirect()->route('admin.hotels.index')->with('success', 'ホテルが正常に削除されました。');
    }
}
