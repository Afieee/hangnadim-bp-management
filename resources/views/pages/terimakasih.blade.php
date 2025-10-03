<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Terima Kasih - AEROCITY BP Batam</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/terimakasih.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">


</head>

<body>
    <div class="thank-you-container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('/storage/images/logo_bp.png') }}" alt="Logo BP Batam">
            </div>
            <h1>Terima Kasih</h1>
            <p class="subtitle">Atas Feedback Berharga Anda</p>
        </div>

        <div class="content">
            <div class="icon-container">
                <div class="icon-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
            </div>

            <div class="message">
                <p>Kami sangat menghargai waktu dan masukan yang telah Anda berikan. Feedback Anda sangat berharga bagi
                    kami untuk terus meningkatkan kualitas pelayanan dan fasilitas di <span
                        class="highlight">AEROCITY-BP Batam</span>.</p>

                <p>Tim kami akan meninjau masukan Anda dengan serius dan bekerja untuk memberikan pengalaman yang lebih
                    baik di kunjungan berikutnya.</p>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} AEROCITY-BP Batam. All rights reserved.</p>
        </div>
    </div>
    <script src="{{ asset('js/terimakasih.js') }}"></script>

</body>

</html>
