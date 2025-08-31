<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kerusakan Pribadi</title>

    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-inspeksi-petugas.blade.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    /* Modern Toast Notification */
    .toast {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%) scale(0.8);
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

    @keyframes progress {
        0% { width: 100%; }
        100% { width: 0%; }
    }

    /* Custom styles for the dashboard cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
    }
    
    .stat-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 20px;
    }
    
    .stat-content {
        flex-grow: 1;
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: bold;
        margin: 10px 0;
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 14px;
    }
    
    .stat-trend {
        display: flex;
        align-items: center;
        margin-top: 10px;
        font-size: 14px;
    }
    
    .trend-up {
        color: #28a745;
    }
    
    .trend-down {
        color: #dc3545;
    }
    
    .progress-container {
        margin-top: 15px;
    }
    
    .progress-bar {
        height: 8px;
        background-color: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .progress-fill {
        height: 100%;
        border-radius: 4px;
    }
    
    .chart-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    
    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .chart-actions button {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 5px;
    }
    
    .chart-placeholder {
        height: 300px;
        background-color: #f8f9fa;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }

    /* Styling untuk tabel yang lebih modern */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .modern-table thead th {
        background-color: #3b82f6;
        color: white;
        font-weight: 600;
        padding: 12px 15px;
        text-align: left;
    }
    
    .modern-table tbody tr {
        transition: background-color 0.2s;
    }
    
    .modern-table tbody tr:nth-child(even) {
        background-color: #f8fafc;
    }
    
    .modern-table tbody tr:hover {
        background-color: #eef2ff;
    }
    
    .modern-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .rating-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .rating-excellent {
        background-color: #10b981;
        color: white;
    }
    
    .rating-good {
        background-color: #3b82f6;
        color: white;
    }
    
    .rating-average {
        background-color: #f59e0b;
        color: white;
    }
    
    .rating-poor {
        background-color: #ef4444;
        color: white;
    }
    
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .pagination .page-item .page-link {
        color: #3b82f6;
        border: 1px solid #e2e8f0;
        padding: 8px 16px;
        border-radius: 6px;
        margin: 0 4px;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #3b82f6;
        border-color: #3b82f6;
        color: white;
    }
    
    .pagination .page-item.disabled .page-link {
        color: #94a3b8;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 0;
        color: #64748b;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #cbd5e1;
    }
    
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .card-header {
        background-color: white;
        border-bottom: 1px solid #e2e8f0;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .card-title {
        margin: 0;
        font-weight: 600;
        color: #1e293b;
    }
    
    .filter-container {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .filter-select {
        padding: 8px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background-color: white;
    }

    .rating-blue {
        background-color: #3b82f6;
        color: white;
    }
    .rating-green {
        background-color: #10b981;
        color: white;
    }
    .rating-yellow {
        background-color: #fbbf24;
        color: white;
    }
    .rating-red {
        background-color: #ef4444;
        color: white;
    }
    .rating-default {
        background-color: #6b7280;
        color: white;
    }

    /* Upload Preview Styles */
    .upload-container {
        margin-bottom: 20px;
    }
    
    .upload-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
    }
    
    .upload-box {
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background-color: #f9fafb;
    }
    
    .upload-box:hover {
        border-color: #3b82f6;
        background-color: #eff6ff;
    }
    
    .upload-box.dragover {
        border-color: #3b82f6;
        background-color: #dbeafe;
    }
    
    .upload-box i {
        font-size: 48px;
        color: #9ca3af;
        margin-bottom: 10px;
    }
    
    .upload-text {
        display: block;
        font-weight: 500;
        color: #4b5563;
        margin-bottom: 5px;
    }
    
    .upload-hint {
        font-size: 14px;
        color: #6b7280;
    }
    
    .file-input {
        display: none;
    }
    
    .upload-preview {
        display: none;
        margin-top: 20px;
    }
    
    .preview-container {
        display: flex;
        align-items: center;
        background-color: #f3f4f6;
        border-radius: 8px;
        padding: 15px;
        border: 1px solid #e5e7eb;
    }
    
    .preview-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        margin-right: 15px;
    }
    
    .preview-icon {
        font-size: 36px;
        color: #6b7280;
        margin-right: 15px;
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
        font-size: 14px;
        color: #6b7280;
    }
    
    .preview-remove {
        color: #ef4444;
        cursor: pointer;
        font-size: 20px;
    }
    
    .preview-remove:hover {
        color: #dc2626;
    }
    
    .error-message {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
        display: none;
    }

    .field-error {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }

    </style>
</head>

