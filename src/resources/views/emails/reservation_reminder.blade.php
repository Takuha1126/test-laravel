<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約リマインダー</title>
</head>
<body>
    <h1>予約リマインダー</h1>
    <p>こちらは今日の予約リマインダーです。</p>

    
    <h2>予約情報</h2>
    <ul>
        <li>店舗名: {{ $reservation->shop->shop_name }}</li>
        <li>予約日時: {{ $reservation->date }} {{ $reservation->reservation_time }}</li>
        <li>人数: {{ $reservation->number_of_people }}人</li>
    </ul>
</body>
</html>
