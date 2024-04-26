<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/register.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <p class="header__title">管理者登録フォーム</p>
        </div>
    </header>

    <main class="main">
        <div class="main__ttl">
            <p class="main__title">register</p>
        </div>
        <div class="main__about">
            <form action="{{ route('admin.register') }}" method="post">
            @csrf
                <div class="shop">
                    <label class="label">お名前</label>
                    <input type="text" name="admin_name" placeholder="管理者">
                </div>
                @error('admin_name')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div class="shop">
                    <label class="label">メールアドレス</label>
                    <input type="email" name="email" placeholder="メールアドレス">
                </div>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div class="shop">
                    <label class="label">パスワード</label>
                    <input type="password" name="password" placeholder="パスワード">
                </div>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="hidden" name="role" value="admin">
                <div class="button">
                    <button type="submit" class="button__ttl">登録</button>
                </div>
            </form>
            <div class="button__register">
                <a class="button__item" href="{{ route('admin.login') }}">管理画面にログインはこちら</a>
            </div>
        </div>
    </main>
</body>
</html>