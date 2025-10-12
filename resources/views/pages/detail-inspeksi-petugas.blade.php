{{-- Staff Pelaksana --}}
@if (Auth::user()->role == "Staff Pelaksana")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Inspeksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-inspeksi-petugas.blade.css') }}">

</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                    <hr>
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

                    <!-- INFO GRID YANG DIPERBAIKI -->
                    <div class="info-grid">
                        <!-- Informasi Gedung -->
                        <div class="info-card">
                            <div class="info-card-header">
                                <h2><i class="fas fa-building"></i> Informasi Gedung</h2>
                            </div>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-landmark"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Nama Gedung</div>
                                        <div class="info-value">{{ $inspeksi->gedung->nama_gedung ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Tanggal Inspeksi Dijadwalkan</div>
                                        <div class="info-value">{{ \Carbon\Carbon::parse($inspeksi->created_at)->format('d F Y, H:i') ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Kepala Seksi -->
                        <div class="info-card">
                            <div class="info-card-header">
                                <h2><i class="fas fa-user-tie"></i> Kepala Seksi</h2>
                            </div>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Nama Penjadwal</div>
                                        <div class="info-value">{{ $inspeksi->user->name ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Email Penjadwal</div>
                                        <div class="info-value">{{ $inspeksi->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="info-item">

                                </div>
                            </div>
                        </div>

                        <!-- Detail Inspeksi -->
                        <div class="info-card">
                            <div class="info-card-header">
                                <h2><i class="fas fa-clipboard-check"></i> Detail Inspeksi</h2>
                            </div>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-fingerprint"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">ID Inspeksi</div>
                                        <div class="info-value">INS-{{ $inspeksi->id }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Status</div>
                                        <div class="status-badge diperbaiki">
                                            {{ $inspeksi->status_keseluruhan_inspeksi ?? 'Dalam Proses' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-list-ol"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Jumlah Temuan</div>
                                        <div class="info-value">{{ $buktiKerusakans->count() }} Temuan</div>
                                    </div>
                                </div>
                            </div>
                            <div class="info-card-footer">
                                <div class="info-date">
                                </div>
                            </div>
                        </div>
                    </div>

                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <h2>Status Komponen</h2>
                    <div id="update-message" style="margin-top:10px; color:green; font-weight:bold; display:none;">
                        ✅ Data berhasil diperbarui
                    </div>
                    <div class="status-select">
                        <p><strong>Furniture:</strong></p>
                        <select name="furniture" class="status-dropdown border rounded px-2 py-1" data-field="furniture" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->furniture }}">{{ $inspeksi->furniture }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Fire System:</strong></p>
                        <select name="fire_system" class="status-dropdown border rounded px-2 py-1" data-field="fire_system" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->fire_system }}">{{ $inspeksi->fire_system }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Gedung & Bangunan:</strong></p>
                        <select name="gedung_dan_bangunan" class="status-dropdown border rounded px-2 py-1" data-field="gedung_dan_bangunan" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->gedung_dan_bangunan }}">{{ $inspeksi->gedung_dan_bangunan }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Mekanikal Elektrikal:</strong></p>
                        <select name="mekanikal_elektrikal" class="status-dropdown border rounded px-2 py-1" data-field="mekanikal_elektrikal" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->mekanikal_elektrikal }}">{{ $inspeksi->mekanikal_elektrikal }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>IT:</strong></p>
                        <select name="it" class="status-dropdown border rounded px-2 py-1" data-field="it" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->it }}">{{ $inspeksi->it }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Jalan & Jembatan:</strong></p>
                        <select name="jalan_dan_jembatan" class="status-dropdown border rounded px-2 py-1" data-field="jalan_dan_jembatan" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->jalan_dan_jembatan }}">{{ $inspeksi->jalan_dan_jembatan }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Jaringan Air:</strong></p>
                        <select name="jaringan_air" class="status-dropdown border rounded px-2 py-1" data-field="jaringan_air" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->jaringan_air }}">{{ $inspeksi->jaringan_air }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Drainase:</strong></p>
                        <select name="drainase" class="status-dropdown border rounded px-2 py-1" data-field="drainase" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->drainase }}">{{ $inspeksi->drainase }}</option>
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



                        <div class="upload-container">
                            <label class="upload-label">Upload Bukti Foto</label>
                            <div class="upload-box" id="uploadBox">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span class="upload-text">Klik untuk memilih file atau seret file ke sini</span>
                                <span class="upload-hint">Format yang didukung: JPG, PNG, WEBP (Maks. 5MB)</span>
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
                                @foreach ($buktiKerusakans as $index => $buktiKerusakan)
                                    <div class="gallery-item">
                                        <div class="gallery-image" onclick="openModal({{ $index }})">
                                            @if ($buktiKerusakan->file_bukti_kerusakan)
                                                <img src="{{ asset('storage/' . $buktiKerusakan->file_bukti_kerusakan) }}"
                                                    alt="Bukti Kerusakan">
                                            @else
                                                <img src="https://via.placeholder.com/300x200?text=No+Image"
                                                    alt="Tidak ada gambar">
                                            @endif
                                        </div>
                                        <div class="gallery-content">
                                            <h3 style="color: red">{{ $buktiKerusakan->judul_bukti_kerusakan }}</h3>
                                            <p> <strong> Petugas: </strong>{{ $buktiKerusakan->userInspektor->name }}</p>

                                            <p> <strong>Catatan Petugas: </strong>{{ $buktiKerusakan->deskripsi_bukti_kerusakan }}</p>
                                            <hr>
                                            <p><strong>Lokasi:</strong> {{ $buktiKerusakan->lokasi_bukti_kerusakan }}</p>
                                            <div class="gallery-meta">
                                                <span class="damage-type" > <strong>{{ $buktiKerusakan->tipe_kerusakan }}</strong></span>
                                                    <a href="{{ route('bukti-perbaikan.create', \Illuminate\Support\Facades\Crypt::encryptString($buktiKerusakan->id)) }}"
                                                    class="btn btn-success">
                                                        <i class="fas fa-upload"></i> Upload Penanganan
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

        <!-- Modal untuk menampilkan gambar - DIPERBAIKI -->
        <div id="imageModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-counter" id="modalCounter">1/{{ $buktiKerusakans->count() }}</div>
            <div class="modal-nav">
                <div class="nav-btn" onclick="changeImage(-1)">&#10094;</div>
                <div class="nav-btn" onclick="changeImage(1)">&#10095;</div>
            </div>
            <div class="modal-content">
                <div class="modal-image-container">
                    <img class="modal-image" id="modalImage" src="">
                </div>
                <div class="modal-description">
                    <h3 class="modal-title" id="modalTitle"></h3>
                    <p class="modal-desc-text" id="modalDescription"></p>
                    <span class="modal-type" id="modalType"></span>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('js/components.js') }}"></script>
        <script>
            // Script untuk modal gambar - DIPERBAIKI
            let currentImageIndex = 0;
            const buktiKerusakans = @json($buktiKerusakans);

            document.addEventListener('DOMContentLoaded', function() {
                // Script upload yang sudah ada
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
                        const validTypes = [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                            'image/webp',
                            'image/avif'
                        ];

                        if (!validTypes.includes(file.type)) {
                            alert('Format file tidak didukung. Harap gunakan JPG, JPEG, PNG, WEBP, atau AVIF.');
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

            function openModal(index) {
                currentImageIndex = index;
                updateModalContent();
                document.getElementById('imageModal').style.display = 'flex';
                document.body.classList.add('modal-open');
            }

            function closeModal() {
                document.getElementById('imageModal').style.display = 'none';
                document.body.classList.remove('modal-open');
            }

            function changeImage(direction) {
                currentImageIndex += direction;

                // Handle pembunginan indeks (loop)
                if (currentImageIndex < 0) {
                    currentImageIndex = buktiKerusakans.length - 1;
                } else if (currentImageIndex >= buktiKerusakans.length) {
                    currentImageIndex = 0;
                }

                updateModalContent();
            }

            function updateModalContent() {
                const item = buktiKerusakans[currentImageIndex];
                const modalImage = document.getElementById('modalImage');
                const modalTitle = document.getElementById('modalTitle');
                const modalDescription = document.getElementById('modalDescription');
                const modalType = document.getElementById('modalType');
                const modalCounter = document.getElementById('modalCounter');

                // Set konten modal
                if (item.file_bukti_kerusakan) {
                    modalImage.src = "{{ asset('storage/') }}/" + item.file_bukti_kerusakan;
                } else {
                    modalImage.src = "https://via.placeholder.com/800x600?text=No+Image";
                }

                modalTitle.textContent = item.judul_bukti_kerusakan;
                modalDescription.textContent = item.deskripsi_bukti_kerusakan;
                modalType.textContent = item.tipe_kerusakan;
                modalCounter.textContent = (currentImageIndex + 1) + "/" + buktiKerusakans.length;
            }

            // Tutup modal jika diklik di luar konten
            document.getElementById('imageModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeModal();
                }
            });

            // Navigasi dengan keyboard
            document.addEventListener('keydown', function(event) {
                const modal = document.getElementById('imageModal');
                if (modal.style.display === 'flex') {
                    if (event.key === 'Escape') {
                        closeModal();
                    } else if (event.key === 'ArrowLeft') {
                        changeImage(-1);
                    } else if (event.key === 'ArrowRight') {
                        changeImage(1);
                    }
                }
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).on('change', '.status-dropdown', function () {
            let field = $(this).data('field');
            let value = $(this).val();
            let id = $(this).data('id');
            $.ajax({
                url: `/inspeksi/${id}/update-field`,
                type: 'PUT',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    field: field,
                    value: value
                },
                success: function (response) {
                    $('#update-message').stop(true, true).fadeIn().delay(5500).fadeOut();
                },
                error: function () {
                    alert('❌ Gagal memperbarui data.');
                }
            });
        });
        </script>
    </div>
</body>
</html>






















{{-- Kepala Seksi --}}

@elseif (in_array(Auth::user()->role, ['Admin','Direktur','Kepala Seksi']))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Inspeksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-inspeksi-petugas.blade.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

</head>

<style>
    /* Styling kecil & elegan untuk status keseluruhan */


</style>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                    <hr>
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

                    <!-- INFO GRID YANG DIPERBAIKI -->
                    <div class="info-grid">
                        <!-- Informasi Gedung -->
                        <div class="info-card">
                            <div class="info-card-header">
                                <h2><i class="fas fa-building"></i> Informasi Gedung</h2>
                            </div>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-landmark"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Nama Gedung</div>
                                        <div class="info-value">{{ $inspeksi->gedung->nama_gedung ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Tanggal Inspeksi Dijadwalkan</div>
                                        <div class="info-value">{{ \Carbon\Carbon::parse($inspeksi->created_at)->format('d F Y, H:i') ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Kepala Seksi -->
                        <div class="info-card">
                            <div class="info-card-header">
                                <h2><i class="fas fa-user-tie"></i> Kepala Seksi</h2>
                            </div>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Nama Penjadwal</div>
                                        <div class="info-value">{{ $inspeksi->user->name ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Email Penjadwal</div>
                                        <div class="info-value">{{ $inspeksi->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Jabatan</div>
                                        <div class="info-value">Kepala Seksi</div>
                                        <span class="status-badge baik">Aktif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="info-card-footer">

                            </div>
                        </div>

                        <!-- Detail Inspeksi -->
                        <div class="info-card">
                            <div class="info-card-header">
                                <h2><i class="fas fa-clipboard-check"></i> Detail Inspeksi</h2>
                            </div>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-fingerprint"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">ID Inspeksi</div>
                                        <div class="info-value">INS-{{ $inspeksi->id }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Status</div>
                                        <div class="">
                                            <select name="status_keseluruhan_inspeksi"
                                                    class="status-keseluruhan-dropdown"
                                                    data-id="{{ $inspeksi->id }}">
                                                <option {{ $inspeksi->status_keseluruhan_inspeksi == 'Dalam Proses' ? 'selected' : '' }}>
                                                    {{ $inspeksi->status_keseluruhan_inspeksi ?? 'Dalam Proses' }}
                                                </option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-list-ol"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Jumlah Temuan</div>
                                        <div class="info-value">{{ $buktiKerusakans->count() }} Temuan</div>
                                    </div>
                                </div>
                            </div>
                            <div class="info-card-footer">
                                <div class="info-date">
                                </div>
                            </div>
                        </div>
                    </div>

                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <h2>Status Komponen</h2>
                    <div id="update-message" style="margin-top:10px; color:green; font-weight:bold; display:none;">
                        ✅ Data berhasil diperbarui
                    </div>
                    <div class="status-select">
                        <p><strong>Furniture:</strong></p>
                        <select name="furniture" class="status-dropdown border rounded px-2 py-1" data-field="furniture" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->furniture }}">{{ $inspeksi->furniture }}</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Fire System:</strong></p>
                        <select name="fire_system" class="status-dropdown border rounded px-2 py-1" data-field="fire_system" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->fire_system }}">{{ $inspeksi->fire_system }}</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Gedung & Bangunan:</strong></p>
                        <select name="gedung_dan_bangunan" class="status-dropdown border rounded px-2 py-1" data-field="gedung_dan_bangunan" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->gedung_dan_bangunan }}">{{ $inspeksi->gedung_dan_bangunan }}</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Mekanikal Elektrikal:</strong></p>
                        <select name="mekanikal_elektrikal" class="status-dropdown border rounded px-2 py-1" data-field="mekanikal_elektrikal" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->mekanikal_elektrikal }}">{{ $inspeksi->mekanikal_elektrikal }}</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>IT:</strong></p>
                        <select name="it" class="status-dropdown border rounded px-2 py-1" data-field="it" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->it }}">{{ $inspeksi->it }}</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Jalan & Jembatan:</strong></p>
                        <select name="jalan_dan_jembatan" class="status-dropdown border rounded px-2 py-1" data-field="jalan_dan_jembatan" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->jalan_dan_jembatan }}">{{ $inspeksi->jalan_dan_jembatan }}</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Jaringan Air:</strong></p>
                        <select name="jaringan_air" class="status-dropdown border rounded px-2 py-1" data-field="jaringan_air" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->jaringan_air }}">{{ $inspeksi->jaringan_air }}</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Drainase:</strong></p>
                        <select name="drainase" class="status-dropdown border rounded px-2 py-1" data-field="drainase" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->drainase }}">{{ $inspeksi->drainase }}</option>
                        </select>
                    </div>

                    <hr>

                    <!-- Galeri Bukti Kerusakan -->
                    <div class="gallery">
                        <h2 class="gallery-title">
                            <i class="fas fa-images"></i> Lampiran Bukti Kerusakan
                        </h2>

                        @if($buktiKerusakans->count() > 0)
                            <div class="gallery-grid">
                                @foreach ($buktiKerusakans as $index => $buktiKerusakan)
                                    <div class="gallery-item">
                                        <div class="gallery-image" onclick="openModal({{ $index }})">
                                            @if ($buktiKerusakan->file_bukti_kerusakan)
                                                <img src="{{ asset('storage/' . $buktiKerusakan->file_bukti_kerusakan) }}"
                                                    alt="Bukti Kerusakan">
                                            @else
                                                <img src="https://via.placeholder.com/300x200?text=No+Image"
                                                    alt="Tidak ada gambar">
                                            @endif
                                        </div>
                                        <div class="gallery-content">
                                            <h3 style="color: red">{{ $buktiKerusakan->judul_bukti_kerusakan }}</h3>
                                            <p> <strong> Petugas: </strong>{{ $buktiKerusakan->userInspektor->name }}</p>

                                            <p> <strong>Catatan Petugas: </strong>{{ $buktiKerusakan->deskripsi_bukti_kerusakan }}</p>
                                            <hr>
                                            <p><strong>Lokasi:</strong> {{ $buktiKerusakan->lokasi_bukti_kerusakan }}</p>
                                            <div class="gallery-meta">
                                                <span class="damage-type">{{ $buktiKerusakan->tipe_kerusakan }}</span>
                                                    <a href="{{ route('bukti-perbaikan.create', \Illuminate\Support\Facades\Crypt::encryptString($buktiKerusakan->id)) }}"
                                                    class="btn btn-success">
                                                        <i class="fas fa-upload"></i> Lihat Penanganan
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

        <!-- Modal untuk menampilkan gambar - DIPERBAIKI -->
        <div id="imageModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-counter" id="modalCounter">1/{{ $buktiKerusakans->count() }}</div>
            <div class="modal-nav">
                <div class="nav-btn" onclick="changeImage(-1)">&#10094;</div>
                <div class="nav-btn" onclick="changeImage(1)">&#10095;</div>
            </div>
            <div class="modal-content">
                <div class="modal-image-container">
                    <img class="modal-image" id="modalImage" src="">
                </div>
                <div class="modal-description">
                    <h3 class="modal-title" id="modalTitle"></h3>
                    <p class="modal-desc-text" id="modalDescription"></p>
                    <span class="modal-type" id="modalType"></span>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('js/components.js') }}"></script>
        <script>
            // Script untuk modal gambar - DIPERBAIKI
            let currentImageIndex = 0;
            const buktiKerusakans = @json($buktiKerusakans);

            document.addEventListener('DOMContentLoaded', function() {
                // Script upload yang sudah ada
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
                        const validTypes = [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                            'image/webp',
                            'image/avif'
                        ];

                        if (!validTypes.includes(file.type)) {
                            alert('Format file tidak didukung. Harap gunakan JPG, JPEG, PNG, WEBP, atau AVIF.');
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

            function openModal(index) {
                currentImageIndex = index;
                updateModalContent();
                document.getElementById('imageModal').style.display = 'flex';
                document.body.classList.add('modal-open');
            }

            function closeModal() {
                document.getElementById('imageModal').style.display = 'none';
                document.body.classList.remove('modal-open');
            }

            function changeImage(direction) {
                currentImageIndex += direction;

                // Handle pembunginan indeks (loop)
                if (currentImageIndex < 0) {
                    currentImageIndex = buktiKerusakans.length - 1;
                } else if (currentImageIndex >= buktiKerusakans.length) {
                    currentImageIndex = 0;
                }

                updateModalContent();
            }

            function updateModalContent() {
                const item = buktiKerusakans[currentImageIndex];
                const modalImage = document.getElementById('modalImage');
                const modalTitle = document.getElementById('modalTitle');
                const modalDescription = document.getElementById('modalDescription');
                const modalType = document.getElementById('modalType');
                const modalCounter = document.getElementById('modalCounter');

                // Set konten modal
                if (item.file_bukti_kerusakan) {
                    modalImage.src = "{{ asset('storage/') }}/" + item.file_bukti_kerusakan;
                } else {
                    modalImage.src = "https://via.placeholder.com/800x600?text=No+Image";
                }

                modalTitle.textContent = item.judul_bukti_kerusakan;
                modalDescription.textContent = item.deskripsi_bukti_kerusakan;
                modalType.textContent = item.tipe_kerusakan;
                modalCounter.textContent = (currentImageIndex + 1) + "/" + buktiKerusakans.length;
            }

            // Tutup modal jika diklik di luar konten
            document.getElementById('imageModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeModal();
                }
            });

            // Navigasi dengan keyboard
            document.addEventListener('keydown', function(event) {
                const modal = document.getElementById('imageModal');
                if (modal.style.display === 'flex') {
                    if (event.key === 'Escape') {
                        closeModal();
                    } else if (event.key === 'ArrowLeft') {
                        changeImage(-1);
                    } else if (event.key === 'ArrowRight') {
                        changeImage(1);
                    }
                }
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).on('change', '.status-dropdown', function () {
            let field = $(this).data('field');
            let value = $(this).val();
            let id = $(this).data('id');
            $.ajax({
                url: `/inspeksi/${id}/update-field`,
                type: 'PUT',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    field: field,
                    value: value
                },
                success: function (response) {
                    $('#update-message').stop(true, true).fadeIn().delay(5500).fadeOut();
                },
                error: function () {
                    alert('❌ Gagal memperbarui data.');
                }
            });
        });
        </script>






        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).on('change', '.status-keseluruhan-dropdown', function () {
            let status = $(this).val();
            let id = $(this).data('id');

            if (status === "Selesai") {
                if (!confirm("Apakah Anda yakin ingin mengubah status menjadi Selesai?")) {
                    $(this).val("Dalam Proses"); // Balik lagi kalau batal
                    return;
                }
            }

            $.ajax({
                url: `/inspeksi-gedung/${id}/update-status`,
                type: 'PUT',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    status_keseluruhan_inspeksi: status
                },
                success: function (response) {
                    alert(response.message);
                },
                error: function () {
                    alert('❌ Gagal memperbarui status.');
                }
            });
        });
        </script>

    </div>
</body>
</html>
@endif
