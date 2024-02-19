@extends('layouts.app')

@section('content')
  
    <div class="py-12">
        <x-flash-message type="success" :message="session('success')" />
        <x-flash-message type="error" :message="session('error')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white  border-gray-200 flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        予約者一覧
                    </h2>
                    <form action="{{ route('admin.reservers.search') }}" method="GET" class="ml-auto">
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <input type="text" name="keyword" placeholder="キーワードを入力" class="p-2">
                            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md">検索</button>
                        </div>
                    </form>
                </div>
                <section class="text-gray-600 body-font">
                    <div class="container md:px-5 mx-auto">
                        <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr>
                                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">電話番号</th>
                                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ホテル名</th>
                                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">宿泊プラン名</th>
                                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">（合計）料金</th>
                                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">宿泊日</th>
                                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="md:px-4 py-3">{{ optional($reservation->user)->name }}</td>      
                                        <td class="md:px-4 py-3">{{ optional($reservation->user)->phone }}</td>                                  
                                        <td class="md:px-4 py-3">{{ optional($reservation->hotelPlan->hotel)->name }}</td>
                                        <td class="md:px-4 py-3">{{ optional($reservation->hotelPlan)->title }}</td>
                                        <td class="md:px-4 py-3">{{ $reservation->hotelPlan->price * $reservation->getNumberOfNights() }}</td>
                                        <td class="md:px-4 py-3">{{ $reservation->check_in_date }}〜{{ $reservation->check_out_date }}</td>
                                        <td class="md:px-4 py-3">
                                            <a href="{{ route('admin.reservers.show', ['id' => $reservation->id ])}}"
                                                class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-500 rounded flex items-center">
                                                <span class="ml-2">編集</span>
                                            </a>
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $plans->links() }}                     --}}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
