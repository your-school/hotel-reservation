@props(['hotel','items'])
<div class="bg-white rounded-lg overflow-hidden shadow-md p-4 w-full mb-4">
    @if(!is_null($hotel->id))
    <div class="p-4">
        <h3 class="text-xl text-gray-500 font-semibold mb-2">
            {{ $hotel->hotel_name ?? $hotel->name }}
        </h3>                       
        <p class="text-gray-500">{{ $hotel->location }}</p>
        <p class="text-gray-500 font-bold mt-2">{{ $hotel->description }}</p>
        <div class="p-4">
            <h3 class="text-xl text-gray-500 font-semibold mb-2">{{ $hotel->title }}</h3>
            <p class="text-gray-500">{{ $hotel->description }}</p>
            <p class="text-gray-500 font-bold mt-2">{{ number_format($hotel->price) }}円～</p>
                <a href="{{ route('user.hotel-plans.show', ['plan' => $hotel->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 inline-block">詳細を見る</a>
        </div>
    </div>
    @else
    <div class="p-4">
        該当する結果が存在しないか、予約でいっぱいです。
    </div>
    @endif
</div>