
@extends('layouts.app')

@section('content')
  
    <div class="py-12">
      <x-flash-message type="success" :message="session('success')" />
      <x-flash-message type="error" :message="session('error')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        宿泊施設一覧
                    </h2>
                  <section class="text-gray-600 body-font">
                    <div class="container md:px-5 mx-auto">

                      <x-flash-message status="session('status')" />
                      <div class="flex justify-end mb-4"> 
                        <button onclick="location.href='{{ route('admin.hotels.create')}}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">宿泊施設を新規登録する</button>                        
                      </div>
                      <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                            <tr>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ホテル名</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">住所</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ホテル概要</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th></thead>
                          <tbody>
                            @foreach ($hotels as $hotel)
                            <tr>
                              <td class="md:px-4 py-3">{{ $hotel->name }}</td>
                              <td class="md:px-4 py-3">{{ $hotel->location }}</td>
                              <td class="md:px-4 py-3">{{ $hotel->description }}</td>
                              <td class="md:px-4 py-3">
                                  <a href="{{ route('admin.hotels.edit', ['hotel' => $hotel->id ])}}"
                                     class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-500 rounded flex items-center">
                                      <span class="ml-2">編集</span>
                                  </a>
                              </td>
                              <form id="delete_{{$hotel->id}}" method="post" action="{{ route('admin.hotels.destroy', ['hotel' => $hotel->id ] )}}">
                                  @csrf
                                  @method('delete')
                                  <td class="md:px-4 py-3">
                                      <a href="#" data-id="{{ $hotel->id }}" onclick="deletePost(this)"
                                        class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded flex items-center">
                                        <span class="ml-2">削除</span>
                                      </a>
                                  </td>
                              </form>
                          </tr>
                          
                            @endforeach
                          </tbody>
                        </table>
                        {{-- {{ $hotels->links() }} --}}
                      </div>
                    </div>
                  </section>
                </div>
            </div>
        </div>
    </div>
  <script>
    function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
    </script>
@endsection
