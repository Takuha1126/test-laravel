<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>
<body>
    <header class="header">
        <form action="/search" method="post">
            @csrf
        <div class="header__item">
            <div class="header__ttl">
                <i class="fas fa-file-alt fa-2x" style="color: #3366FF;"></i>
                <a class="header__title" href="{{ route('menu') }}">Rese</a>
            </div>
            <nav class="nav">
                <div class="nav__ttl">
                    <div class="select-wrapper">
                    <select class="first" name="area_id" id="areaSelect">
                        <option value="">area</option>
                        <option value="東京都">東京都</option>
                        <option value="大阪府">大阪府</option>
                        <option value="福岡県">福岡県</option>
                    </select>
                    <select class="second" name="genre_id" id="genreSelect">
                        <option value="">genre</option>
                        <option value="寿司">寿司</option>
                        <option value="焼肉">焼肉</option>
                        <option value="居酒屋">居酒屋</option>
                        <option value="イタリアン">イタリアン</option>
                        <option value="ラーメン">ラーメン</option>
                    </select>
                    <i class="fas fa-search" style="color: #cccccc;"></i>
                    <input type="text" id="searchInput" name="search" placeholder="Search...">
                </div>
            </nav>
        </div>
        </form>
    </header>
    <main class="main">
        @if (isset($searched))
            @foreach ($searched as $shop)
                <div class="main__group">
                    <div class="card">
                        <img src="{{ $shop->photo_url }}">
                    </div>
                    <div class="main__content">
                        <div class="main__title">{{ $shop->shop_name }}</div>
                        <div class="main__tag">
                            <p class="main__area">#{{ $shop->area->area_name }}</p>
                            <p class="main__genre">#{{ $shop->genre->genre_name }}</p>
                        </div>
                        <div class="button">
                            <form action="{{ route('detail', ['shop_id' => $shop->id]) }}" method="GET">
                                <button class="button__title" type="submit">詳しく見る</button>
                            </form>
                            <button class="heart-button">
                                &#10084;
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @foreach ($shops as $shop)
                <div class="main__group">
                    <div class="card">
                        <img src="{{ $shop->photo_url }}">
                    </div>
                    <div class="main__content">
                        <div class="main__title">{{ $shop->shop_name }}</div>
                        <div class="main__tag">
                            <p class="main__area">#{{ $shop->area->area_name }}</p>
                            <p class="main__genre">#{{ $shop->genre->genre_name }}</p>
                        </div>
                        <div class="button">
                            <form action="{{ route('detail', ['shop_id' => $shop->id]) }}" method="GET">
                                <button class="button__title" type="submit">詳しく見る</button>
                            </form>
                            <form class="favorite-form" action="{{ route('favorite.toggle', ['shopId' => $shop->id]) }}" method="post">
                            @csrf
                                <button type="submit" class="heart-button" data-shop-id="{{ $shop->id }}">&#10084;</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if ($loop->iteration >= 20)
                    @break
                @endif
            @endforeach
        @endif
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchFavoritesAndUpdateHearts();

    const heartButtons = document.querySelectorAll('.heart-button');
    heartButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const shopId = this.dataset.shopId;
            toggleFavorite(this, shopId);
        });
    });
});

function fetchFavoritesAndUpdateHearts() {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || {};

    document.querySelectorAll('.heart-button').forEach(button => {
        const shopId = button.dataset.shopId;

        updateFavoriteStatus(button, shopId, favorites);

        fetch(`/favorite/status/${shopId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            updateFavoriteStatus(button, shopId, favorites, data.isFavorite);
        })
        .catch(error => {
            console.error('Error fetching favorite status:', error);
        });
    });
}

function updateFavoriteStatus(button, shopId, favorites, isFavorite = favorites[shopId] || false) {
    button.classList.toggle('liked', isFavorite);
    favorites[shopId] = isFavorite;
    localStorage.setItem('favorites', JSON.stringify(favorites));
}

function toggleFavorite(button, shopId) {
    const isLiked = button.classList.contains('liked');
    const method = isLiked ? 'DELETE' : 'POST';

    button.classList.toggle('liked', !isLiked);
    toggleHeart(button);

    fetch(`/favorite/toggle/${shopId}`, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ shop_id: shopId })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
            button.classList.toggle('liked', isLiked);
            toggleHeart(button);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('お気に入りの操作に失敗しました。');
        button.classList.toggle('liked', isLiked);
        toggleHeart(button);
    });
}




$(document).ready(function() {
    $('.first').select2({
        minimumResultsForSearch: Infinity
    });
    $('.second').select2({
        minimumResultsForSearch: Infinity
    });

    $('#searchInput').on('input', function() {
        filterCards();
    });

    $('#areaSelect').on('change', function() {
        filterCards();
    });

    $('#genreSelect').on('change', function() {
        filterCards();
    });

    function filterCards() {
        var selectedArea = $('#areaSelect').val();
        var selectedGenre = $('#genreSelect').val();
        var keyword = $('#searchInput').val().toLowerCase();

        var cards = $('.main__group');

        cards.each(function() {
            var areaName = $(this).find('.main__area').text();
            var genreName = $(this).find('.main__genre').text();
            var cardText = $(this).text().toLowerCase();
            

            if ((selectedArea === "" || areaName.includes(selectedArea)) &&
                (selectedGenre === "" || genreName.includes(selectedGenre)) &&
                (keyword === "" || cardText.includes(keyword))) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});

function toggleHeart(element) {
    $(element).toggleClass('red-heart');
}





    </script>
</body>
</html>