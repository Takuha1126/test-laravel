<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/shops/shop.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <div class="header__title">
                <p class="header__item">店舗情報の作成・更新画面</p>
            </div>
            <nav class="nav">
                <div class="nav__button">
                    <div class="button__item">
                        <a class="button" href="{{ route('shops.reservations.list')}}" >予約一覧</a>
                    </div>
                    <div class="button__item">
                        <a class="button" href="{{ route('shop.verify.show') }}">QRコード照合</a>
                    </div>
                    <div class="logout">
                        <form action="{{ route('shop.logout') }}" method="POST">
                        @csrf
                            <button type="submit" class="logout__button">Logout</button>
                        </form>
                    </div>
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
            <div class="main__about">
                <p class="main__p">店舗の変更情報を入力してください</p>
            </div>
            <form action="{{ route('shop.update', $shop->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="main__title">
                    <div class="main__item">
                        <label class="label">写真</label>
                        <select name="photo_url" id="photoSelect">
                            <option value="">選択してください</option>
                            <option value="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg">寿司</option>
                            <option value="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg">焼肉</option>
                            <option value="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg">居酒屋</option>
                            <option value="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg">イタリアン</option>
                            <option value="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg">ラーメン</option>
                        </select>
                    </div>
                    @error('photo_url')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="main__item">
                        <label class="label">店舗名</label><input type="text" name="shop_name" placeholder="店舗名">
                    </div>
                    @error('shop_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="main__item">
                        <label class="label">エリア名</label>
                        <select class="first" name="area_id" id="areaSelect">
                            <option value="">選択してください</option>
                            <option value="1">東京都</option>
                            <option value="2">大阪府</option>
                            <option value="3">福岡県</option>
                        </select>
                    </div>
                    @error('area_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="main__item">
                        <label class="label">ジャンル名</label>
                        <select class="second" name="genre_id" id="genreSelect">
                            <option value="">選択してください</option>
                            <option value="1">寿司</option>
                            <option value="2">焼肉</option>
                            <option value="3">居酒屋</option>
                            <option value="4">イタリアン</option>
                            <option value="5">ラーメン</option>
                        </select>
                    </div>
                    @error('genre_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="main__item">
                        <label class="label">お店の紹介</label>
                        <textarea name="description" cols="30" rows="10" placeholder="お客さんのことを考えて料理します。"></textarea>
                    </div>
                     @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="button">
                    <button class="button__ttl" type="submit">保存</button>
                </div>
            </form>
        <div>
    </main>
</body>
</html>