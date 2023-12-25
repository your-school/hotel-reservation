<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('user.contact');
    }

    public function submit(Request $request)
    {
        // バリデーションルールは適宜変更してください
        $request->validate([
            'message' => 'required|string',
        ]);

        // お問い合わせ内容をメールで送信
        $message = $request->input('message');
        $userEmail = auth('users')->user()->email;

        // Mail::to('admin@example.com')->send(new ContactMail($userEmail, $message));

        // DBにも保存
        Contact::create([
            'user_id' => auth('users')->id(),
            'message' => $message,
        ]);

        return redirect()->back()->with('success', 'お問い合わせが送信されました。');
    }
}
