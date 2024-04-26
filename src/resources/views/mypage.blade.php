@extends('layouts.add')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
@endsection


@section('content')
<div class="main">
    <div class="main__ttl">
        <p class="main__title">{{ Auth::user()->name}}さん</p>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="item">
        <div class="item__ttl">
            <div class="main__group">
                <div class="about">
                    <div class="reservation-container">
                        <p class="item__title">予約状況</p>
                    @if ($reservations->isEmpty())
                    <p class="shop__delete">予約情報がありません</p>
                    @else
                    @foreach ($reservations as $key => $reservation)
                        <div class="shop">
                            <div class="shop__ttl">
                                <div class="shop__item">
                                    <i class="fas fa-clock" style= "color: #fff;"></i>
                                    <p class="shop__title">予約{{ $key + 1 }}</p>
                                    <a href="/reservations/{{ $reservation->id }}" class="button" style="margin-left: 10px;">
                                        <i class="fas fa-qrcode" style="color: #fff; background-color: #3366FF; border-radius: 50%; padding: 5px;
                                        font-size: 20px;"></i>
                                    </a>
                                </div>
                                <form id="delete-form-{{ $reservation->id }}" action="/reservations/{{ $reservation->id }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="button">
                                        <i class="fas fa-times-circle" style="color: #3366FF; background-color: white; border-radius: 50%; padding: 2px;"></i>
                                    </button>
                                </form>
                            </div>
                            <table class="shop__table">
                                <tr class="table__tr">
                                    <th class="table__th">Shop</th>
                                    <td class="table__td">{{ $reservation->shop->shop_name }}</td>
                                </tr>
                                <tr class="table__tr">
                                    <th class="table__th">Date</th>
                                    <td class="table__td">{{ $reservation->date}}</td>
                                </tr>
                                <tr class="table__tr">
                                    <th class="table__th">Time</th>
                                    <td class="table__td">{{ $reservation->reservation_time}}</td>
                                </tr>
                                <tr class="table__tr">
                                    <th class="table__th">Number</th>
                                    <td class="table__td">{{ $reservation->number_of_people}}人</td>
                                </tr>
                                <tr class="table__tr">
                                    <td class="table__button">
                                        <form action="{{ route('visit', ['reservationId' => $reservation->id]) }}" method="POST">
                                        @csrf
                                            <button class="visit-button" data-reservation-id="{{ $reservation->id }}">来店</button>
                                        </form>
                                        <button class="payment-button">支払い</button>
                                        <button class="edit-button">編集</button>
                                        <form class="change-form" action="{{route('reservation.update',['id' => $reservation->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                            <div class="new__date">
                                                <label for="new_date" class="new__date-label">新しい日付:</label>
                                                <input class="new__date-input" type="date" id="new_date" name="new_date" required>
                                            </div>
                                            <div class="new__time">
                                                <label for="new_reservation_time" class="new__time-label">新しい時間:</label>
                                                <select class="new__time-input" id="new_reservation_time"  name="new_reservation_time" required>
                                                    @for ($i = 11; $i <= 22; $i++)
                                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                                                        @endfor
                                                </select>
                                            </div>
                                            <div class="new__people">
                                                <label class="new__number-label" for="new_number_of_people">新しい人数:</label>
                                                <select name="new_number_of_people" id="new_number_of_people">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }} 人</option>
                                                @endfor
                                                </select>
                                            </div>
                                            <div class="button__ttl">
                                                <button type="submit" class="update-button">変更する</button>
                                                <button type="button" class="cancel-button">キャンセル</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="favorite-container">
                <p class="favorite__title">お気に入りの店</p>
                @if ($favorites->isEmpty())
                    <p class="favorites-message">お気に入りがありません</p>
                @else
                    <p class="favorites-message" style="display: none;">お気に入りがありません</p>
                <div class="favorite__container">
                    @foreach($favorites as $favorite)
                        @php
                            $shop = $favorite->shop;
                        @endphp
                        <div class="favorite__item" id="favorite-item-{{ $shop->id }}">
                            <div class="favorite__ttl">
                                <div class="card">
                                    <img src="{{ $shop->photo_url }}">
                                </div>
                                <div class="favorite__content">
                                    <p class="favorite__group">{{ $shop->shop_name }}</p>
                                    <div class="favorite__tag">
                                        <p class="favorite__area">#{{ $shop->area->area_name }}</p>
                                        <p class="favorite__genre">#{{ $shop->genre->genre_name }}</p>
                                    </div>
                                    <div class="favorite_button">
                                        <form action="{{ route('detail', ['shop_id' => $shop->id]) }}" method="GET">
                                            <button class="button__title" type="submit">詳しく見る</button>
                                        </form>
                                        @if ($favorite->status)
                                        <form action="{{ route('favorite.toggle', ['shopId' => $shop->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="heart-button liked" data-shop-id="{{ $shop->id }}">&#10084;</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(function() {
    $('.heart-button').click(function(event) {
        event.preventDefault();
        toggleFavorite($(this));
    });

    $('.edit-button').click(function() {
        toggleEdit($(this));
    });

    $('.cancel-button').click(function() {
        toggleEditCancel($(this));
    });

    $('.visit-button').click(function() {
        redirectVisit($(this));
    });

    $('.payment-button').click(function() {
        redirectToPayment();
    });
});

function toggleFavorite(button) {
    const shopId = button.data('shop-id');
    $.ajax({
        url: `/favorite/toggle/${shopId}`,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { shop_id: shopId },
        success: function(response) {
            $(`#favorite-item-${shopId}`).hide(0, function() {
                $(this).remove();
                checkEmptyFavorites();
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('お気に入りの操作に失敗しました。');
        }
    });
}

function toggleEdit(button) {
    button.hide();
    button.closest('tr').find('.change-form').show();
}

function toggleEditCancel(button) {
    button.closest('.change-form').hide();
    button.closest('tr').find('.edit-button').show();
}

function redirectVisit(button) {
    const reservationId = button.closest('tr').data('reservation-id');
    const visitUrl = `{{ route('visit', ['reservationId' => ':reservationId']) }}`.replace(':reservationId', reservationId);
    window.location.href = visitUrl;
}

function redirectToPayment() {
    window.location.href = "{{ route('payment.page') }}";
}


function checkEmptyFavorites() {
    if ($('.favorite__item:visible').length === 0) {
        $('.favorites-message').show();
    }
}
</script>

@endsection