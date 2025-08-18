<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-form {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            background: #3490dc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-form .error {
            color: red;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .login-form .success {
            color: green;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <form action="{{ route('proses-login') }}" method="POST" class="login-form">
        @csrf
        <h2>Login</h2>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
