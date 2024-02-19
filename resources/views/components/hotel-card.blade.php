@props(['hotel'])

<div class="bg-white rounded-lg overflow-hidden shadow-md p-4 w-full mb-4">
    @if ($hotel && $hotel->hotelFiles->isNotEmpty())
    <img src="{{ asset('storage/' . $hotel->hotelFiles->first()->file_path) }}" alt="{{ $hotel->name }}" class="w-full h-auto object-cover">
    @else
        <p class="text-center mt-4 text-gray-500">No image available</p>
    @endif
    <div class="p-4">
        <h3 class="text-xl text-gray-500 font-semibold mb-2">
            {{ $hotel->hotel_name ?? $hotel->name }}
        </h3>                       
        <p class="text-gray-500">{{ $hotel->location }}</p>
        <p class="text-gray-500 font-bold mt-2">{{ $hotel->description }}</p>
        @foreach ($hotel->hotelPlans as $plan)
            <div class="p-4">
                <h3 class="text-xl text-gray-500 font-semibold mb-2">{{ $plan->title }}</h3>
                <p class="text-gray-500">{{ $plan->description }}</p>
                <p class="text-gray-500 font-bold mt-2">{{ number_format($plan->price) }}円～</p>
                <a href="{{ route('user.hotel-plans.show', ['plan' => $plan->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 inline-block">詳細を見る</a>
            </div>
        @endforeach
    </div>
</div>