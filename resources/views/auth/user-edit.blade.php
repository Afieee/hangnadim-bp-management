<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <style>
        /* Modern Form Styles */
        .content-area {
            padding: 20px;
        }
        
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .card-header {
            padding: 25px 30px 10px;
            border-bottom: 1px solid #f0f0f0;
            background: #fff;
        }
        
        .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #2d3748;
            padding: 0;
            background: none;
        }
        
        .card-subtitle {
            color: #718096;
            font-size: 1rem;
            margin-top: 8px;
            font-weight: 400;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .form-label {
            font-weight: 600;
            color: #2d3748;
            font-size: 0.95rem;
        }
        
        .form-input {
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
            background-color: #fff;
        }
        
        .form-input::placeholder {
            color: #a0aec0;
        }
        
        .form-note {
            font-size: 0.85rem;
            color: #718096;
            margin-top: 4px;
            font-style: italic;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        
        .btn-save {
            background: #48bb78;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(72, 187, 120, 0.2);
        }
        
        .btn-save:hover {
            background: #38a169;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(72, 187, 120, 0.3);
        }
        
        .btn-cancel {
            background: #fff;
            color: #4a5568;
            padding: 12px 25px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-cancel:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
            transform: translateY(-2px);
        }
        
        .password-container {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #4299e1;
        }
        
        .password-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* User info summary */
        .user-summary {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f0fff4;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #48bb78;
        }
        
        .user-avatar {
            width: 50px;
            height: 50px;
            background: #48bb78;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }
        
        .user-details {
            flex-grow: 1;
        }
        
        .user-name {
            font-weight: 600;
            color: #2d3748;
            margin: 0;
        }
        
        .user-email {
            color: #718096;
            margin: 5px 0 0;
            font-size: 0.9rem;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-save, .btn-cancel {
                width: 100%;
                justify-content: center;
            }
            
            .user-summary {
                flex-direction: column;
                text-align: center;
            }
        }
        
        /* Animation for form elements */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .form-group {
            animation: fadeIn 0.4s ease forwards;
        }
        
        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .password-container { animation-delay: 0.4s; }
        .form-actions { animation-delay: 0.5s; }
        
        /* Breadcrumb styling */
        .breadcrumb-container {
            margin-bottom: 20px;
        }
        
        .breadcrumb ul {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 10px;
        }
        
        .breadcrumb li {
            display: flex;
            align-items: center;
        }
        
        .breadcrumb a {
            color: #4299e1;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .breadcrumb a:hover {
            color: #2b6cb0;
            text-decoration: underline;
        }
        
        .breadcrumb li:not(:last-child)::after {
            content: "/";
            margin-left: 10px;
            color: #a0aec0;
        }
    </style>
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