<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約一覧</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/shops/reservation.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <div class="header__title">
                <p class="header__item">予約一覧</p>
            </div>
            <nav class="nav">
                <div class="nav__button">
                    <a class="button" href="{{ route('shops.create-update', ['id' => $shopId]) }}">店舗情報の作成・更新</a>
                </div>
                <div class="nav__button">
                    <a class="button" href="{{ route('shop.verify.show') }}">QRコード照合</a>
                </div>
                <div class="logout">
                    <form action="{{ route('shop.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout__button">Logout</button>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    <main class="main">
        <div class="main__ttl">
            <table class="table">
                <thead class="thead">
                    <tr class="table__tr">
                        <th class="table__th">ユーザー名</th>
                        <th class="table__th">予約日付</th>
                        <th class="table__th">予約時間</th>
                        <th class="table__th">人数</th>
                    </tr>
                </thead>
                @if($reservations->isEmpty())
                    <p class="message">現在、予約はありません。</p>
                @else
                <tbody class="tbody">
                    @foreach($reservations as $reservation)
                    <tr class="table__tr">
                        <td class="table__td">{{ $reservation->user->name }}</td>
                        <td class="table__td">{{ $reservation->date }}</td>
                        <td class="table__td">{{ $reservation->reservation_time }}</td>
                        <td class="table__td">{{ $reservation->number_of_people }}</td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
    </main>
</body>
</html>
