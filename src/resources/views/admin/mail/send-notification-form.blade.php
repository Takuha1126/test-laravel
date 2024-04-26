<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/email.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <div class="header__title">
                <p class="header__item">メール送信フォーム</p>
            </div>
        </div>
        <nav class="nav">
            <div class="shop">
                <a class="shop__button" href="{{ route('admin.index') }}">代表者登録</a>
            </div>
            <div class="logout">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout__button">Logout</button>
                </form>
            </div>
        </nav>
    </header>
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <main class="main">
        <div class="main__ttl">
            <div class="main__item">
                <p class="main__title">メール内容を入力してください</p>
            </div>
            <div class="main__about">
                <div class="email__first">
                    <form action="{{ route('send-notification.single') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="user_id" class="label">対象ユーザー</label>
                            <select name="user_id" id="user_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message_content" class="label">メッセージ内容</label>
                            <textarea class="form-control" id="message_content" name="message_content" rows="3"></textarea>
                        </div>
                        <div class="button">
                            <button type="submit" class="first-mail">メール送信</button>
                        </button>
                    </form>
                </div>
                <div class="email__all">
                    <div class="all__title">
                        <p class="all__ttl">ユーザー全員に送りたい場合はこちらにメール内容を入力してください</p>
                    </div>
                    <form action="{{ route('send-notification.all') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="message_content" class="label">メッセージ内容</label>
                        <textarea class="form-control" id="message_content" name="message_content" rows="3"></textarea>
                    </div>
                    <div class="button">
                        <button type="submit" class="second-mail">全員にメール送信</button>
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>

