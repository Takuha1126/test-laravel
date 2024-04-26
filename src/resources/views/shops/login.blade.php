<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/shops/login.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <p class="header__title">店舗予約管理画面ログイン</p>
        </div>
    </header>
    @if(session('error_message'))
    <div class="alert alert-danger">
        {{ session('error_message') }}
    </div>
    @endif
    <main class="main">
        <div class="main__ttl">
            <p class="main__title">Login</p>
        </div>
        <div class="main__about">
            <form action="{{ route('shop.login.submit') }}" method="post">
            @csrf
                <div class="shop">
                    <label>店舗名</label>
                    <select name="shop_id" required>
                        @foreach ($shops as $shop)
                            <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="password">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password">
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div class="error">{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="button">
                    <button type="submit" class="button__ttl">ログイン</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>