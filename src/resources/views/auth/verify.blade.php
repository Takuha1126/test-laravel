@extends('layouts.add')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mail.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メールアドレスを確認してください') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('新しい確認リンクがあなたのメールアドレスに送信されました。') }}
                        </div>
                    @endif

                    {{ __('続行する前に、確認リンクを含むメールをご確認ください。') }}
                    {{ __('もしメールが届かない場合は、') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('こちらをクリックして別のリンクをリクエストしてください') }}</button>。
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

