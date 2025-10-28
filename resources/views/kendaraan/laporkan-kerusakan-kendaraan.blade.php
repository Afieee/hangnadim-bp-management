<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kerusakan Kendaraan</title>
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/laporan-pribadi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-inspeksi-petugas.blade.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
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

        .upload-box:hover,
        .upload-box.dragover {
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

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #fff;
            color: #333;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-family: 'Segoe UI', sans-serif;
            font-size: 14px;
            z-index: 9999;
            opacity: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #4CAF50;
            transition: all 0.3s ease;
            max-width: 350px;
        }

        .toast.error {
            border-left-color: #f44336;
        }

        .toast.show {
            opacity: 1;
        }

        .toast-icon {
            width: 24px;
            height: 24px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .toast.error .toast-icon {
            background-color: #f44336;
        }

        .toast-icon i {
            color: white;
            font-size: 12px;
        }

        .toast-content {
            flex-grow: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 2px;
            color: #222;
        }

        .toast-close {
            background: none;
            border: none;
            color: #999;
            font-size: 16px;
            cursor: pointer;
            padding: 0;
            width: 20px;
            height: 20px;
        }

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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .field-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .has-error {
            border-color: #dc3545 !important;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div style="all: initial">
        <x-navbar />
    </div>

    <div style="all: initial">
        <x-sidebar />
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast" style="display: none;">
        <div class="toast-icon">
            <i class="fas fa-check"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title"></div>
            <div class="toast-message"></div>
        </div>
        <button class="toast-close">&times;</button>
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
                    <li class="active"><i class="fas fa-calendar-check"></i> Laporan Kerusakan Kendaraan</li>
                </ul>
            </div>
        </div>

        <div class="content-area">
            <div class="card">
                <div class="container">
                    <h2 style="margin-bottom: 30px">Laporan Kerusakan Kendaraan</h2>

                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('simpan.laporan.kerusakan.kendaraan') }}" method="POST"
                        enctype="multipart/form-data" id="uploadForm">
                        @csrf

                        <div class="form-group">
                            <label for="id_kendaraan">Kendaraan *</label>
                            <select id="id_kendaraan" name="id_kendaraan" required>
                                <option value="">Pilih Kendaraan</option>
                                @foreach ($listKendaraan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('id_kendaraan') == $item->id ? 'selected' : '' }}>
                                        {{ $item->tipe_kendaraan }} - {{ $item->plat_kendaraan }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="field-error" id="id_kendaraan_error"></div>
                        </div>

                        <div class="form-group">
                            <label for="objek_kerusakan">Objek Kerusakan *</label>
                            <input type="text" id="objek_kerusakan" name="objek_kerusakan"
                                value="{{ old('objek_kerusakan') }}" required>
                            <div class="field-error" id="objek_kerusakan_error"></div>
                        </div>

                        <div class="form-group">
                            <label for="tipe_kerusakan">Tipe Kerusakan *</label>
                            <select id="tipe_kerusakan" name="tipe_kerusakan" required>
                                <option value="">Pilih Tipe Kerusakan</option>
                                <option value="Kerusakan Mesin"
                                    {{ old('tipe_kerusakan') == 'Kerusakan Mesin' ? 'selected' : '' }}>Kerusakan Mesin
                                </option>
                                <option value="Kerusakan sistem penggerak"
                                    {{ old('tipe_kerusakan') == 'Kerusakan sistem penggerak' ? 'selected' : '' }}>
                                    Kerusakan sistem penggerak</option>
                                <option value="Kerusakan sistem suspensi"
                                    {{ old('tipe_kerusakan') == 'Kerusakan sistem suspensi' ? 'selected' : '' }}>
                                    Kerusakan sistem suspensi</option>
                                <option value="Kerusakan sistem pengereman"
                                    {{ old('tipe_kerusakan') == 'Kerusakan sistem pengereman' ? 'selected' : '' }}>
                                    Kerusakan sistem pengereman</option>
                                <option value="Kerusakan pada sistem listrik"
                                    {{ old('tipe_kerusakan') == 'Kerusakan pada sistem listrik' ? 'selected' : '' }}>
                                    Kerusakan pada sistem listrik</option>
                                <option value="Kerusakan pada sistem pendingin"
                                    {{ old('tipe_kerusakan') == 'Kerusakan pada sistem pendingin' ? 'selected' : '' }}>
                                    Kerusakan pada sistem pendingin</option>
                                <option value="Kerusakan pada karoseri dan eksterior"
                                    {{ old('tipe_kerusakan') == 'Kerusakan pada karoseri dan eksterior' ? 'selected' : '' }}>
                                    Kerusakan pada karoseri dan eksterior</option>
                                <option value="Kerusakan pada sistem pemanas dan pengkondisian (AC)"
                                    {{ old('tipe_kerusakan') == 'Kerusakan pada sistem pemanas dan pengkondisian (AC)' ? 'selected' : '' }}>
                                    Kerusakan pada sistem pemanas dan pengkondisian (AC)</option>
                                <option value="Kerusakan pada sistem bahan bakar"
                                    {{ old('tipe_kerusakan') == 'Kerusakan pada sistem bahan bakar' ? 'selected' : '' }}>
                                    Kerusakan pada sistem bahan bakar</option>
                                <option value="Kerusakan pada ban dan roda"
                                    {{ old('tipe_kerusakan') == 'Kerusakan pada ban dan roda' ? 'selected' : '' }}>
                                    Kerusakan pada ban dan roda</option>
                                <option value="Kerusakan akibat kecelakaan"
                                    {{ old('tipe_kerusakan') == 'Kerusakan akibat kecelakaan' ? 'selected' : '' }}>
                                    Kerusakan akibat kecelakaan</option>

                            </select>
                            <div class="field-error" id="tipe_kerusakan_error"></div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_kerusakan">Deskripsi Kerusakan *</label>
                            <textarea id="deskripsi_kerusakan" name="deskripsi_kerusakan" rows="4" required>{{ old('deskripsi_kerusakan') }}</textarea>
                            <div class="field-error" id="deskripsi_kerusakan_error"></div>
                        </div>

                        <div class="upload-container">
                            <label class="upload-label">Upload Bukti Foto *</label>
                            <div class="upload-box" id="uploadBox">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span class="upload-text">Klik untuk memilih file atau seret file ke sini</span>
                                <span class="upload-hint">Format: JPG, PNG, WEBP, AVIF (Maks. 10MB)</span>
                                <input type="file" id="foto_kerusakan" name="foto_kerusakan" class="file-input"
                                    accept="image/jpeg,image/png,image/webp,image/avif">
                                <div id="fileError" class="error-message"></div>
                            </div>
                            <div class="upload-preview" id="uploadPreview">
                                <div class="preview-container">
                                    <img id="previewImage" class="preview-image" src="" alt="Preview">
                                    <div id="previewIcon" class="preview-icon">
                                        <i class="fas fa-file-image"></i>
                                    </div>
                                    <div class="preview-info">
                                        <div class="preview-name" id="previewFileName">Nama file akan muncul di sini
                                        </div>
                                        <div class="preview-size" id="previewFileSize">Ukuran file akan muncul di sini
                                        </div>
                                    </div>
                                    <div class="preview-remove" id="removeFileBtn">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status_kerusakan">Status Kerusakan *</label>
                            <select id="status_kerusakan" name="status_kerusakan" required>
                                <option value="">Pilih Status Kerusakan</option>
                                <option value="Ringan" {{ old('status_kerusakan') == 'Ringan' ? 'selected' : '' }}>
                                    Ringan</option>
                                <option value="Sedang" {{ old('status_kerusakan') == 'Sedang' ? 'selected' : '' }}>
                                    Sedang</option>
                                <option value="Parah" {{ old('status_kerusakan') == 'Parah' ? 'selected' : '' }}>
                                    Parah</option>
                            </select>
                            <div class="field-error" id="status_kerusakan_error"></div>
                        </div>

                        <div class="form-group" style="margin-top: 25px">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save"></i> Simpan Laporan Kerusakan
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()"
                                style="margin-left: 10px;">
                                <i class="fas fa-redo"></i> Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/components.js') }}"></script>
    <script>
        // Toast Notification Functions
        function showToast(title, message, isError = false) {
            const toast = document.getElementById('toast');
            const toastTitle = toast.querySelector('.toast-title');
            const toastMessage = toast.querySelector('.toast-message');
            const toastIcon = toast.querySelector('.toast-icon i');

            toastTitle.textContent = title;
            toastMessage.textContent = message;

            if (isError) {
                toast.classList.add('error');
                toastIcon.className = 'fas fa-exclamation-circle';
            } else {
                toast.classList.remove('error');
                toastIcon.className = 'fas fa-check';
            }

            toast.style.display = 'flex';
            setTimeout(() => toast.classList.add('show'), 10);

            setTimeout(hideToast, 5000);

            toast.querySelector('.toast-close').onclick = hideToast;
        }

        function hideToast() {
            const toast = document.getElementById('toast');
            toast.classList.remove('show');
            setTimeout(() => toast.style.display = 'none', 300);
        }

        // Loading Functions
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('submitBtn').disabled = true;
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
            document.getElementById('submitBtn').disabled = false;
        }

        // File Utility Functions
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function validateFile(file) {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
            const maxSize = 10 * 1024 * 1024;

            if (!allowedTypes.includes(file.type)) {
                return 'Format file tidak didukung. Harap unggah file gambar (JPG, PNG, WEBP, AVIF).';
            }

            if (file.size > maxSize) {
                return 'Ukuran file terlalu besar. Maksimal 10MB.';
            }

            return null;
        }

        function showFilePreview(file) {
            const preview = document.getElementById('uploadPreview');
            const previewImage = document.getElementById('previewImage');
            const previewIcon = document.getElementById('previewIcon');
            const previewFileName = document.getElementById('previewFileName');
            const previewFileSize = document.getElementById('previewFileSize');

            previewFileName.textContent = file.name;
            previewFileSize.textContent = formatFileSize(file.size);

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    previewIcon.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.style.display = 'none';
                previewIcon.style.display = 'block';
            }

            preview.style.display = 'block';
        }

        function removeSelectedFile() {
            const fileInput = document.getElementById('foto_kerusakan');
            const preview = document.getElementById('uploadPreview');
            const fileError = document.getElementById('fileError');

            fileInput.value = '';
            preview.style.display = 'none';
            fileError.style.display = 'none';
        }

        // Form Validation
        function validateForm() {
            let isValid = true;

            document.querySelectorAll('.field-error').forEach(el => {
                el.style.display = 'none';
            });
            document.querySelectorAll('.has-error').forEach(el => {
                el.classList.remove('has-error');
            });

            const fields = [{
                    id: 'id_kendaraan',
                    name: 'Kendaraan'
                },
                {
                    id: 'objek_kerusakan',
                    name: 'Objek Kerusakan'
                },
                {
                    id: 'tipe_kerusakan',
                    name: 'Tipe Kerusakan'
                },
                {
                    id: 'deskripsi_kerusakan',
                    name: 'Deskripsi Kerusakan'
                },
                {
                    id: 'status_kerusakan',
                    name: 'Status Kerusakan'
                }
            ];

            fields.forEach(field => {
                const element = document.getElementById(field.id);
                if (!element.value.trim()) {
                    document.getElementById(field.id + '_error').textContent = field.name + ' harus diisi';
                    document.getElementById(field.id + '_error').style.display = 'block';
                    element.classList.add('has-error');
                    isValid = false;
                }
            });

            const fileInput = document.getElementById('foto_kerusakan');
            if (!fileInput.files.length) {
                document.getElementById('fileError').textContent = 'File bukti foto harus diunggah';
                document.getElementById('fileError').style.display = 'block';
                isValid = false;
            }

            return isValid;
        }

        function resetForm() {
            document.getElementById('uploadForm').reset();
            removeSelectedFile();
            document.querySelectorAll('.field-error').forEach(el => {
                el.style.display = 'none';
            });
            document.querySelectorAll('.has-error').forEach(el => {
                el.classList.remove('has-error');
            });
            showToast('Info', 'Form telah direset');
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            const uploadBox = document.getElementById('uploadBox');
            const fileInput = document.getElementById('foto_kerusakan');
            const fileError = document.getElementById('fileError');
            const removeFileBtn = document.getElementById('removeFileBtn');
            const form = document.getElementById('uploadForm');

            uploadBox.addEventListener('click', () => fileInput.click());

            uploadBox.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadBox.classList.add('dragover');
            });

            uploadBox.addEventListener('dragleave', () => {
                uploadBox.classList.remove('dragover');
            });

            uploadBox.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadBox.classList.remove('dragover');
                if (e.dataTransfer.files.length) {
                    handleFileSelection(e.dataTransfer.files[0]);
                }
            });

            fileInput.addEventListener('change', function() {
                if (this.files.length) {
                    handleFileSelection(this.files[0]);
                }
            });

            removeFileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                removeSelectedFile();
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (validateForm()) {
                    showLoading();

                    const formData = new FormData(form);

                    fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            hideLoading();

                            if (data.success) {
                                showToast('Berhasil', data.message);
                                form.reset();
                                removeSelectedFile();
                            } else {
                                showToast('Error', data.message, true);
                                if (data.errors) {
                                    displayValidationErrors(data.errors);
                                }
                            }
                        })
                        .catch(error => {
                            hideLoading();
                            console.error('Error:', error);
                            showToast('Error', 'Terjadi kesalahan jaringan', true);
                        });
                } else {
                    showToast('Error', 'Harap periksa kembali form yang diisi', true);
                }
            });

            function handleFileSelection(file) {
                const error = validateFile(file);

                if (error) {
                    fileError.textContent = error;
                    fileError.style.display = 'block';
                    removeSelectedFile();
                } else {
                    fileError.style.display = 'none';
                    showFilePreview(file);
                }
            }

            function displayValidationErrors(errors) {
                document.querySelectorAll('.field-error').forEach(el => {
                    el.style.display = 'none';
                });

                document.querySelectorAll('.has-error').forEach(el => {
                    el.classList.remove('has-error');
                });

                for (const field in errors) {
                    const errorElement = document.getElementById(field + '_error');
                    const inputElement = document.getElementById(field);

                    if (errorElement && inputElement) {
                        errorElement.textContent = errors[field][0];
                        errorElement.style.display = 'block';
                        inputElement.classList.add('has-error');
                    }
                }
            }
        });
    </script>
</body>

</html>
