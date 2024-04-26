@extends('layouts.add')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css')}}">
@endsection


@section('content')
<div class="main">
    <div class="main__ttl">
        <p class="main__title">会員登録<br/>ありがとうございます</p>
    </div>
    <div class="button">
        <a href="{{ route('home') }}" class="button__title">ログインする</a>

    </div>
</div>
@endsection
