<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerocity Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/list-kendaraan.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

</head>

<body class="bg-light">
    {{-- Components --}}
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

    <!-- Content Wrapper -->
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="/manage-user"><i class="fas fa-user"></i> Manage User</a></li>
                    <li class="active"><i class="fas fa-car"></i> Data Kendaraan</li>
                </ul>
            </div>
        </div>

        <div class="content-area">
            <div class="card">
                <div class="card-custom p-4">
                    <!-- Header dengan judul, pencarian, dan tombol -->
                    <div class="header-container" style="padding: 25px;">
                        <div class="table-header">
                            <h2 class="page-title">Asset Kendaraan PKB</h2>
                            <button class="btn btn-primary" id="btnTambahKendaraan">
                                <i class="fas fa-plus" style="margin-right: 5px;"></i> Tambah Kendaraan
                            </button>
                        </div>

                        <!-- Minimalist Version -->
                        <div class="summary-card minimalist">
                            <div class="summary-stats-minimal">
                                <div class="stat-minimal stat-minimal-total">
                                    <div class="stat-minimal-icon">
                                        <i class="fas fa-car"></i>
                                    </div>
                                    <div class="stat-minimal-content">
                                        <div class="stat-minimal-value">{{ $stats['totalKendaraan'] }}</div>
                                        <div class="stat-minimal-label">Total Kendaraan</div>
                                    </div>
                                </div>

                                <div class="stat-minimal stat-minimal-warning">
                                    <div class="stat-minimal-icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="stat-minimal-content">
                                        <div class="stat-minimal-value">{{ $stats['totalKendaraanAkanMatiPajak'] }}
                                        </div>
                                        <div class="stat-minimal-label">Akan Mati Pajak</div>
                                    </div>
                                </div>

                                <div class="stat-minimal stat-minimal-danger">
                                    <div class="stat-minimal-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                    <div class="stat-minimal-content">
                                        <div class="stat-minimal-value">{{ $stats['totalKendaraanPajakMati'] }}</div>
                                        <div class="stat-minimal-label">Pajak Mati</div>
                                    </div>
                                </div>

                                <div class="stat-minimal stat-minimal-success">
                                    <div class="stat-minimal-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="stat-minimal-content">
                                        <div class="stat-minimal-value">{{ $stats['totalKendaraanPajakHidup'] }}</div>
                                        <div class="stat-minimal-label">Pajak Berlaku</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Plat Kendaraan</th>
                                        <th>Tipe Kendaraan</th>
                                        <th>Pajak Berlaku Hingga</th>
                                        <th>Sisa Waktu Pajak</th>
                                        <th>Status Pajak Kendaraan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kendaraan as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->plat_kendaraan ?? '-' }}</td>
                                            <td>
                                                {{ ucfirst($item->tipe_kendaraan) ?? '-' }}
                                            </td>

                                            {{-- Pajak berlaku hingga --}}
                                            <td>
                                                @if ($item->pajak_berlaku_hingga)
                                                    {{ \Carbon\Carbon::parse($item->pajak_berlaku_hingga)->translatedFormat('d F Y') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>


                                            {{-- Sisa waktu --}}
                                            <td>
                                                @if ($item->sisa_waktu)
                                                    @if ($item->sisa_waktu_badge_class)
                                                        <span
                                                            class="badge {{ $item->sisa_waktu_badge_class }}">{{ $item->sisa_waktu }}</span>
                                                    @else
                                                        {{ $item->sisa_waktu }}
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            {{-- Status --}}
                                            <td>
                                                @if ($item->status_text)
                                                    <span
                                                        class="badge {{ $item->badge_class ?? '' }}">{{ $item->status_text }}</span>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-warning btn-sm btn-edit"
                                                        data-id="{{ $item->id }}"
                                                        data-plat="{{ $item->plat_kendaraan }}"
                                                        data-tipe="{{ $item->tipe_kendaraan }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-success btn-sm btn-update-pajak"
                                                        data-id="{{ $item->id }}"
                                                        data-pajak="{{ $item->pajak_berlaku_hingga }}">
                                                        <i class="fas fa-calendar-alt" style="margin-right: 5px"></i>
                                                        Update Pajak
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kendaraan -->
    <div class="modal" id="modalTambahKendaraan">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Kendaraan Baru</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form id="formTambahKendaraan" action="{{ route('kendaraan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="tipe_kendaraan">Tipe Kendaraan</label>
                        <select class="form-select" id="tipe_kendaraan" name="tipe_kendaraan" required>
                            <option value="" selected disabled>Pilih Tipe Kendaraan</option>
                            <option value="mobil">Mobil</option>
                            <option value="motor">Motor</option>
                            <option value="bus">Bus</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="plat_kendaraan">Plat Kendaraan</label>
                        <input type="text" class="form-control" id="plat_kendaraan" name="plat_kendaraan"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pajak_berlaku_hingga">Pajak Berlaku Hingga</label>
                        <input type="date" class="form-control" id="pajak_berlaku_hingga"
                            name="pajak_berlaku_hingga" autocomplete="off" onfocus="this.showPicker()">
                        <small class="text-muted">Biarkan kosong jika belum diketahui</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnBatalTambah">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Kendaraan -->
    <div class="modal" id="modalEditKendaraan">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Data Kendaraan</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form id="formEditKendaraan" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="edit_tipe_kendaraan">Tipe Kendaraan</label>
                        <select class="form-select" id="edit_tipe_kendaraan" name="tipe_kendaraan" required>
                            <option value="" selected disabled>Pilih Tipe Kendaraan</option>
                            <option value="mobil">Mobil</option>
                            <option value="motor">Motor</option>
                            <option value="bus">Bus</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit_plat_kendaraan">Plat Kendaraan</label>
                        <input type="text" class="form-control" id="edit_plat_kendaraan" name="plat_kendaraan"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnBatalEdit">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Update Pajak -->
    <div class="modal" id="modalUpdatePajak">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Tanggal Pajak</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form id="formUpdatePajak" action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="update_pajak_berlaku_hingga">Pajak Berlaku Hingga</label>
                        <input type="text" class="form-control" id="update_pajak_berlaku_hingga"
                            name="pajak_berlaku_hingga" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnBatalUpdatePajak">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Pajak</button>
                </div>
            </form>
        </div>
    </div>

    <!-- End of Content Wrapper -->
</body>

{{-- Components --}}
<script src="{{ asset('js/components.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Flatpickr untuk date input
        flatpickr("#pajak_berlaku_hingga", {
            dateFormat: "Y-m-d",
            allowInput: true
        });

        flatpickr("#update_pajak_berlaku_hingga", {
            dateFormat: "Y-m-d",
            allowInput: true
        });

        // Toast notification
        const toast = document.getElementById('toast');
        if (toast) {
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                toast.classList.remove('show');
            });

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Modal elements
        const modalTambah = document.getElementById('modalTambahKendaraan');
        const modalEdit = document.getElementById('modalEditKendaraan');
        const modalUpdatePajak = document.getElementById('modalUpdatePajak');

        // Button elements
        const btnTambah = document.getElementById('btnTambahKendaraan');
        const btnBatalTambah = document.getElementById('btnBatalTambah');
        const btnBatalEdit = document.getElementById('btnBatalEdit');
        const btnBatalUpdatePajak = document.getElementById('btnBatalUpdatePajak');

        // Close buttons
        const closeButtons = document.querySelectorAll('.modal-close');

        // Show modal tambah kendaraan
        btnTambah.addEventListener('click', function() {
            modalTambah.classList.add('show');
        });

        // Show modal edit kendaraan
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const plat = this.getAttribute('data-plat');
                const tipe = this.getAttribute('data-tipe');

                document.getElementById('edit_plat_kendaraan').value = plat;
                document.getElementById('edit_tipe_kendaraan').value = tipe;
                document.getElementById('formEditKendaraan').action = `/kendaraan/${id}`;

                modalEdit.classList.add('show');
            });
        });

        // Show modal update pajak
        document.querySelectorAll('.btn-update-pajak').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const pajak = this.getAttribute('data-pajak');

                document.getElementById('update_pajak_berlaku_hingga').value = pajak;
                document.getElementById('formUpdatePajak').action =
                    `/kendaraan/${id}/update-pajak`;

                modalUpdatePajak.classList.add('show');
            });
        });

        // Close modals
        function closeAllModals() {
            modalTambah.classList.remove('show');
            modalEdit.classList.remove('show');
            modalUpdatePajak.classList.remove('show');
        }

        btnBatalTambah.addEventListener('click', closeAllModals);
        btnBatalEdit.addEventListener('click', closeAllModals);
        btnBatalUpdatePajak.addEventListener('click', closeAllModals);

        closeButtons.forEach(button => {
            button.addEventListener('click', closeAllModals);
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modalTambah) {
                modalTambah.classList.remove('show');
            }
            if (event.target === modalEdit) {
                modalEdit.classList.remove('show');
            }
            if (event.target === modalUpdatePajak) {
                modalUpdatePajak.classList.remove('show');
            }
        });
    });
</script>

</html>
