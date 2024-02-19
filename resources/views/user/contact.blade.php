@extends('user.top')

@section('title', 'Contact Us')

@section('content')
<x-flash-message type="success" :message="session('success')" />
<x-flash-message type="error" :message="session('error')" />
    <h2 class="text-2xl font-semibold mb-4">お問い合わせ</h2>
    <!-- お問い合わせフォーム -->
    <form method="post" action="{{ route('user.contact.submit') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block mb-2">お名前</label>
            <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block mb-2">メールアドレス</label>
            <input type="email" name="email" id="email" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="phone" class="block mb-2">電話番号</label>
            <input type="tel" name="phone" id="phone" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="message" class="block mb-2">お問い合わせ内容</label>
            <textarea name="message" id="message" rows="10" class="w-full border rounded p-2 mb-4" required></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">送信</button>
    </form>
@endsection
