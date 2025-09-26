<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan Inspeksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jadwalkan-inspeksi.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">
</head>

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
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-calendar-check"></i> Jadwalkan Inspeksi</li>
                </ul>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div class="card">
                <div class="container">
                    <h2 class="section-title"><i class="fas fa-building"></i> Assets Inspection Scheduling</h2>

                    <!-- Tombol Tambah Asset dengan Modal -->
                    <button type="button" class="btn-add-asset" onclick="openAddModal()">
                        <i class="fas fa-plus-circle"></i> Tambah Asset Pengecekan
                    </button>

                    <div class="inspection-container">
                        @foreach ($gedungs as $gedung)
                            <div class="inspection-card">
                                <div class="card-header">
                                    <h3><i class="fas fa-university"></i> {{ strtoupper($gedung->nama_gedung) }}</h3>
                                    <div class="action-buttons">
                                        <!-- Tombol Edit dengan Modal -->
                                        <button type="button" class="btn-edit"
                                            onclick="openEditModal({{ $gedung->id }}, '{{ $gedung->nama_gedung }}', '{{ $gedung->foto_gedung }}')">
                                            <i class="fas fa-edit"></i> Ubah
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('asset.delete', $gedung->id) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"
                                                onclick="return confirmDelete(event)">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="building-image"
                                    style="background-image: url('{{ asset('storage/' . $gedung->foto_gedung) }}');">
                                </div>

                                <form action="{{ route('jadwalkan.inspeksi.store') }}" method="POST">
                                    @csrf
                                    <!-- Hidden fields -->
                                    <input type="hidden" name="furniture" value="Belum Diperiksa">
                                    <input type="hidden" name="fire_system" value="Belum Diperiksa">
                                    <input type="hidden" name="bangunan" value="Belum Diperiksa">
                                    <input type="hidden" name="mekanikal_elektrikal" value="Belum Diperiksa">
                                    <input type="hidden" name="it" value="Belum Diperiksa">
                                    <input type="hidden" name="interior" value="Belum Diperiksa">
                                    <input type="hidden" name="eksterior" value="Belum Diperiksa">
                                    <input type="hidden" name="sanitasi" value="Belum Diperiksa">
                                    <input type="hidden" name="id_gedung" value="{{ $gedung->id }}">

                                    @php
                                        $isDisabled = in_array($gedung->id, $gedungDenganInspeksiTerbuka);
                                    @endphp

                                    <button type="submit" class="btn-schedule" {{ $isDisabled ? 'disabled' : '' }}>
                                        <i class="fas fa-calendar-plus"></i> Jadwalkan Inspeksi
                                    </button>

                                    @if ($isDisabled)
                                        <p class="status-message">
                                            Inspeksi sedang berlangsung.
                                        </p>
                                    @endif
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Asset -->
    <div id="addAssetModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-plus-circle"></i> Tambah Asset Baru</h3>
                <span class="close" onclick="closeAddModal()">&times;</span>
            </div>
            <form id="addAssetForm" action="{{ route('asset.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_gedung">Nama Gedung:</label>
                    <input type="text" id="nama_gedung" name="nama_gedung" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="foto_gedung">Foto Gedung:</label>
                    <input type="file" id="foto_gedung" name="foto_gedung" class="form-control" accept="image/*"
                        onchange="previewImage(this, 'addPreview')">
                    <div class="image-preview-container">
                        <img id="addPreview" class="preview-image" alt="Preview Gambar">
                    </div>
                </div>
                <button type="submit" class="btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Modal Edit Asset -->
    <div id="editAssetModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-edit"></i> Edit Asset</h3>
                <span class="close" onclick="closeEditModal()">&times;</span>
            </div>
            <form id="editAssetForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">
                <div class="form-group">
                    <label for="edit_nama_gedung">Nama Gedung:</label>
                    <input type="text" id="edit_nama_gedung" name="nama_gedung" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit_foto_gedung">Foto Gedung:</label>
                    <input type="file" id="edit_foto_gedung" name="foto_gedung" class="form-control"
                        accept="image/*" onchange="previewImage(this, 'editPreview')">
                    <div class="image-preview-container">
                        <img id="editPreview" class="preview-image" alt="Preview Gambar">
                        <div id="currentImageText" style="font-size: 12px; color: #666; margin-top: 5px;"></div>
                    </div>
                </div>
                <button type="submit" class="btn-primary">Update</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/components.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast');
            if (toast) {
                setTimeout(() => toast.classList.add('show'), 100);
                toast.querySelector('.toast-close').addEventListener('click', () => toast.classList.remove('show'));
                setTimeout(() => toast.classList.remove('show'), 3000);
            }
        });

        function confirmDelete(event) {
            if (!confirm('Apakah Anda yakin ingin menghapus asset ini?')) {
                event.preventDefault();
                return false;
            }
            return true;
        }

        // Modal Functions
        function openAddModal() {
            document.getElementById('addAssetModal').style.display = 'block';
            document.getElementById('addAssetForm').reset();
            document.getElementById('addPreview').style.display = 'none';
        }

        function closeAddModal() {
            document.getElementById('addAssetModal').style.display = 'none';
        }

        function openEditModal(id, namaGedung, fotoGedung) {
            document.getElementById('editAssetModal').style.display = 'block';

            // Set form values
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama_gedung').value = namaGedung;

            // Set form action
            document.getElementById('editAssetForm').action = '/asset-update/' + id;

            // Handle image preview
            const preview = document.getElementById('editPreview');
            const currentImageText = document.getElementById('currentImageText');

            if (fotoGedung) {
                preview.src = '{{ asset('storage/') }}/' + fotoGedung;
                preview.style.display = 'block';
                currentImageText.textContent = 'Gambar saat ini: ' + fotoGedung.split('/').pop();
            } else {
                preview.style.display = 'none';
                currentImageText.textContent = 'Tidak ada gambar saat ini';
            }
        }

        function closeEditModal() {
            document.getElementById('editAssetModal').style.display = 'none';
        }

        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const addModal = document.getElementById('addAssetModal');
            const editModal = document.getElementById('editAssetModal');

            if (event.target === addModal) {
                closeAddModal();
            }
            if (event.target === editModal) {
                closeEditModal();
            }
        }

        // Handle form submission with AJAX for better UX
        document.getElementById('addAssetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm(this, 'addAssetModal');
        });

        document.getElementById('editAssetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm(this, 'editAssetModal');
        });

        function submitForm(form, modalId) {
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;

            // Disable button and show loading
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

            fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Close modal and reload page
                        document.getElementById(modalId).style.display = 'none';
                        window.location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data');
                })
                .finally(() => {
                    // Re-enable button
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
        }
    </script>
</body>

</html>
