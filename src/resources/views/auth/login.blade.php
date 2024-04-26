@extends('layouts.add')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
@endsection


@section('content')
    <div class="main">
        <div class="main__ttl">
            <p class="main__login">Login</p>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
        <div class="item">
    <div class="main__item">
        <div class="main__form">
            <div class="main__email">
                <i class="fas fa-envelope" style="color: #4D4150;"></i>
                <input type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <div class="error">{{$message}}</div>
            @enderror

            <div class="main__password">
                <i class="fas fa-lock" style="color: #4D4150;"></i>
                <input type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <div class="error">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="button">
        <button class="button__title">ログイン</button>
    </div>
</div>

        </form>
    </div>
</body>
</html>
@endsection