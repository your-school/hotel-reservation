@extends('user.top')
@section('content')
    <div class="container mx-auto mt-8 p-8">
        <h2 class="text-3xl font-semibold mb-6">予約を作成する - {{ $plan->hotel->name }} - {{ $plan->title }}</h2>
        <x-flash-message type="success" :message="session('success')" />
        <x-flash-message type="error" :message="session('error')" />
        
        <!-- ここに予約作成のフォームや表示する内容を追加 -->

        <form method="post" action="{{ route('user.hotel-plans.store', ['plan' => $plan->id]) }}">
            @csrf

            <!-- 予約フォームの内容を追加 -->
            <!-- 名前 -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">名前</label>
                <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
            </div>

            <!-- メールアドレス -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">メールアドレス</label>
                <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
            </div>

            <!-- 住所 -->
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-semibold mb-2">住所</label>
                <input type="text" id="address" name="address" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
            </div>

            <!-- 電話番号 -->
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-semibold mb-2">電話番号</label>
                <input type="tel" id="phone" name="phone" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
            </div>

            <!-- メッセージ -->
            <div class="mb-4">
                <label for="message" class="block text-gray-700 font-semibold mb-2">宿泊施設にお伝えしておきたいこと</label>
                <input type="text" id="message" name="message" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>

            <!-- パスワード -->
            {{-- <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">パスワード</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
            </div> --}}

            <!-- 予約日選択 -->
            <div class="mb-4">
                <label for="reservation_date" class="block text-gray-700 font-semibold mb-2">予約期間</label>
                <input
                    type="text"
                    id="reservation_date"
                    name="reservation_date"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                    placeholder="予約期間を選択"
                    required
                />
            </div>
            <a href="{{ route('user.hotel-plans.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mr-4">戻る</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">予約する</button>
        </form>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Flatpickrの設定
            var flatpickrInstance = flatpickr("#reservation_date", {
                mode: "range", // 期間選択モード
                dateFormat: "Y-m-d", // 日付フォーマット
                minDate: "today", // 今日以降の日付を選択可能にする
                disable: [
                    function(date) {
                        // 日程が選択不可能な場合（stockが0の場合）にtrueを返す
                        return isUnavailableDate(date);
                    }
                ],
            });
    
            function isUnavailableDate(date) {
                // dateが選択不可能な場合にtrueを返す
                var dateString = date.toISOString().split('T')[0];
                var stock = @json(optional($plan->stocks)->pluck('stock', 'day') ?? []);
                return stock[dateString] === null || stock[dateString] === 0;
            }
    
            // 初期化時に無効化する日付を取得
            var disabledDates = flatpickrInstance.config.disable[0];
            
            // $plan->stocks が存在する場合に、その日付を有効化
            var stock = @json(optional($plan->stocks)->pluck('stock', 'day') ?? []);
            var enabledDates = [];
    
            Object.keys(stock).forEach(function(dateString) {
                if (stock[dateString] !== null && stock[dateString] !== 0) {
                    enabledDates.push(dateString);
                }
            });
    
            // Flatpickrを一時的に破棄
            flatpickrInstance.destroy();
    
            // Flatpickrを再初期化し、有効な日付を指定
            flatpickr("#reservation_date", {
                mode: "range", // 期間選択モード
                dateFormat: "Y-m-d", // 日付フォーマット
                minDate: "today", // 今日以降の日付を選択可能にする
                disable: [function(date) {
                    return isUnavailableDate(date);
                }],
                enable: enabledDates,
            });
        });
    </script>
@endsection