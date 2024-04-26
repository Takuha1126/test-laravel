<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/shops/verify.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__ttl">
            <div class="header__title">
                <p class="header__item">QRコード確認</p>
            </div>
            <nav class="nav">
                <div class="nav__button">
                    <div class="button__item">
                        <a class="button" href="{{ route('shops.reservations.list')}}" >予約一覧</a>
                    </div>
                    <div class="logout">
                        <form action="{{ route('shop.logout') }}" method="POST">
                        @csrf
                            <button type="submit" class="logout__button">Logout</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <p class="main__title">利用者から提供されたQRコードをデバイスのカメラでスキャンして予約を確認します。</p>
            <div class="main__item">
                <video id="externalCamera" style="width: 100%; max-width: 350px;"></video>
                <button id="startScan" class="btn btn-primary">スキャンを開始</button>
            </div>
        </div>
        <div class="main__about">
            <p class="about__title">もし読み込めなかった場合はQRコードアプリで読み込んだ情報をこちらにお書きください</p>
            <div class="main__group">
                <div class="main__ttl">
                    <form id="qrVerificationForm">
                        <div class="form-group">
                            <label for="qrCodeData">QRコードデータ</label>
                            <textarea class="form-control" id="qrCodeData" name="qr_code_data" rows="4" required></textarea>
                        </div>
                        <div class="button__ttl">
                            <button type="button" class="check__button" id="checkQRCode">スキャンして確認</button>
                        </div>
                    </form>
                </div>
                <div id="reservationInfo" style="display: none;" class="reservation__group">
                    <h2 class="reservation">予約情報</h2>
                    <p class="reservation__item">ユーザー名: <span id="userName"></span></p>
                    <p class="reservation__item">日付: <span id="reservationDate"></span></p>
                    <p  class="reservation__item">時間: <span id="reservationTime"></span></p>
                    <p class="reservation__item">人数: <span id="numberOfPeople"></span></p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://unpkg.com/@zxing/library@latest"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let isScanning = false;
            let codeReader;
            
            try {
                codeReader = new ZXing.BrowserQRCodeReader();
                console.log('ZXing initialized successfully');

                const qrCodeDataInput = document.getElementById('qrCodeData');
                const video = document.getElementById('externalCamera');
                const startScanButton = document.getElementById('startScan');
                const checkQRCodeButton = document.getElementById('checkQRCode');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                startScanButton.addEventListener('click', function() {
                    if (!isScanning) {
                        startScan(video, qrCodeDataInput);
                    } else {
                        stopScan();
                    }
                });

                checkQRCodeButton.addEventListener('click', function() {
                    const qrCodeData = qrCodeDataInput.value;
                    const url = '/shop/verify';

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ qr_code_data: qrCodeData })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.name) {
                            displayReservationInfo(data);
                        } else if (data.error) {
                            alert(data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });

                function startScan(videoElem, inputElem) {
                    isScanning = true;
                    codeReader.decodeFromInputVideoDevice(undefined, videoElem, (result, err) => {
                        if (result) {
                            inputElem.value = result.text;
                            stopScan();
                            document.getElementById('checkQRCode').click();
                        }
                        if (err) {
                            console.error('Error decoding QR code:', err);
                        }
                    });
                }

                function stopScan() {
                    isScanning = false;
                    codeReader.reset();
                }

                function displayReservationInfo(reservation) {
                    document.getElementById('userName').innerText = reservation.name;
                    document.getElementById('reservationDate').innerText = reservation.date;
                    document.getElementById('reservationTime').innerText = reservation.time;
                    document.getElementById('numberOfPeople').innerText = reservation.number_of_people;

                    document.getElementById('reservationInfo').style.display = 'block';
                }
            } catch (error) {
                console.error('Error initializing ZXing:', error);
            }
        });
    </script>

</body>
</html>
