@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-8">

    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <x-flash-message type="success" :message="session('success')" />
        <x-flash-message type="error" :message="session('error')" />
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-10 md:mb-16">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">編集</h2>
            </div>

            <form action="{{ route('admin.reservation_frames.update', $hotelPlan->id) }}" method="POST"  enctype="multipart/form-data" class="mx-auto grid max-w-screen-md gap-4 sm:grid-cols-2" id="reservationForm">
                @csrf
                @method('PUT')

                <!-- 既存データの表示と編集フォーム -->
                <div class="sm:col-span-2">
                    <label for="hotel_id" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">ホテル名</label>
                    <select name="hotel_id" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required>
                        <option value="" disabled>ホテルを選択してください</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ $hotelPlan->hotel_id == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label for="room_type_id" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">ルーム種別</label>
                    <select name="room_type_id" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required>
                        <option value="" disabled>ルームを選択してください</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ $hotelPlan->room_type_id == $room->id ? 'selected' : '' }}>{{ $room->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-2 py-2">
                    <label for="title" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">タイトル</label>
                    <input name="title" value="{{ $hotelPlan->title }}" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
                </div>

                <div class="sm:col-span-2 py-2">
                    <label for="price" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">価格</label>
                    <input type="number" name="price" value="{{ $hotelPlan->price }}" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
                </div>

                <div class="sm:col-span-2">
                    <label for="image" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">画像（JPEG、JPG、PNGのみ）</label>
                    <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                </div>

                <div class="sm:col-span-2 py-2">
                    <label for="description" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">プランの魅力</label>
                    <textarea name="description" class="h-64 w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required>{{ $hotelPlan->description }}</textarea>
                </div>

                <div id="existingStocks" class="sm:col-span-2 grid grid-cols-2 gap-4">
                    @foreach($hotelPlan->stocks as $stock)
                        <div>
                            <label for="day" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">日付</label>
                            <input type="date" name="day[]" value="{{ $stock->day }}" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
                        </div>
                
                        <div>
                            <label for="stock" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">空き部屋数(ストック)</label>
                            <input type="number" name="stock[]" value="{{ $stock->stock }}" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
                        </div>
                    @endforeach
                </div>

                <!-- 以下は新しい日付・空き部屋のフィールドを追加する部分 -->
                <div id="additionalStocks" class="sm:col-span-2 grid grid-cols-2 gap-4">
                    {{-- 既存データに関連するフィールドをここに表示 --}}
                </div>

                <div class="flex items-center justify-between sm:col-span-2 py-2">
                    <button type="button" onclick="addStockField()" class="inline-block rounded-lg bg-green-500 py-2 px-4 text-center text-sm font-semibold text-white outline-none ring-green-300 transition duration-100 hover:bg-green-600 focus-visible:ring active:bg-indigo-700 md:text-base">日付・空き部屋 フォーム追加</button>
                </div>

                <div class="flex items-center justify-between sm:col-span-2 py-2">
                    <a href="{{ route('admin.reservation_frames.index') }}" class="inline-block rounded-lg bg-blue-500 py-2 px-4 text-center text-sm font-semibold text-white outline-none ring-blue-300 transition duration-100 hover:bg-blue-600 focus-visible:ring active:bg-blue-700 md:text-base">戻る</a>
                </div>
                <div class="flex items-center justify-between sm:col-span-2 py-2">
                    <button type="submit" class="inline-block rounded-lg bg-indigo-500 py-2 px-4 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">更新する</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function addStockField() {
        // 新しい入力フィールドを生成
        const additionalStockField = document.createElement('div');
        additionalStockField.className = 'sm:col-span-2 grid grid-cols-2 gap-4 py-2';
        additionalStockField.innerHTML = `
            <div>
                <label for="day" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">日付</label>
                <input type="date" name="day[]" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
            </div>
            <div>
                <label for="stock" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">空き部屋数(ストック)</label>
                <input type="number" name="stock[]" placeholder="（例）5" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
            </div>
            `;
    // 生成したフィールドを追加
    document.getElementById('additionalStocks').appendChild(additionalStockField);
}
</script>
@endsection
