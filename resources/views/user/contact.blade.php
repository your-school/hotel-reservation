@extends('user.top')

@section('title', 'Contact Us')

@section('content')
<x-flash-message type="success" :message="session('success')" />
<x-flash-message type="error" :message="session('error')" />
    <h2 class="text-2xl font-semibold mb-4">お問い合わせ</h2>
    <!-- お問い合わせフォーム -->
    <form method="post" action="{{ route('user.contact.submit') }}">
        @csrf
        <label for="message" class="block mb-2">お問い合わせ内容</label>
        <textarea name="message" id="message" rows="10" class="w-full border rounded p-2 mb-4"></textarea>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">送信</button>
    </form>
@endsection