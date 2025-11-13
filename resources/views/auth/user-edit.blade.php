@if (Auth::user()->role == 'Admin')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aerocity User Management</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/components.css') }}">
        <link rel="stylesheet" href="{{ asset('css/user-edit.css') }}">
        <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

    </head>
    <style>
        /* Toast Notification Enhancement */
        .toast {
            background-color: #4CAF50;
            color: white;
        }










        /* Modern Toast Notification */
        .toast {
            position: fixed;
            top: 20px;
            /* Changed from 50% to 20px from top */
            left: 50%;
            transform: translateX(-50%) scale(0.8);
            /* Removed Y translation */
            background-color: #fff;
            color: #333;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            font-family: 'Segoe UI', sans-serif;
            font-size: 16px;
            z-index: 9999;
            opacity: 0;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 5px solid #4CAF50;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            max-width: 350px;
            width: 90%;
        }

        /* Show toast with animation */
        .toast.show {
            opacity: 1;
            transform: translateX(-50%) scale(1);
            /* Removed Y translation */
        }

        /* Checkmark icon container */
        .toast-icon {
            width: 40px;
            height: 40px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
        }

        /* Checkmark animation */
        .toast-icon::before {
            content: "";
            position: absolute;
            width: 20px;
            height: 10px;
            border-left: 3px solid white;
            border-bottom: 3px solid white;
            transform: rotate(-45deg) scale(0);
            top: 12px;
            left: 8px;
            transition: transform 0.3s ease 0.2s;
        }

        .toast.show .toast-icon::before {
            transform: rotate(-45deg) scale(1);
        }

        /* Toast content */
        .toast-content {
            flex-grow: 1;
        }

        /* Toast title */
        .toast-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: #222;
        }

        /* Close button */
        .toast-close {
            background: none;
            border: none;
            color: #999;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
            margin-left: 10px;
            transition: color 0.2s;
        }

        .toast-close:hover {
            color: #666;
        }

        /* Progress bar */
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background-color: rgba(76, 175, 80, 0.2);
        }

        .toast-progress::before {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            height: 100%;
            width: 100%;
            background-color: #4CAF50;
            animation: progress 3s linear forwards;
        }
    </style>

    <body>
        <x-navbar />
        <x-sidebar />
        @if (session('success'))
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
        <div class="content-wrapper" id="content-wrapper">
            <div class="breadcrumb-container">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li><a href="{{ route('manage-user') }}"> <i class="fas fa-user"></i> Manage User</a></li>
                        <li><a href=""> <i class="fas fa-user"></i> Edit User</a></li>
                    </ul>
                </div>
            </div>

            <div class="content-area">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">
                            <i class="fas fa-user-edit"></i> Edit User
                        </h1>
                        <p class="card-subtitle">Update informasi pengguna dengan formulir di bawah</p>
                    </div>

                    <div class="card-body">
                        <div class="user-summary">
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-details">
                                <h3 class="user-name">{{ $user->name }}</h3>
                                <p class="user-email">{{ $user->email }}</p>
                            </div>
                        </div>

                        <form action="{{ route('manage-user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-container">
                                <div class="form-group">
                                    <label class="form-label">NIP/NUP</label>
                                    <input type="text" name="nip_atau_nup"
                                        value="{{ old('nip_atau_nup', $user->nip_atau_nup) }}" class="form-input"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-input" placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="form-input" placeholder="Masukkan alamat email" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Role</label>
                                    <select name="role" class="form-input" id="role" required>
                                        <option value="Admin"> Admin</option>
                                        <option value="Kepala Seksi">Kepala Seksi</option>
                                        <option value="Staff Pelaksana">Staff Pelaksana</option>
                                        <option value="Kepala Sub Direktorat ">Kepala Sub Direktorat</option>
                                        <option value="Direktur">Direktur</option>
                                        <option value="Deputi">Deputi</option>
                                        <option value="Tata Usaha">Tata Usaha</option>
                                        <option value="IT">IT</option>
                                        <option value="Pengelola Asset">Pengelola Asset</option>
                                        <option value="Staff Pengelola Asset">Staff Pengelola Asset</option>
                                    </select>
                                </div>

                                <div class="password-container">
                                    <div class="password-title">
                                        <i class="fas fa-lock"></i> Ganti Password
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                                        <input type="password" name="password" class="form-input"
                                            placeholder="Masukkan password baru">
                                        <div class="form-note">Minimal 8 karakter dengan kombinasi huruf dan angka</div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-input"
                                            placeholder="Konfirmasi password baru">
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn-save">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('manage-user') }}" class="btn-cancel">
                                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/components.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast');
            if (toast) {
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

    </html>
@elseif (in_array(Auth::user()->role, [
        'Direktur',
        'Staff Pelaksana',
        'Kepala Sub Direktorat',
        'Kepala Seksi',
        'Tata Usaha',
        'IT',
    ]))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aerocity User Management</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/components.css') }}">
        <link rel="stylesheet" href="{{ asset('css/user-edit.css') }}">
        <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

    </head>
    <style>
        /* Toast Notification Enhancement */
        .toast {
            background-color: #4CAF50;
            color: white;
        }










        /* Modern Toast Notification */
        .toast {
            position: fixed;
            top: 20px;
            /* Changed from 50% to 20px from top */
            left: 50%;
            transform: translateX(-50%) scale(0.8);
            /* Removed Y translation */
            background-color: #fff;
            color: #333;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            font-family: 'Segoe UI', sans-serif;
            font-size: 16px;
            z-index: 9999;
            opacity: 0;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 5px solid #4CAF50;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            max-width: 350px;
            width: 90%;
        }

        /* Show toast with animation */
        .toast.show {
            opacity: 1;
            transform: translateX(-50%) scale(1);
            /* Removed Y translation */
        }

        /* Checkmark icon container */
        .toast-icon {
            width: 40px;
            height: 40px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
        }

        /* Checkmark animation */
        .toast-icon::before {
            content: "";
            position: absolute;
            width: 20px;
            height: 10px;
            border-left: 3px solid white;
            border-bottom: 3px solid white;
            transform: rotate(-45deg) scale(0);
            top: 12px;
            left: 8px;
            transition: transform 0.3s ease 0.2s;
        }

        .toast.show .toast-icon::before {
            transform: rotate(-45deg) scale(1);
        }

        /* Toast content */
        .toast-content {
            flex-grow: 1;
        }

        /* Toast title */
        .toast-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: #222;
        }

        /* Close button */
        .toast-close {
            background: none;
            border: none;
            color: #999;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
            margin-left: 10px;
            transition: color 0.2s;
        }

        .toast-close:hover {
            color: #666;
        }

        /* Progress bar */
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background-color: rgba(76, 175, 80, 0.2);
        }

        .toast-progress::before {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            height: 100%;
            width: 100%;
            background-color: #4CAF50;
            animation: progress 3s linear forwards;
        }
    </style>

    <body>
        <x-navbar />
        <x-sidebar />
        @if (session('success'))
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
        <div class="content-wrapper" id="content-wrapper">
            <div class="breadcrumb-container">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li><a href="{{ route('manage-user') }}"> <i class="fas fa-user"></i> Manage User</a></li>
                        <li><a href=""> <i class="fas fa-user"></i> Edit User</a></li>
                    </ul>
                </div>
            </div>

            <div class="content-area">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">
                            <i class="fas fa-user-edit"></i> Edit User
                        </h1>
                        <p class="card-subtitle">Update informasi pengguna dengan formulir di bawah</p>
                    </div>

                    <div class="card-body">
                        <div class="user-summary">
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-details">
                                <h3 class="user-name">{{ $user->name }}</h3>
                                <p class="user-email">{{ $user->email }}</p>
                            </div>
                        </div>

                        <form action="{{ route('manage-user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-container">
                                <div class="form-group">
                                    <input type="text" name="nip_atau_nup"
                                        value="{{ old('nip_atau_nup', $user->nip_atau_nup) }}" class="form-input"
                                        placeholder="Masukkan nama lengkap" required hidden>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-input" placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="form-input" placeholder="Masukkan alamat email" required>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="role" value="{{ old('role', $user->role) }}">
                                </div>



                                <div class="password-container">
                                    <div class="password-title">
                                        <i class="fas fa-lock"></i> Ganti Password
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                                        <input type="password" name="password" class="form-input"
                                            placeholder="Masukkan password baru">
                                        <div class="form-note">Minimal 8 karakter dengan kombinasi huruf dan angka
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-input"
                                            placeholder="Konfirmasi password baru">
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn-save">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('manage-user') }}" class="btn-cancel">
                                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/components.js') }}"></script>

    </html>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast');
            if (toast) {
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
@endif
