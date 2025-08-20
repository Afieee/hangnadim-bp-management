<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard - Detail Inspeksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --info: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
        }
        
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        
        
        .breadcrumb ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }
        
        .breadcrumb li {
            margin-right: 10px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .breadcrumb li:not(:last-child):after {
            content: '/';
            margin-left: 10px;
            color: var(--gray);
        }
        
        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .breadcrumb a:hover {
            color: var(--secondary);
        }
        
        .breadcrumb .active {
            color: var(--gray);
        }
        
        .content-area {
            background-color: transparent;
        }
        
        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .container {
            padding: 20px;
        }
        
        h1 {
            color: var(--dark);
            font-size: 28px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        h2 {
            color: var(--primary);
            font-size: 20px;
            margin-top: 25px;
            margin-bottom: 15px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .info-card {
            background-color: var(--light);
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
        }
        
        .info-card p {
            margin: 8px 0;
        }
        
        .status-select {
            margin-bottom: 15px;
        }
        
        .status-select select {
            width: 100%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background-color: white;
            font-size: 15px;
            margin-top: 5px;
            transition: all 0.3s;
        }
        
        .status-select select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary);
        }
        
        .btn-success {
            background-color: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background-color: #3aafd9;
        }
        
        .btn-back {
            background-color: var(--light);
            color: var(--dark);
        }
        
        .btn-back:hover {
            background-color: var(--light-gray);
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .gallery {
            margin-top: 30px;
        }
        
        .gallery-title {
            font-size: 22px;
            margin-bottom: 20px;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .gallery-title i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .gallery-item {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .gallery-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .gallery-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .gallery-item:hover .gallery-image img {
            transform: scale(1.05);
        }
        
        .gallery-content {
            padding: 15px;
        }
        
        .gallery-content h3 {
            margin-top: 0;
            margin-bottom: 10px;
            color: var(--dark);
            font-size: 18px;
        }
        
        .gallery-content p {
            color: var(--gray);
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .gallery-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid var(--light-gray);
        }
        
        .damage-type {
            background-color: var(--light);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
            gap: 10px;
        }
        
        hr {
            border: none;
            height: 1px;
            background-color: var(--light-gray);
            margin: 25px 0;
        }
        
        /* Improved Upload Styles */
        .upload-container {
            margin-bottom: 20px;
        }
        
        .upload-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .upload-box {
            border: 2px dashed #a0a0ff;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: rgba(240, 242, 255, 0.5);
            position: relative;
        }
        
        .upload-box:hover {
            border-color: var(--primary);
            background-color: rgba(240, 242, 255, 0.8);
        }
        
        .upload-box.dragover {
            border-color: var(--success);
            background-color: rgba(76, 201, 240, 0.1);
        }
        
        .upload-box i {
            font-size: 40px;
            color: var(--primary);
            margin-bottom: 15px;
            display: block;
        }
        
        .upload-box .upload-text {
            display: block;
            color: var(--gray);
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .upload-box .upload-hint {
            display: block;
            color: var(--gray);
            font-size: 13px;
        }
        
        .upload-preview {
            margin-top: 20px;
            display: none;
        }
        
        .preview-container {
            display: flex;
            align-items: center;
            background-color: var(--light);
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 10px;
        }
        
        .preview-icon {
            margin-right: 15px;
            font-size: 24px;
            color: var(--primary);
        }
        
        .preview-info {
            flex-grow: 1;
        }
        
        .preview-name {
            font-weight: 500;
            margin-bottom: 5px;
            word-break: break-all;
        }
        
        .preview-size {
            color: var(--gray);
            font-size: 13px;
        }
        
        .preview-remove {
            color: var(--danger);
            cursor: pointer;
            font-size: 18px;
            padding: 5px;
        }
        
        .file-input {
            display: none;
        }
        
        @media (max-width: 992px) {
            .content-wrapper {
                margin-left: 0;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="/dashboard"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-eye"></i> Penjadwalan Inspeksi</li>
                    <li class="active">
                        <i class="fas fa-eye"></i> 
                        Inspeksi {{ $inspeksi->gedung->nama_gedung ?? '-' }} - 
                        {{ \Carbon\Carbon::parse($inspeksi->created_at)->format('F Y') }}, 
                        Minggu ke-{{ \Carbon\Carbon::parse($inspeksi->created_at)->weekOfMonth }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div class="card">            
                <div class="container">
                    <h1>Detail Inspeksi</h1>

                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        </div>
                    @endif

                    <div class="info-grid">
                        <div class="info-card">
                            <h2>Informasi Gedung</h2>
                            <p><strong>Nama Gedung:</strong> {{ $inspeksi->gedung->nama_gedung ?? '-' }}</p>
                            <p><strong>Tanggal Inspeksi:</strong> {{ $inspeksi->created_at ?? '-' }}</p>
                        </div>

                        <div class="info-card">
                            <h2>Kepala Seksi</h2>
                            <p><strong>Nama Petugas:</strong> {{ $inspeksi->user->name ?? '-' }}</p>
                            <p><strong>Email:</strong> {{ $inspeksi->user->email ?? '-' }}</p>
                        </div>

                        <div class="info-card">
                            <h2>Detail Inspeksi</h2>
                            <p><strong>ID Inspeksi:</strong> {{ $inspeksi->id }}</p>
                            <p><strong>Status:</strong> {{ $inspeksi->status_keseluruhan_inspeksi ?? '-' }}</p>
                        </div>
                    </div>

                    <h2>Status Komponen</h2>
                    
                    <div class="status-select">
                        <p><strong>Furniture:</strong></p>
                        <select name="furniture" class="border rounded px-2 py-1">
                            <option>Belum Diperiksa</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Fire System:</strong></p>
                        <select name="fire_system" class="border rounded px-2 py-1">
                            <option>Belum Diperiksa</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Bangunan:</strong></p>
                        <select name="bangunan" class="border rounded px-2 py-1">
                            <option>Belum Diperiksa</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Mekanikal Elektrikal:</strong></p>
                        <select name="mekanikal_elektrikal" class="border rounded px-2 py-1">
                            <option>Belum Diperiksa</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>IT:</strong></p>
                        <select name="it" class="border rounded px-2 py-1">
                            <option>Belum Diperiksa</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    
                    <div class="status-select">
                        <p><strong>Interior:</strong></p>
                        <select name="interior" class="border rounded px-2 py-1">
                            <option>Belum Diperiksa</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Eksterior:</strong></p>
                        <select name="eksterior" class="border rounded px-2 py-1">
                            <option>Belum Diperiksa</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    
                    <div class="status-select">
                        <p><strong>Sanitasi:</strong></p>
                        <select name="sanitasi" class="border rounded px-2 py-1">
                            <option>Belum Diperiksa</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <hr>

                    <h2>Tambah Bukti Kerusakan</h2>
                    <form action="{{ route('bukti-kerusakan.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        <div class="form-group">
                            <label for="judul_bukti_kerusakan">Objek Bukti Kerusakan</label>
                            <input type="text" id="judul_bukti_kerusakan" name="judul_bukti_kerusakan" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_bukti_kerusakan">Deskripsi Bukti Kerusakan</label>
                            <textarea id="deskripsi_bukti_kerusakan" name="deskripsi_bukti_kerusakan" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tipe_kerusakan">Tipe Kerusakan</label>
                            <select id="tipe_kerusakan" name="tipe_kerusakan">
                                <option value="Furniture">Furniture</option>
                                <option value="Fire System">Fire System</option>
                                <option value="Bangunan">Bangunan</option>
                                <option value="Mekanikal Elektrikal">Mekanikal Elektrikal</option>
                                <option value="IT">IT</option>
                                <option value="Interior">Interior</option>
                                <option value="Eksterior">Eksterior</option>
                                <option value="Sanitasi">Sanitasi</option>
                            </select>
                        </div>

                        <div class="upload-container">
                            <label class="upload-label">Upload Bukti Foto</label>
                            <div class="upload-box" id="uploadBox">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span class="upload-text">Klik untuk memilih file atau seret file ke sini</span>
                                <span class="upload-hint">Format yang didukung: JPG, PNG (Maks. 5MB)</span>
                                <input type="file" id="file_bukti_kerusakan" name="file_bukti_kerusakan" class="file-input" accept="image/*">
                            </div>
                            <div class="upload-preview" id="uploadPreview">
                                <div class="preview-container">
                                    <div class="preview-icon">
                                        <i class="fas fa-file-image"></i>
                                    </div>
                                    <div class="preview-info">
                                        <div class="preview-name" id="previewFileName">Nama file akan muncul di sini</div>
                                        <div class="preview-size" id="previewFileSize">Ukuran file akan muncul di sini</div>
                                    </div>
                                    <div class="preview-remove" id="removeFileBtn">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id_inspeksi_gedung" value="{{ $inspeksi->id }}">

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Bukti Kerusakan
                            </button>
                        </div>
                    </form>

                    <hr>

                    <!-- Galeri Bukti Kerusakan -->
                    <div class="gallery">
                        <h2 class="gallery-title">
                            <i class="fas fa-images"></i> Lampiran Bukti Kerusakan
                        </h2>
                        
                        @if($buktiKerusakans->count() > 0)
                            <div class="gallery-grid">
                                @foreach ($buktiKerusakans as $buktiKerusakan)
                                    <div class="gallery-item">
                                        <div class="gallery-image">
                                            @if ($buktiKerusakan->file_bukti_kerusakan)
                                                <img src="{{ asset('storage/' . $buktiKerusakan->file_bukti_kerusakan) }}" 
                                                    alt="Bukti Kerusakan">
                                            @else
                                                <img src="https://via.placeholder.com/300x200?text=No+Image" 
                                                    alt="Tidak ada gambar">
                                            @endif
                                        </div>
                                        <div class="gallery-content">
                                            <h3>{{ $buktiKerusakan->judul_bukti_kerusakan }}</h3>
                                            <p>{{ $buktiKerusakan->deskripsi_bukti_kerusakan }}</p>
                                            <div class="gallery-meta">
                                                <span class="damage-type">{{ $buktiKerusakan->tipe_kerusakan }}</span>
                                                <a href="{{ route('bukti-perbaikan.create', $buktiKerusakan->id) }}" 
                                                   class="btn btn-success">
                                                    <i class="fas fa-upload"></i> Upload Perbaikan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>Belum ada bukti kerusakan yang diupload.</p>
                        @endif
                    </div>

                    <div class="action-buttons">
                        <a href="{{ url()->previous() }}" class="btn btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('js/components.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const uploadBox = document.getElementById('uploadBox');
                const fileInput = document.getElementById('file_bukti_kerusakan');
                const uploadPreview = document.getElementById('uploadPreview');
                const previewFileName = document.getElementById('previewFileName');
                const previewFileSize = document.getElementById('previewFileSize');
                const removeFileBtn = document.getElementById('removeFileBtn');
                
                // Handle click on upload box
                uploadBox.addEventListener('click', function(e) {
                    if (e.target !== fileInput) {
                        fileInput.click();
                    }
                });
                
                // Handle file selection
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        
                        // Validate file size (max 5MB)
                        if (file.size > 5 * 1024 * 1024) {
                            alert('Ukuran file terlalu besar. Maksimal 5MB.');
                            this.value = '';
                            return;
                        }
                        
                        // Validate file type
                        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!validTypes.includes(file.type)) {
                            alert('Format file tidak didukung. Harap gunakan JPG, PNG, atau GIF.');
                            this.value = '';
                            return;
                        }
                        
                        // Display file info
                        previewFileName.textContent = file.name;
                        previewFileSize.textContent = formatFileSize(file.size);
                        uploadPreview.style.display = 'block';
                        
                        // Add visual feedback
                        uploadBox.classList.add('has-file');
                    }
                });
                
                // Handle drag and drop
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    uploadBox.addEventListener(eventName, preventDefaults, false);
                });
                
                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                
                ['dragenter', 'dragover'].forEach(eventName => {
                    uploadBox.addEventListener(eventName, highlight, false);
                });
                
                ['dragleave', 'drop'].forEach(eventName => {
                    uploadBox.addEventListener(eventName, unhighlight, false);
                });
                
                function highlight() {
                    uploadBox.classList.add('dragover');
                }
                
                function unhighlight() {
                    uploadBox.classList.remove('dragover');
                }
                
                uploadBox.addEventListener('drop', handleDrop, false);
                
                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    
                    if (files.length) {
                        fileInput.files = files;
                        const event = new Event('change');
                        fileInput.dispatchEvent(event);
                    }
                }
                
                // Handle file removal
                removeFileBtn.addEventListener('click', function() {
                    fileInput.value = '';
                    uploadPreview.style.display = 'none';
                    uploadBox.classList.remove('has-file');
                });
                
                // Format file size
                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                }
            });
        </script>
    </div>
</body>
</html>