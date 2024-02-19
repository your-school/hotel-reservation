<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせが届きました</title>
</head>
<body>
    <p>管理者様</p>
    <p>お問い合わせが届きました。</p>
    <p>以下の内容でお問い合わせを受け付けました。</p>
    <p>お問い合わせ内容: {{ $message }}</p>
    <p>お客様情報: {{ $user->name }} ({{ $user->email }})</p>
</body>
</html>
