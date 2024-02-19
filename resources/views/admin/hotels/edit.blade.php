@extends('layouts.app')

@section('content')

<div class="container mx-auto my-8 p-6 bg-white shadow-md rounded-lg">
    <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700">ホテル名</label>
            <input type="text" id="title" name="name" value="{{ $hotel->name }}" class="mt-1 p-2 w-full border rounded-md">
        </div>

        <div class="mb-6">
            <label for="location" class="block text-sm font-medium text-gray-700">ホテル住所</label>
            <input type="text" id="location" name="location" value="{{ $hotel->location }}" class="mt-1 p-2 w-full border rounded-md">
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700">ホテル概要</label>
            <input type="text" id="description" name="description" value="{{ $hotel->description }}" class="mt-1 p-2 w-full border rounded-md">
        </div>

        {{-- 画像表示 --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">ホテル画像</label>
            @if ($hotel->hotelFiles->isNotEmpty())
            <img src="{{ asset('storage/' . $hotel->hotelFiles->first()->file_path) }}" alt="{{ $hotel->name }}" class="mt-2 w-64 h-auto border">
            @else
            <p class="text-gray-500 mt-2">No image available</p>
            @endif
        </div>

        {{-- 画像選択のためのinputタグ --}}
        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700">画像を選択してください（JPEG、JPG、PNGのみ）</label>
            <input type="file" id="image" name="image" accept="image/jpeg,image/jpg,image/png" class="mt-1 p-2 w-full border rounded-md">
        </div>

        {{-- 追加のフォーム項目を追加できます --}}

        <div class="mt-6">
            <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 transition duration-300">更新する</button>
        </div>
    </form>

    {{-- 戻るボタン --}}
    <div class="mt-6">
        <a href="{{ route('admin.hotels.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 transition duration-300">一覧に戻る</a>
    </div>
</div>

@endsection
