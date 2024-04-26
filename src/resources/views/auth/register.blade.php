@extends('layouts.add')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="main">
    <div class="main__ttl">
        <p class="main__title">Register</p>
    </div>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="item">
            <div class="main__item">
                <div class="main__user">
                    <i class="fas fa-user" style="color: #4D4150;"></i>
                    <input type="text" name="name" placeholder="Username">
                </div>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div class="main__email">
                    <i class="fas fa-envelope" style="color: #4D4150;"></i>
                    <input type="email" name="email" placeholder="Email">
                </div>
                @error('email')
                        <div class="error">{{ $message }}</div>
                @enderror
                <div class="main__password">
                    <i class="fas fa-lock" style="color: #4D4150;"></i>
                    <input type="password" name="password" placeholder="Password">
                </div>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>
            <div class="button">
                <button class="button__title" type="submit">登録</button>
            </div>
        </div>
    </form>
</div>
@endsection
