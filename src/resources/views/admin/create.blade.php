<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <div class="header__title">
                <p class="header__item">代表者一覧</p>
            </div>
            <nav class="nav">
                <div class="shop">
                    <a class="shop__button" href="{{ route('admin.index') }}">代表者登録</a>
                </div>
                <div class="send-mail">
                    <a class="send-mail__button" href="{{ route('send-notification.form') }}">メール送信</a>
                </div>
                <div class="logout">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout__button">Logout</button>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    <main class="main">
        <div class="main__ttl">
            <table class="table">
                <thead class="thead">
                    <tr class="table__tr">
                        <th class="table__th">代表者名</th>
                        <th class="table__th">担当店舗</th>
                        <th class="table__th">メールアドレス</th>
                        <th class="table__th">削除</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach($representatives as $representative)
                    <tr class="table__tr">
                        <td class="table__td">{{ $representative->representative_name }}</td>
                        <td class="table__td">{{$representative->shop->shop_name}}</td>
                        <td class="table__td">{{ $representative->email }}</td>
                        <td class="table__td">
                            <form action="{{ route('representatives.destroy', $representative->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="delete">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>