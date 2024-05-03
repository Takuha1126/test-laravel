<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/add.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <i class="fas fa-file-alt fa-2x" style= "color: #3366FF;"></i>
            <a class="header__title" href="{{ route('menu') }}">Rese</a>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>