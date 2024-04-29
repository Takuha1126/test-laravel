<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRコードスキャナー</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/shops/verify.css') }}" />
    <script src="https://unpkg.com/@zxing/library@latest"></script>
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
        <p class="main__title">利用者から提供されたQRコードをデバイスのカメラでスキャンして予約を確認します。</p>
        <div class="main__item">
            <video id="externalCamera" style="width: 100%; max-width: 350px;"></video>
            <button id="startScan" class="btn btn-primary">スキャンを開始</button>
        </div>
        <div class="main__about">
            <p class="about__title">QRコードの情報が読み込めましたらスキャンして確認してください。また読み込めなかった場合でもQRコード読み取りアプリで読み込んだ情報を記入しスキャンしてください。</p>
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
                    <p class="reservation__item">時間: <span id="reservationTime"></span></p>
                    <p class="reservation__item">人数: <span id="numberOfPeople"></span></p>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let isScanning = false;
            let codeReader;
            const video = document.getElementById('externalCamera');
            const startScanButton = document.getElementById('startScan');

            startScanButton.addEventListener('click', function() {
                if (!isScanning) {
                    startScan();
                } else {
                    stopScan();
                }
            });

            function startScan() {
                isScanning = true;
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(stream) {
                        video.srcObject = stream;
                        codeReader = new ZXing.BrowserQRCodeReader();
                        codeReader.decodeFromVideoDevice(undefined, video, (result, err) => {
                            if (result) {
                                document.getElementById('qrCodeData').value = result.text;
                                stopScan();
                                document.getElementById('checkQRCode').click();
                            }
                            if (err) {
                                console.error('Error decoding QR code:', err);
                            }
                        });
                    })
                    .catch(function(error) {
                        console.error('Error accessing camera:', error);
                    });
            }

            function stopScan() {
                isScanning = false;
                if (codeReader) {
                    codeReader.reset();
                }
                if (video.srcObject) {
                    video.srcObject.getTracks().forEach(track => track.stop());
                }
            }

            document.getElementById('checkQRCode').addEventListener('click', function() {
                const qrCodeData = document.getElementById('qrCodeData').value;
                
                const reservationInfo = {
                    userName: 'John Doe',
                    reservationDate: '2024-05-01',
                    reservationTime: '14:00',
                    numberOfPeople: '2'
                };
                displayReservationInfo(reservationInfo);
            });

            function displayReservationInfo(reservation) {
                document.getElementById('userName').innerText = reservation.userName;
                document.getElementById('reservationDate').innerText = reservation.reservationDate;
                document.getElementById('reservationTime').innerText = reservation.reservationTime;
                document.getElementById('numberOfPeople').innerText = reservation.numberOfPeople;

                document.getElementById('reservationInfo').style.display = 'block';
            }
        });
    </script>
</body>
</html>
