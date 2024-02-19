@extends('layouts.app')

@section('content')
<div class="py-12">
    <x-flash-message type="success" :message="session('success')" />
    <x-flash-message type="error" :message="session('error')" />
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="md:p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    宿泊者詳細
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="font-semibold">名前:</p>
                        <p>{{ optional($reservation->user)->name }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">電話番号:</p>
                        <p>{{ optional($reservation->user)->phone }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">ホテル名:</p>
                        <p>{{ optional($reservation->hotelPlan->hotel)->name }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">宿泊プラン名:</p>
                        <p>{{ optional($reservation->hotelPlan)->title }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">料金:</p>
                        <p>{{ $reservation->hotelPlan->price * $reservation->getNumberOfNights() }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">メッセージ:</p>
                        <p>{{ optional($reservation)->message }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">宿泊日:</p>
                        <p>{{ $reservation->check_in_date }} 〜 {{ $reservation->check_out_date }}</p>
                    </div>
                    <div class="col-span-2">
                        <form action="{{ route('admin.reservers.cancel', ['reservation' => $reservation->id ]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">
                                予約キャンセル
                            </button>
                            <div class="mt-6">
                                <a href="{{ route('admin.reservers.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 transition duration-300">一覧に戻る</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
