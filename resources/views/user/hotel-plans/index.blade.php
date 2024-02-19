<!-- resources/views/user/plans/index.blade.php -->
@extends('user.top')

@section('title', '宿泊プラン一覧')

@section('content')
    <div class="container mx-auto mt-8 p-8">
        <h2 class="text-3xl font-semibold mb-6">宿泊プラン一覧</h2>

        <form action="{{ route('user.hotel-plans.search') }}" method="post" class="mb-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-5">
                <div>
                    <label for="hotel_name" class="block text-sm font-medium text-gray-700">ホテル名</label>
                    <select name="hotel_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                        <option value="">選択してください</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->name }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="price_min" class="block text-sm font-medium text-gray-700">料金下限</label>
                    <input type="number" name="price_min" min="0" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="price_max" class="block text-sm font-medium text-gray-700">料金上限</label>
                    <input type="number" name="price_max" min="0" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                </div>

                <div class="col-span-2"> <!-- 変更 -->
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white p-2 rounded-md">検索</button>
                </div>
            </div>
        </form>
        <div class="flex flex-col items-center">
            @if(isset($items))
                @forelse ($items as $hotel)
                    <x-hotel-card-search :hotel="$hotel" />
                @empty
                    <p class="text-center text-gray-500">該当する結果がありません。</p>
                @endforelse
            @else
                @foreach ($hotels as $hotel)
                    @php
                        $hotelPlans = $hotel->hotelPlans;
                    @endphp
                    @if($hotelPlans && $hotelPlans->count() > 0)
                        <x-hotel-card :hotel="$hotel"  />
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endsection
