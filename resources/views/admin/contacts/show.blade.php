<!-- resources/views/admin/contacts/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="py-12">
        <x-flash-message type="success" :message="session('success')" />
        <x-flash-message type="error" :message="session('error')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        お問い合わせ詳細
                    </h2>

                    <div class="mb-4">
                        <p><strong>名前:</strong> {{ $contact->user->name }}</p>
                        <p><strong>メールアドレス:</strong> {{ $contact->user->email }}</p>
                        <p><strong>電話番号:</strong> {{ $contact->user->phone }}</p>
                        <p><strong>ステータス:</strong> {{ $contact->status ? '回答済み' : '未回答' }}</p>
                        <p><strong>お問い合わせ内容:</strong> {{ $contact->message }}</p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.contacts.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">戻る</a>

                        @if ($contact->status === 0)
                        <form method="post" action="{{ route('admin.contacts.update', $contact->id) }}">
                            @csrf
                            @method('patch')
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">ステータス変更</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
