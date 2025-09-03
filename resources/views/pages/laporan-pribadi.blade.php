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
    <script src="{{ asset('js/components.js') }}"></script>
    <script src="{{ asset('js/laporan-pribadi.js') }}"></script>

</body>
</html>