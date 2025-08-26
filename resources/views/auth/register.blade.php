<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerocity Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

</head>


<body class="bg-light">
{{-- Components --}}
<x-navbar />
<x-sidebar />
@if(session('success'))
<div id="toast" class="toast">
    <div class="toast-icon">
        <i class="fas fa-check" style="color: white; display: none;"></i>
    </div>
    <div class="toast-content">
        <div class="toast-title">Success!</div>
        <div class="toast-message">{{ session('success') }}</div>
    </div>
    <button class="toast-close">&times;</button>
    <div class="toast-progress"></div>
</div>
@endif
    <!-- Content Wrapper -->
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-eye"></i> Tambah Pengguna</li>
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









        document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast');
        if(toast) {
            // Show toast with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Close toast when close button is clicked
            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                toast.classList.remove('show');
            });
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    });

</script>
</body>

</html>