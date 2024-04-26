@extends('layouts.add')


@section('content')
    <div style="text-align: center;">
        <h1>予約QRコード</h1>
        {{-- QRコードの表示 --}}
        {!! $qrCode !!}
    </div>
    <div class="main__title" style="text-align: center;">
        <p class="main__ttl">受付の際はこちらをご提示ください</p>
    </div>
@endsection