@extends('layouts.app')

@section('content')
    <div class="py-12">
        <x-flash-message type="success" :message="session('success')" />
        <x-flash-message type="error" :message="session('error')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        お問い合わせ一覧
                    </h2>
                    <section class="text-gray-600 body-font">
                        <div class="container md:px-5 mx-auto">
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">電話番号</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td class="md:px-4 py-3">{{ $contact->user->name }}</td>
                                                <td class="md:px-4 py-3">{{ $contact->user->email }}</td>
                                                <td class="md:px-4 py-3">{{ $contact->user->phone }}</td>
                                                <td class="md:px-4 py-3">{{ $contact->status ? '回答済み' : '未回答' }}</td>
                                                <td class="md:px-4 py-3">
                                                    <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                                        class="text-white bg-green-400 border-0 py-2 px-4 focus:outline-none hover:bg-green-500 rounded flex items-center">
                                                        <span class="ml-2">詳細</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