<body>
    <!-- Komponen x diisolasi dari CSS halaman -->
    <div style="all: initial">
        <x-navbar />
    </div>
    
    <div style="all: initial">
        <x-sidebar />
    </div>
    
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

    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-calendar-check"></i> Laporan Kerusakan Pribadi</li>
                </ul>
            </div>
        </div>
        
        <div class="content-area">
            <div class="card">            
                <div class="container">
                    <h2 style="margin-bottom: 50px">Laporan Kerusakan Crash Condition Pribadi</h2>
                    <form action="{{ route('bukti-kerusakan-pribadi.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf

                        <div class="form-group">
                            <label for="tipe_kerusakan">Tipe Kerusakan</label>
                            <select id="tipe_kerusakan" name="tipe_kerusakan" required>
                                <option value="">Pilih Tipe Kerusakan</option>
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

                        <div class="form-group">
                            <label for="judul_bukti_kerusakan">Objek Bukti Kerusakan</label>
                            <input type="text" id="judul_bukti_kerusakan" name="judul_bukti_kerusakan" required>
                        </div>

                        <div class="form-group">
                            <label for="lokasi_bukti_kerusakan">Lokasi Spesifik</label>
                            <input type="text" id="lokasi_bukti_kerusakan" name="lokasi_bukti_kerusakan" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_bukti_kerusakan">Deskripsi Bukti Kerusakan</label>
                            <textarea id="deskripsi_bukti_kerusakan" name="deskripsi_bukti_kerusakan" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="id_gedung">Gedung</label>
                            <select id="id_gedung" name="id_gedung" required>
                                <option value="">Pilih Gedung</option>
                                <!-- Options akan diisi dari database -->
                                @foreach($gedungs as $gedung)
                                    <option value="{{ $gedung->id }}">{{ $gedung->nama_gedung }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="upload-container">
                            <label class="upload-label">Upload Bukti Foto</label>
                            <div class="upload-box" id="uploadBox">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span class="upload-text">Klik untuk memilih file atau seret file ke sini</span>
                                <span class="upload-hint">Format yang didukung: JPG, PNG, WEBP, AVIF (Maks. 2MB)</span>
                                <input type="file" id="file_bukti_kerusakan" name="file_bukti_kerusakan" class="file-input" accept="image/jpeg,image/png,image/webp,image/avif">
                                <div id="fileError" class="error-message"></div>
                            </div>
                            <div class="upload-preview" id="uploadPreview">
                                <div class="preview-container">
                                    <img id="previewImage" class="preview-image" src="" alt="Preview">
                                    <div id="previewIcon" class="preview-icon">
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

                        <input type="hidden" name="id_inspeksi_gedung" value="{{ $id_inspeksi_gedung ?? '' }}">

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Bukti Kerusakan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadBox = document.getElementById('uploadBox');
        const fileInput = document.getElementById('file_bukti_kerusakan');
        const uploadPreview = document.getElementById('uploadPreview');
        const previewImage = document.getElementById('previewImage');
        const previewIcon = document.getElementById('previewIcon');
        const previewFileName = document.getElementById('previewFileName');
        const previewFileSize = document.getElementById('previewFileSize');
        const removeFileBtn = document.getElementById('removeFileBtn');
        const fileError = document.getElementById('fileError');
        const form = document.getElementById('uploadForm');
        
        // Handle toast notification
        const toast = document.getElementById('toast');
        if (toast) {
            // Show toast with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Close toast when close button is clicked
            const closeBtn = toast.querySelector('.toast-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    toast.classList.remove('show');
                });
            }
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }
        
        // Handle drag and drop events
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
        
        // Handle dropped files
        uploadBox.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                fileInput.files = files;
                handleFiles(files);
            }
        }
        
        // Handle file selection via click
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });
        
        // Handle click on upload box
        uploadBox.addEventListener('click', function() {
            fileInput.click();
        });
        
        // Handle file processing
        function handleFiles(files) {
            const file = files[0];
            
            // Reset error message
            fileError.style.display = 'none';
            fileError.textContent = '';
            
            // Validate file
            if (!file) return;
            
            const validTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
            const maxSize = 2 * 1024 * 1024; // 2MB
            
            if (!validTypes.includes(file.type)) {
                fileError.textContent = 'Format file tidak didukung. Harap unggah file JPG, PNG, WEBP, atau AVIF.';
                fileError.style.display = 'block';
                return;
            }
            
            if (file.size > maxSize) {
                fileError.textContent = 'Ukuran file terlalu besar. Maksimal 2MB.';
                fileError.style.display = 'block';
                return;
            }
            
            // Display file info
            previewFileName.textContent = file.name;
            previewFileSize.textContent = formatFileSize(file.size);
            
            // Display preview if it's an image
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    previewIcon.style.display = 'none';
                }
                
                reader.readAsDataURL(file);
            } else {
                previewImage.style.display = 'none';
                previewIcon.style.display = 'block';
            }
            
            // Show preview container
            uploadPreview.style.display = 'block';
        }
        
        // Remove file handler
        removeFileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            resetFileInput();
        });
        
        function resetFileInput() {
            fileInput.value = '';
            uploadPreview.style.display = 'none';
            previewImage.style.display = 'none';
            previewIcon.style.display = 'block';
            fileError.style.display = 'none';
        }
        
        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Form validation
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Check required fields
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                    
                    // Add error message
                    let errorDiv = field.parentNode.querySelector('.field-error');
                    if (!errorDiv) {
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'field-error';
                        errorDiv.style.color = '#dc3545';
                        errorDiv.style.fontSize = '14px';
                        errorDiv.style.marginTop = '5px';
                        field.parentNode.appendChild(errorDiv);
                    }
                    errorDiv.textContent = 'Field ini wajib diisi';
                } else {
                    field.style.borderColor = '#d1d5db';
                    
                    // Remove error message
                    const errorDiv = field.parentNode.querySelector('.field-error');
                    if (errorDiv) {
                        errorDiv.remove();
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap isi semua field yang wajib diisi.');
            }
        });
    });
    </script>
</body>
</html>