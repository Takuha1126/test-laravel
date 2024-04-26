<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <div class="header__title">
                <p class="header__item">代表者登録</p>
            </div>
            <nav class="nav">
                <div class="shop">
                    <a class="shop__button" href="{{ route('admin.create') }}">代表者一覧</a>
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
            <form action="{{ route('shop_representatives.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="shop_name" class="label">店舗名</label>
                <select name="shop_id">
                    @foreach ($shops as $shop)
                        <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                    @endforeach
                </select>
            </div>
            @error('shop_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="name" class="label">名前</label>
                <input type="text" class="form-control" id="name" name="representative_name" placeholder="text太郎">
            </div>
            @error('representative_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="email" class="label">メールアドレス</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="text@icloud.com">
            </div>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="password" class="label">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="text111">
            </div>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="button">
                <button type="submit" class="btn-primary">作成</button>
            </div>
            </form>
        </div>
    </main>
</body>
</html>