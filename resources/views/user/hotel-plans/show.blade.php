@extends('user.top')

@section('title', '宿泊プラン詳細')

@section('content')
<div class="mt-8 p-8 bg-white rounded-lg shadow-lg">
    <h2 class="text-4xl font-semibold mb-6 text-center">{{ $hotel->name }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        @foreach ($file as $roomTypeFile)
            <!-- 画像ファイルが存在するかどうかを確認 -->
            @if (Storage::exists('public/' . $roomTypeFile->file_path))
                <!-- 画像が存在する場合、表示 -->
                <img class="w-full mb-4 object-cover" src="{{ asset('storage/' . $roomTypeFile->file_path) }}" alt="画像">
            @else
                <!-- 画像が存在しない場合、代替のメッセージを表示 -->
                <p class="mb-4 text-gray-700 text-center">画像はありません</p>
            @endif
        @endforeach

        <!-- プランの詳細情報表示 -->
        <div>
            <p class="text-gray-800 mb-4">{{ $hotel->description }}</p>
            <p class="text-xl text-gray-800 font-semibold mb-2">{{ $plan->title }}</p>
            <p class="text-gray-700">{{ $plan->description }}</p>
            <p class="text-gray-700 font-bold mt-2">料金: {{ number_format($plan->price) }}円</p>
        </div>
    </div>

    <!-- カレンダー表示エリア -->
    <div class="mt-8 border border-gray-300 rounded">
        <div class="p-4">
            <div id="calendar"></div>
        </div>
    </div>
</div>


@php
    $rooms = $plan->stocks;
    $events = $rooms
        ->filter(function ($room) {
            return new DateTime($room->day) >= new DateTime('today');
        })
        ->map(function ($room) use ($plan) {
            if ($room->stock > 3) {
                $title = '⚪︎ ' . $plan->price . '円';
            } elseif ($room->stock > 0) {
                $title = '△残り' . $room->stock . '部屋 '  . $plan->price . '円';
            } else {
                $title = '×';
            }

            return [
                'title' => $title,
                'start' => $room->day,
                'url' => route('user.hotel-plans.create', $plan->id),
            ];
        })
        ->values() // 連続したキーの配列に変換
        ->toArray();
@endphp
<script>
    var events = @json($events);
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'ja',
            timeZone: 'Asia/Tokyo',
            height: 'auto',
            firstDay: 0,
            headerToolbar: {
                left: "",
                center: "title",
                right: "today prev,next"
            },
            buttonText: {
                today: '今月',
                month: '月',
                list: 'リスト'
            },
            noEventsContent: 'スケジュールはありません',
            events: events,
            eventClick: function(info) {
                window.location.href = info.event.url; // イベントのURLへ遷移
            },
            dayCellDidMount: function(cellInfo) {
                var today = new Date();
                today.setHours(0, 0, 0, 0);

                if (cellInfo.date < today) {
                    cellInfo.el.style.backgroundColor = '#d3d3d3'; // Gray for past dates
                } else if (cellInfo.date.getUTCDay() === 6) {
                    cellInfo.el.style.backgroundColor = '#blue'; // Blue for Saturday
                } else if (cellInfo.date.getUTCDay() === 0) {
                    cellInfo.el.style.backgroundColor = '#ffc0cb'; // Red for Sunday
                }
            }
        });

        calendar.render();
    });
</script>
@endsection
