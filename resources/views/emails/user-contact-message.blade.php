<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせありがとうございます</title>
</head>
<body>
    <p>{{ $user->name }} 様</p>
    <p>この度はお問い合わせいただき、誠にありがとうございます。</p>
    <p>以下の内容でお問い合わせを受け付けました。</p>
    <p>お問い合わせ内容: {{ $message }}</p>
    <p>ご入力いただいた情報は弊社のプライバシーポリシーに基づいて取り扱われます。</p>
    <p>今後ともよろしくお願いいたします。</p>
</body>
</html>
