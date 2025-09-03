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
<body>
<x-navbar/>
<x-sidebar />

<div class="content-wrapper" id="content-wrapper">
    <div class="breadcrumb-container">
        <div class="breadcrumb">
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('manage-user') }}">Manage User</a></li>
                <li>Edit User</li>
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
                            <input type="text" name="nip_atau_nup" value="{{ old('nip_atau_nup', $user->nip_atau_nup) }}" class="form-input" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" placeholder="Masukkan alamat email" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-input" required>
                                <option value="Kepala Seksi">Kepala Seksi</option>
                                <option value="Staff Pelaksana">Staff Pelaksana</option>
                                <option value="Direktur">Direktur</option>
                                <option value="Kepala Bidang">Kepala Bidang</option>
                                <option value="Deputi">Deputi</option>
                            </select>
                        </div>

                        <div class="password-container">
                            <div class="password-title">
                                <i class="fas fa-lock"></i> Ganti Password
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                                <input type="password" name="password" class="form-input" placeholder="Masukkan password baru">
                                <div class="form-note">Minimal 8 karakter dengan kombinasi huruf dan angka</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-input" placeholder="Konfirmasi password baru">
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
</html>