@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-8">

    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8 ">
            <div class="mb-10 md:mb-16">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl"></h2>
            </div>

            <form action="{{ route('admin.reservation_frames.store') }}" method="POST" enctype="multipart/form-data" class="mx-auto grid max-w-screen-md gap-4 sm:grid-cols-2" id="reservationForm">
                @csrf

                <div class="sm:col-span-2">
                    <label for="hotel_id" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">ホテル名</label>
                    <select name="hotel_id" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required>
                        <option value="" disabled selected>ホテルを選択してください</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="room_type_id" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">ルーム種別</label>
                    <select name="room_type_id" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required>
                        <option value="" disabled selected>ルームを選択してください</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2 py-2">
                    <label for="title" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">タイトル</label>
                    <input name="title" placeholder="（例）【露天風呂付き】和ツイン（ローベッド2台）朝食付き 禁煙" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
                </div>
                <div class="sm:col-span-2 py-2">
                    <label for="price" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">価格</label>
                    <input type="number" name="price" placeholder="（例）15000" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
                </div>
                
                <div class="sm:col-span-2 py-2">
                    <label for="description" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">プランの魅力</label>
                    <textarea name="description" placeholder="（例）緑の森の中に浮かぶような風景を一望できます。贅沢なデラックスプラン" class="h-64 w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required></textarea>
                </div>
                <div class="sm:col-span-2">
                    <label for="image" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">画像（JPEG、JPG、PNGのみ）</label>
                    <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                </div>
                
                <div class="sm:col-span-2 py-2">
                    <label for="day" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">日付</label>
                    <input type="date" name="day[]" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
                </div>

                <div class="sm:col-span-2 py-2">
                    <label for="stock" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">空き部屋数(ストック)</label>
                    <input type="number" name="stock[]" placeholder="（例）15" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
                </div>


                <div id="additionalStocks"></div>

                <div class="flex items-center justify-between sm:col-span-2 py-2">
                    <button type="button" onclick="addStockField()" class="inline-block rounded-lg bg-green-500 py-2 px-4 text-center text-sm font-semibold text-white outline-none ring-green-300 transition duration-100 hover:bg-green-600 focus-visible:ring active:bg-indigo-700 md:text-base">日付・空き部屋 フォーム追加</button>
                </div>

                <div class="flex items-center justify-between sm:col-span-2 py-2">
                    <a href="{{ route('admin.reservation_frames.index') }}" class="inline-block rounded-lg bg-blue-500 py-2 px-4 text-center text-sm font-semibold text-white outline-none ring-blue-300 transition duration-100 hover:bg-blue-600 focus-visible:ring active:bg-blue-700 md:text-base">戻る</a>
                </div>
                <div class="flex items-center justify-between sm:col-span-2 py-2">
                    <button type="submit" class="inline-block rounded-lg bg-indigo-500 py-2 px-4 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">投稿する</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function addStockField() {
        // 新しい入力フィールドを生成
        const additionalStockField = document.createElement('div');
        additionalStockField.className = 'sm:col-span-2 py-2';
        additionalStockField.innerHTML = `
        <div class="sm:col-span-2 py-2">
                <label for="day" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">日付</label>
                <input type="date" name="day[]" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
            </div>
            <div class="sm:col-span-2 py-2">
                <label for="stock" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">空き部屋数(ストック)</label>
                <input type="number" name="stock[]" placeholder="（例）5" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
            </div>
        `;

        // 生成したフィールドを追加
        document.getElementById('additionalStocks').appendChild(additionalStockField);
    }
</script>

@endsection
