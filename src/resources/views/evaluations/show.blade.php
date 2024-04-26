@extends('layouts.add')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css')}}">
@endsection

@section('content')
<div class="main">
    <div class="main__title">
        <p class="evaluation__title">評価ページ</p>
    </div>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('evaluation.store') }}" method="POST">
    @csrf
    <div class="main__ttl">
        <div class="evaluation__item">
            <p class="evaluation__about">来店ありがとうございました!</p>
            <p class="evaluation__about-second">当店のサービスはどうでしたでしょうか？</p>
            <p class="evaluation__about-time">もしよろしければ評価をお願いします!</p>
        </div>
        <div class="evaluation__rating">
            <p class="evaluation__rating-title">評価を選択してください</p>
            <div class="star-rating">
                <i class="fas fa-star" data-rating="1"></i>
                <i class="fas fa-star" data-rating="2"></i>
                <i class="fas fa-star" data-rating="3"></i>
                <i class="fas fa-star" data-rating="4"></i>
                <i class="fas fa-star" data-rating="5"></i>
                <input type="hidden" name="rating" id="rating" value="">
            </div>
        </div>
        <div class="evaluation__comment">
            <p class="evaluation__comment-title">コメントを入力してください</p>
            <textarea name="comment" class="evaluation__comment-field" rows="4" placeholder="ここにコメントをお願いします。"></textarea>
        </div>
        <div class="button">
            <button type="submit" class="button__title">送信</button>
        </div>
    </div>
    </form>

</div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.fas.fa-star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            let rating = parseInt(this.getAttribute('data-rating'));
            ratingInput.value = rating;
            stars.forEach(star => {
                if (parseInt(star.getAttribute('data-rating')) <= rating) {
                    star.classList.add('checked');
                } else {
                    star.classList.remove('checked');
                }
            });
        });
    });
});


    $(document).ready(function() {
        $('.fa-star').click(function() {
            var starValue = $(this).data('value');
            $('#rating').val(starValue);

            $('.fa-star').each(function() {
                if ($(this).data('value') <= starValue) {
                    $(this).css('color', 'gold');
                } else {
                    $(this).css('color', 'black');
                }
            });
        });
    });
    </script>
</body>
</html>


@endsection

