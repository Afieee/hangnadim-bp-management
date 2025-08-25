<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <!-- Background dengan gambar gedung_vvip.jpeg saja -->
    <div class="background-container">
        <div class="background-image"></div>
    </div>

    <div class="login-container">
        <form action="{{ route('proses-login') }}" method="POST" class="login-form">
            @csrf
            <div class="form-content">
                <h2>AEROCITY-BP Management System</h2>

                @if(session('success'))
                    <div class="message success">{{ session('success') }}</div>
                @endif

                @error('email')
                    <div class="message error">{{ $message }}</div>
                @enderror

                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </div>
        </form>
    </div>

    <script>
        // Preload gambar untuk menghindari flickering
        document.addEventListener('DOMContentLoaded', function() {
            const img = new Image();
            img.src = '/storage/images/gedung_vvip.jpeg';
            img.onload = function() {
                document.querySelector('.background-image').style.backgroundImage = 'url("' + img.src + '")';
            };
        });
    </script>
</body>
</html>