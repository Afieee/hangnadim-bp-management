<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerocity Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">
    <style>
    </style>
</head>

<body>
    <!-- Futuristic Grid Background -->
    <div class="grid-background"></div>

    <!-- Animated Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Light effect that follows mouse -->
    <div class="light-effect" id="light-effect"></div>

    <!-- Halo effect around mouse -->
    <div class="halo" id="halo-effect"></div>

    <!-- Connection lines -->
    <div class="connections" id="connections"></div>

    <!-- Particles background -->
    <div class="particles" id="particles"></div>

    <div class="login-container">
        <div class="neon-line"></div>
        <form action="{{ route('proses-login') }}" method="POST" class="login-form">
            @csrf
            <div class="form-content">
                <h2>Inspection Management System</h2>

                <div class="auto-typer" id="auto-typer">
                    <span id="typing-text"></span><span class="cursor"></span>
                </div>

                @if (session('success'))
                    <div class="message success">{{ session('success') }}</div>
                @endif

                @error('error')
                    <div class="message error">{{ $message }}</div>
                @enderror

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nip_atau_nup" placeholder="NIP/NUP" value="{{ old('nip_atau_nup') }}"
                        required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
