<?php

namespace App\Http\Controllers;

use App\Mail\AdminContactMessage;
use App\Mail\UserContactMessage;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('user.contact');
    }

    public function submit(Request $request)
    {

        // バリデーションルールを定義
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        // 入力されたメールアドレスと電話番号でUserを検索
        $user = User::where('name', $request->input('name'))
            ->where('email', $request->input('email'))
            ->first();

        // Userが存在しない場合、エラーメッセージをフラッシュしリダイレクト
        if (!$user) {
            return redirect()->route('user.contact')->with('error', '宿泊予約者でないとお問い合わせできません');
        }

        // お問い合わせ内容をメールで送信
        $message = $request->input('message');

        // 宿泊者へのお問い合わせ完了メールを送信
        Mail::to($request->input('email'))->send(new UserContactMessage($user, $message));

        // 管理者へのお問い合わせ受信メールを送信
        Mail::to('admintest@test.com')->send(new AdminContactMessage($user, $message));

        // DBにも保存
        Contact::create([
            'user_id' => $user->id,
            'message' => $message,
            'status' => 0,
        ]);
        return redirect()->route('user.contact')->with('success', 'お問い合わせが送信されました');
    }
}
