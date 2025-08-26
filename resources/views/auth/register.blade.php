<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<style>
    /* Modern variables for consistent theming */
    :root {
        --primary: #4a6cf7;
        --primary-dark: #0b5ed7;
        --secondary: #6c757d;
        --success: #198754;
        --light: #f8f9fa;
        --dark: #212529;
        --border-radius: 12px;
        --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    /* Content area styling */
    .content-area {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 40px 20px;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf1 100%);
        min-height: 100vh;
    }

    .form-container {
        width: 100%;
        max-width: 520px;
    }

    .form-card {
        background: #fff;
        border-radius: var(--border-radius);
        padding: 35px;
        box-shadow: var(--box-shadow);
        animation: fadeInUp 0.6s ease;
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(to right, var(--primary), var(--primary-dark));
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-header h2 {
        font-size: 1.9rem;
        color: var(--dark);
        margin-bottom: 10px;
        font-weight: 700;
    }

    .form-header p {
        font-size: 0.95rem;
        color: var(--secondary);
        line-height: 1.5;
    }

    /* Input group */
    .form-group {
        margin-bottom: 22px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #444;
        font-size: 0.9rem;
    }

    .input-with-icon {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--secondary);
        z-index: 1;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 14px 14px 14px 45px;
        border-radius: var(--border-radius);
        border: 1.5px solid #e2e8f0;
        outline: none;
        transition: var(--transition);
        font-size: 0.95rem;
        background: #fafafa;
        color: var(--dark);
    }

    .form-group select {
        padding: 14px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23444' viewBox='0 0 16 16'%3E%3Cpath d='M8 13.1l-8-8 1.5-1.5L8 10.1l6.5-6.5L16 5.1z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.15);
    }

    /* Password visibility toggle */
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--secondary);
        z-index: 2;
    }

    /* Button Modern Clean */
    .btn-submit {
        width: 100%;
        padding: 15px;
        background: linear-gradient(to right, var(--primary), var(--primary-dark));
        border: none;
        border-radius: var(--border-radius);
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 10px;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(74, 108, 247, 0.25);
    }

    .btn-submit:hover {
        background: linear-gradient(to right, var(--primary-dark), #0a58ca);
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(13, 110, 253, 0.3);
    }

    .btn-submit:active {
        transform: translateY(0);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .form-card {
            padding: 25px 20px;
        }
        
        .form-header h2 {
            font-size: 1.6rem;
        }
    }
</style>

<body class="bg-light">
{{-- Components --}}
<x-navbar />
<x-sidebar />

    <!-- Content Wrapper -->
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-eye"></i> Pengguna & Petugas</li>
                </ul>
            </div>
        </div>

        <div class="content-area">
            <div class="form-container">
                <div class="form-card">
                    <div class="form-header">
                        <h2>Form Registrasi Pengguna</h2>
                        <p>Silakan isi data pengguna petugas bandara baru di bawah ini</p>
                    </div>
                    <form action="/proses-registrasi" method="POST">
                        @csrf
        
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <div class="input-with-icon">
                                <i class="input-icon fas fa-user"></i>
                                <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <div class="input-with-icon">
                                <i class="input-icon fas fa-envelope"></i>
                                <input type="email" name="email" id="email" placeholder="contoh@email.com" required>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <div class="input-with-icon">
                                <i class="input-icon fas fa-lock"></i>
                                <input type="password" name="password" id="password" placeholder="Minimal 6 karakter" required>
                                <span class="password-toggle" id="passwordToggle">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <div class="input-with-icon">
                                <i class="input-icon fas fa-lock"></i>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi" required>
                                <span class="password-toggle" id="confirmPasswordToggle">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="role">Role</label>
                            <div class="input-with-icon">
                                <select name="role" id="role" required>
                                    <option value="Kepala Seksi">Kepala Seksi</option>
                                    <option value="Staff Pelaksana">Staff Pelaksana</option>
                                    <option value="Direktur">Direktur</option>
                                    <option value="Kepala Bidang">Kepala Bidang</option>
                                    <option value="Deputi">Deputi</option>
                                </select>
                            </div>
                        </div>
        
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-user-plus"></i> Daftarkan Pengguna
                        </button>
                    </form>
                </div>
            </div>
        </div>

{{-- Components --}}


<script src="{{ asset('js/components.js') }}"></script>
<script>
    // Password visibility toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const passwordToggle = document.getElementById('passwordToggle');
        const confirmPasswordToggle = document.getElementById('confirmPasswordToggle');
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');
        
        if (passwordToggle) {
            passwordToggle.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
        
        if (confirmPasswordToggle) {
            confirmPasswordToggle.addEventListener('click', function() {
                const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordField.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    });
</script>
</body>

</html>