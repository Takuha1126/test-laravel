@extends('layouts.add')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css')}}">
@endsection

@section('content')
<div class="main">
    <div class="main__ttl">
        <p class="main__title">ご予約<br/>ありがとうございます</p>
    </div>
    <div class="button">
        <a href="{{ route('home') }}" class="button__title">戻る</a>
    </div>
</div>
@endsection
