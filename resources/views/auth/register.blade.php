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
    /* Styling form registrasi hanya di content-area */
.content-area {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 20px;
    background: linear-gradient(to right, #f9f9f9, #eef3f7);
    min-height: 100vh;
}

.form-container {
    width: 100%;
    max-width: 500px;
}

.form-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    animation: fadeInUp 0.6s ease;
}

.form-header {
    text-align: center;
    margin-bottom: 25px;
}

.form-header h2 {
    font-size: 1.8rem;
    color: #333;
    margin-bottom: 8px;
}

.form-header p {
    font-size: 0.9rem;
    color: #666;
}

/* Input group */
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #444;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #ddd;
    outline: none;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    background: #fafafa;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #007bff;
    background: #fff;
    box-shadow: 0 0 6px rgba(0,123,255,0.2);
}

/* Button Modern Clean */
.btn-submit {
    width: 100%;
    padding: 14px;
    background: #4a6cf7; /* Biru modern */
    border: none;
    border-radius: 10px;
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    background: #0b5ed7; /* Biru sedikit lebih gelap */
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(13, 110, 253, 0.3);
}

.btn-submit:active {
    transform: translateY(0);
    box-shadow: none;
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
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
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
                            <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap" required>
                        </div>
        
                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" name="email" id="email" placeholder="contoh@email.com" required>
                        </div>
        
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" name="password" id="password" placeholder="Minimal 6 karakter" required>
                        </div>
        
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi" required>
                        </div>
        
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" required>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <option value="petinggi">Petinggi</option>
                            </select>
                        </div>
        
                        <button type="submit" class="btn-submit">Daftarkan Pengguna</button>
                    </form>
                </div>
            </div>
        </div>

{{-- Components --}}
<x-footer />


<script src="{{ asset('js/components.js') }}"></script>
</body>

</html>