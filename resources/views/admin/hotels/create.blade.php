@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-8">
    <div class="bg-white py-6 sm:py-8 lg:py-12">

    <div class="mx-auto max-w-screen-2xl px-4 md:px-8 ">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            宿泊施設登録
        </h2>
        <!-- text - start -->
        <div class="mb-10 md:mb-16 ">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl "></h2>
        </div>
        <!-- text - end -->

        <!-- form - start -->
        <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data" class="mx-auto grid max-w-screen-md gap-4 sm:grid-cols-2">
            @csrf
            <div class="sm:col-span-2">
                <label for="subject" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">宿泊施設 名前</label>
                <input name="name" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
            </div>
        
            <div class="sm:col-span-2">
                <label for="subject" class="mb-2 inline-block text-sm text-gray-800 sm:text-base py-2">宿泊施設 住所</label>
                <input name="location" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required/>
            </div>
            <div class="sm:col-span-2 py-2">
                <label for="comment" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">宿泊施設 概要</label>
                <textarea name="description" class="h-64 w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required></textarea>
            </div>
            <div class="sm:col-span-2">
                <label for="image" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">画像（JPEG、JPG、PNGのみ）</label>
                <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
            </div>
            <div class="flex items-center justify-between sm:col-span-2 py-2">
                <button type="submit" class="inline-block rounded-lg bg-indigo-500 py-2 px-4 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">投稿する</button>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.hotels.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 transition duration-300">一覧に戻る</a>
            </div>
        </form>
        
        <!-- form - end -->
    </div>
    </div>
</div>
@endsection
