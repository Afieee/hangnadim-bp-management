<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Crash Condition</title>
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('css/components.css') }}">    
    <link rel="stylesheet" href="{{ asset('css/laporan-pribadi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-inspeksi-petugas.blade.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Styling untuk preview upload */
        .upload-preview {
            display: none;
            margin-top: 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 12px;
            background-color: #f9fafb;
        }
        
        .preview-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .preview-image {
            max-width: 80px;
            max-height: 80px;
            border-radius: 4px;
            display: none;
        }
        
        .preview-icon {
            font-size: 32px;
            color: #6b7280;
        }
        
        .preview-info {
            flex: 1;
        }
        
        .preview-name {
            font-weight: 500;
            color: #374151;
            margin-bottom: 4px;
            word-break: break-all;
        }
        
        .preview-size {
            font-size: 12px;
            color: #6b7280;
        }
        
        .preview-remove {
            color: #ef4444;
            cursor: pointer;
            font-size: 20px;
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
        
        .upload-box:hover, .upload-box.dragover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }
        
        .upload-box i {
            font-size: 48px;
            color: #9ca3af;
            margin-bottom: 12px;
        }
        
        .upload-text {
            display: block;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .upload-hint {
            display: block;
            font-size: 14px;
            color: #6b7280;
        }
        
        .file-input {
            display: none;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 8px;
            display: none;
        }
        
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

        /* Error toast style */
        .toast.error {
            border-left-color: #f44336;
        }

        .toast.error .toast-icon {
            background-color: #f44336;
        }

        .toast.error .toast-progress::before {
            background-color: #f44336;
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
            0% {
                width: 100%;
            }
            100% {
                width: 0%;
            }
        }

        /* Loading overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9998;
            display: none;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .field-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        
        /* Validation error styling */
        .has-error {
            border-color: #dc3545 !important;
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
    
    <!-- Toast Notification Container -->
    <div id="toast" class="toast" style="display: none;">
        <div class="toast-icon"></div>
        <div class="toast-content">
            <div class="toast-title"></div>
            <div class="toast-message"></div>
        </div>
        <button class="toast-close">&times;</button>
        <div class="toast-progress"></div>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

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
                    <h2 style="margin-bottom: 50px">Laporan Kerusakan Crash Condition</h2>
                    <form action="{{ route('bukti-kerusakan-pribadi.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf

                        <div class="form-group">
                            <label for="tipe_kerusakan">Tipe Kerusakan</label>
                            <select id="tipe_kerusakan" name="tipe_kerusakan" required>
                                <option value="">Pilih Tipe Kerusakan</option>
                                <option value="Furniture">Furniture</option>
                                <option value="Fire System">Fire System</option>
                                <option value="Gedung & Bangunan">Gedung & Bangunan</option>
                                <option value="Mekanikal Elektrikal">Mekanikal Elektrikal</option>
                                <option value="IT">IT</option>
                                <option value="Jalanan & Jembatan">Jalanan & Jembatan</option>
                                <option value="Jaringan Air">Jaringan Air</option>
                                <option value="Drainase">Drainase</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="judul_bukti_kerusakan">Objek Kerusakan</label>
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
                                <!-- Diubah dari 2MB menjadi 10MB -->
                                <span class="upload-hint">Format yang didukung: JPG, PNG, WEBP, AVIF (Maks. 10MB)</span>
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
    <script src="{{ asset('js/components.js') }}"></script>
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
            const loadingOverlay = document.getElementById('loadingOverlay');
            const toast = document.getElementById('toast');
            const toastTitle = toast.querySelector('.toast-title');
            const toastMessage = toast.querySelector('.toast-message');
            const toastClose = toast.querySelector('.toast-close');
            
            // Inisialisasi preview icon
            previewIcon.style.display = 'block';
            previewImage.style.display = 'none';
            
            // Fungsi untuk menampilkan toast
            function showToast(title, message, isError = false) {
                // Set toast content
                toastTitle.textContent = title;
                toastMessage.textContent = message;
                
                // Set toast style based on type
                if (isError) {
                    toast.classList.add('error');
                } else {
                    toast.classList.remove('error');
                }
                
                // Show toast
                toast.style.display = 'flex';
                setTimeout(() => {
                    toast.classList.add('show');
                }, 100);
                
                // Auto-hide after 5 seconds
                setTimeout(() => {
                    hideToast();
                }, 5000);
            }
            
            // Fungsi untuk menyembunyikan toast
            function hideToast() {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 400);
            }
            
            // Close toast when close button is clicked
            toastClose.addEventListener('click', hideToast);
            
            // Tampilkan toast jika ada session message dari server
            @if(session('success'))
                showToast('Success!', '{{ session('success') }}');
            @endif
            
            @if(session('error'))
                showToast('Error!', '{{ session('error') }}', true);
            @endif
            
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
            uploadBox.addEventListener('click', function(e) {
                // Pastikan kita tidak mengklik child element yang memicu event
                if (e.target === uploadBox || e.target.classList.contains('fa-cloud-upload-alt') || 
                    e.target.classList.contains('upload-text') || e.target.classList.contains('upload-hint')) {
                    fileInput.click();
                }
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
                // Diubah dari 2MB menjadi 10MB
                const maxSize = 10 * 1024 * 1024; // 10MB
                
                if (!validTypes.includes(file.type)) {
                    fileError.textContent = 'Format file tidak didukung. Harap unggah file JPG, PNG, WEBP, atau AVIF.';
                    fileError.style.display = 'block';
                    return;
                }
                
                if (file.size > maxSize) {
                    // Diubah pesan error untuk menunjukkan batas 10MB
                    fileError.textContent = 'Ukuran file terlalu besar. Maksimal 10MB.';
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
            
            // Clear validation errors when user starts typing
            const formInputs = form.querySelectorAll('input, textarea, select');
            formInputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.classList.remove('has-error');
                    const errorDiv = this.parentNode.querySelector('.field-error');
                    if (errorDiv) {
                        errorDiv.remove();
                    }
                });
            });
            
            // Form submission dengan AJAX
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                let isValid = true;
                
                // Clear previous errors
                document.querySelectorAll('.field-error').forEach(el => el.remove());
                formInputs.forEach(input => input.classList.remove('has-error'));
                
                // Check required fields
                const requiredFields = form.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('has-error');
                        
                        // Add error message
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'field-error';
                        errorDiv.textContent = 'Field ini wajib diisi';
                        field.parentNode.appendChild(errorDiv);
                    }
                });
                
                // Check if file is selected
                if (!fileInput.files || !fileInput.files[0]) {
                    fileError.textContent = 'Harap pilih file untuk diunggah.';
                    fileError.style.display = 'block';
                    isValid = false;
                }
                
                if (!isValid) {
                    // Scroll to the first error
                    const firstError = form.querySelector('.has-error');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return;
                }
                
                // Kirim form dengan AJAX
                const formData = new FormData(form);
                
                // Tampilkan loading overlay
                loadingOverlay.style.display = 'flex';
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    // Check if response is OK (status 200-299)
                    if (!response.ok) {
                        // Jika response tidak OK, coba parsing sebagai JSON untuk mendapatkan pesan error
                        return response.text().then(text => {
                            try {
                                const data = JSON.parse(text);
                                return Promise.reject({ 
                                    message: data.message || `HTTP error! status: ${response.status}`,
                                    errors: data.errors || null
                                });
                            } catch (e) {
                                // Jika bukan JSON, gunakan teks langsung
                                return Promise.reject({ 
                                    message: text || `HTTP error! status: ${response.status}`,
                                    errors: null
                                });
                            }
                        });
                    }
                    
                    // Check content type to determine if it's JSON
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        // Jika bukan JSON, mungkin server mengembalikan redirect atau HTML
                        // Dalam kasus ini, kita anggap request berhasil
                        return { 
                            success: true, 
                            message: 'Data berhasil disimpan' 
                        };
                    }
                })
                .then(data => {
                    // Sembunyikan loading overlay
                    loadingOverlay.style.display = 'none';
                    
                    if (data.success) {
                        // Tampilkan toast sukses
                        showToast('Success!', data.message || 'Data berhasil disimpan dan email terkirim.');
                        
                        // Reset form
                        form.reset();
                        resetFileInput();
                        
                        // Clear any field errors
                        document.querySelectorAll('.field-error').forEach(el => el.remove());
                        formInputs.forEach(input => input.classList.remove('has-error'));
                        
                        // Redirect after success if needed
                        setTimeout(() => {
                            // Jika server mengembalikan redirect URL, gunakan itu
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                            // Jika tidak, mungkin redirect ke halaman sebelumnya atau dashboard
                            else {
                                window.location.href = '/halaman-laporan-pribadi'; // Ganti dengan URL yang sesuai
                            }
                        }, 2000);
                    } else {
                        // Tampilkan toast error
                        showToast('Error!', data.message || 'Terjadi kesalahan saat menyimpan data.', true);
                        
                        // Display validation errors if they exist
                        if (data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                const input = form.querySelector(`[name="${field}"]`);
                                if (input) {
                                    input.classList.add('has-error');
                                    
                                    const errorDiv = document.createElement('div');
                                    errorDiv.className = 'field-error';
                                    errorDiv.textContent = data.errors[field][0];
                                    input.parentNode.appendChild(errorDiv);
                                }
                            });
                        }
                    }
                })
                .catch(error => {
                    // Sembunyikan loading overlay
                    loadingOverlay.style.display = 'none';
                    
                    // Tampilkan toast error
                    showToast('Error!', error.message || 'Terjadi kesalahan jaringan atau server. Silakan coba lagi.', true);
                    
                    // Display validation errors if they exist
                    if (error.errors) {
                        Object.keys(error.errors).forEach(field => {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('has-error');
                                
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'field-error';
                                errorDiv.textContent = error.errors[field][0];
                                input.parentNode.appendChild(errorDiv);
                            }
                        });
                    }
                    
                    console.error('Error:', error);
                });
            });
        });
    </script>
</body>
</html>