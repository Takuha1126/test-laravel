<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <p class="header__title">管理者ログインフォーム</p>
        </div>
    </header>
    @if ($errors->has('loginError'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('loginError') }}
        </div>
    @endif
    <main class="main">
        <div class="main__ttl">
            <p class="main__title">Login</p>
        </div>
        <div class="main__about">
            <form action="{{ route('admin.login') }}" method="post">
            @csrf
                <div class="email">
                    <label for="email" class="label">メールアドレス</label>
                    <input type="email" name="email"  placeholder="メールアドレス">
                </div>
                @error('email')
                    <div class="error">{{$message}}</div>
                @enderror
                <div class="password">
                    <label for="password" class="label">パスワード</label>
                    <input type="password" name="password" placeholder="パスワード">
                </div>
                @error('password')
                    <div class="error">{{$message}}</div>
                @enderror
                <input type="hidden" name="role" value="admin">
                <div class="button">
                    <button type="submit" class="button__ttl">ログイン</button>
                </div>
            </form>
            <div class="button__register">
                <a class="button__item" href="{{ route('admin.register') }}">管理者登録はこちら</a>
            </div>
        </div>
    </main>
</body>
</html>