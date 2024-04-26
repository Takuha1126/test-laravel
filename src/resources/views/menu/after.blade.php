<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <a class="header__title" href="{{ route('home') }}"><i class="fas fa-square fa-times fa-xs fa-2x" style= "color: #fff;"></i></a>
        </div>
    </header>

    <main class="main">
        <div class="menu">
            <div class="menu__ttl">
                <a href="{{ route('home') }}">Home</a>
            </div>
            <div class="button">
                <a href="#" class="button__title" id="logout-link">Logout</a>
            </div>
            <div class="menu__ttl">
                <a href="{{ route('mypage') }}">Mypage</a>
            </div>
        </div>
    </main>
    <script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
    event.preventDefault();

    fetch('/logout', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        credentials: 'same-origin'
    }).then(response => {
        if (response.ok) {
        window.location.href = '/';
        }
    }).catch(error => console.error('Error:', error));
});
</script>
</body>
</html>