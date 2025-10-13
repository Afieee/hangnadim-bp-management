<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerocity - Asset Kendaraan Operasional</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/list-kendaraan.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">
</head>
<style>
    /* Tambahan untuk statistik service */
    .stat-minimal .stat-minimal-icon i {
        font-size: 1.1rem;
    }

    /* Warna khusus untuk statistik service */
    .service-stat-minimal-danger .stat-minimal-icon {
        background: #e74c3c;
    }

    .service-stat-minimal-warning .stat-minimal-icon {
        background: #f39c12;
    }

    .service-stat-minimal-success .stat-minimal-icon {
        background: #27ae60;
    }

    .service-stat-minimal-total .stat-minimal-icon {
        background: #3498db;
    }

    .service-stat-minimal-secondary .stat-minimal-icon {
        background: #95a5a6;
    }

    /* Warna teks untuk service stats */
    .service-stat-minimal-danger .stat-minimal-value {
        color: #e74c3c;
    }

    .service-stat-minimal-warning .stat-minimal-value {
        color: #f39c12;
    }

    .service-stat-minimal-success .stat-minimal-value {
        color: #27ae60;
    }

    .service-stat-minimal-total .stat-minimal-value {
        color: #3498db;
    }

    .service-stat-minimal-secondary .stat-minimal-value {
        color: #95a5a6;
    }

    /* Border left colors untuk service */
    .service-stat-minimal-danger {
        border-left-color: #e74c3c;
    }

    .service-stat-minimal-warning {
        border-left-color: #f39c12;
    }

    .service-stat-minimal-success {
        border-left-color: #27ae60;
    }

    .service-stat-minimal-total {
        border-left-color: #3498db;
    }

    .service-stat-minimal-secondary {
        border-left-color: #95a5a6;
    }

    /* Section title untuk service stats */
    .service-stats-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .service-stats-title i {
        color: #3498db;
    }
</style>

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
                    <li class="active"><i class="fas fa-car"></i> Asset Kendaraan Operasional</li>
                </ul>
            </div>
        </div>

        <div class="content-area">
            <div class="card">
                <div class="card-custom p-4">
                    <!-- Header dengan judul, pencarian, dan tombol -->
                    <div class="header-container" style="padding: 25px;">
                        <div class="table-header">
                            <h2 class="page-title">Asset Kendaraan Operasional </h2>
                            <button class="btn btn-primary" id="btnTambahKendaraan">
                                <i class="fas fa-plus" style="margin-right: 5px;"></i> Tambah Kendaraan
                            </button>
                        </div>

                        <!-- Statistik Pajak -->
                        <div class="summary-card minimalist">
                            <div class="service-stats-title">
                                <i class="fas fa-file-invoice-dollar"></i>
                                Pajak Kendaraan
                            </div>
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

                        <!-- Statistik Service -->
                        <div class="summary-card minimalist" style="margin-top: 20px;">
                            <div class="service-stats-title">
                                <i class="fas fa-tools"></i>
                                Service Kendaraan
                            </div>
                            <div class="summary-stats-minimal">
                                <div class="stat-minimal service-stat-minimal-total">
                                    <div class="stat-minimal-icon">
                                        <i class="fas fa-car-side"></i>
                                    </div>
                                    <div class="stat-minimal-content">
                                        <div class="stat-minimal-value">{{ $stats['totalKendaraan'] }}</div>
                                        <div class="stat-minimal-label">Total Kendaraan</div>
                                    </div>
                                </div>

                                <div class="stat-minimal service-stat-minimal-danger">
                                    <div class="stat-minimal-icon">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div class="stat-minimal-content">
                                        <div class="stat-minimal-value">{{ $stats['totalKendaraanPerluService'] }}</div>
                                        <div class="stat-minimal-label">Perlu Service</div>
                                    </div>
                                </div>

                                <div class="stat-minimal service-stat-minimal-warning">
                                    <div class="stat-minimal-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-minimal-content">
                                        <div class="stat-minimal-value">{{ $stats['totalKendaraanAkanService'] }}</div>
                                        <div class="stat-minimal-label">Akan Service</div>
                                    </div>
                                </div>

                                <div class="stat-minimal service-stat-minimal-success">
                                    <div class="stat-minimal-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="stat-minimal-content">
                                        <div class="stat-minimal-value">{{ $stats['totalKendaraanServiceBaik'] }}
                                        </div>
                                        <div class="stat-minimal-label">Kondisi Baik</div>
                                    </div>
                                </div>

                                @if ($stats['totalKendaraanBelumDiatur'] > 0)
                                    <div class="stat-minimal service-stat-minimal-secondary">
                                        <div class="stat-minimal-icon">
                                            <i class="fas fa-question-circle"></i>
                                        </div>
                                        <div class="stat-minimal-content">
                                            <div class="stat-minimal-value">{{ $stats['totalKendaraanBelumDiatur'] }}
                                            </div>
                                            <div class="stat-minimal-label">Belum Diatur</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Polisi</th>
                                        <th>Tipe Kendaraan</th>
                                        <th>Pajak Berlaku Hingga</th>
                                        <th>Sisa Waktu Pajak</th>
                                        <th>Status Pajak Kendaraan</th>
                                        <th>Jarak Tempuh Kendaraan(KM)</th>
                                        <th>Waktu Diservice Selanjutnya</th>
                                        <th>Sisa Waktu Service</th>
                                        <th>Status Service</th>
                                        <th>Aksi</th>
                                        <th>Histori Pajak</th>
                                        <th>Histori Service</th>
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

                                            {{-- Sisa waktu pajak --}}
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

                                            {{-- Status pajak --}}
                                            <td>
                                                @if ($item->status_text)
                                                    <span
                                                        class="badge {{ $item->badge_class ?? '' }}">{{ $item->status_text }}</span>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td>{{ $item->km ?? '-' }}</td>

                                            <td>
                                                @if ($item->waktu_diservice_selanjutnya)
                                                    {{ \Carbon\Carbon::parse($item->waktu_diservice_selanjutnya)->translatedFormat('d F Y') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            {{-- Sisa waktu service --}}
                                            <td>
                                                @if ($item->waktu_diservice_selanjutnya)
                                                    @php
                                                        $today = \Carbon\Carbon::now()->startOfDay();
                                                        $serviceDate = \Carbon\Carbon::parse(
                                                            $item->waktu_diservice_selanjutnya,
                                                        )->startOfDay();

                                                        // Gunakan diff() untuk mendapatkan tahun, bulan, hari
                                                        $diff = $today->diff($serviceDate);
                                                        $isPast = $today->gt($serviceDate);

                                                        // Bangun string format
                                                        $parts = [];
                                                        if ($diff->y > 0) {
                                                            $parts[] = $diff->y . ' tahun';
                                                        }
                                                        if ($diff->m > 0) {
                                                            $parts[] = $diff->m . ' bulan';
                                                        }
                                                        if ($diff->d > 0) {
                                                            $parts[] = $diff->d . ' hari';
                                                        }

                                                        // Jika tidak ada selisih (hari ini)
                                                        if (empty($parts)) {
                                                            $parts[] = '0 hari';
                                                        }

                                                        $timeString = implode(' ', $parts);

                                                        // Tentukan badge class dan teks
                                                        if ($isPast) {
                                                            $badgeClass = 'badge-danger';
                                                            $statusText = 'Sudah lewat ' . $timeString;
                                                        } else {
                                                            if ($today->eq($serviceDate)) {
                                                                $badgeClass = 'badge-warning';
                                                                $statusText = 'Hari ini';
                                                            } elseif ($today->diffInDays($serviceDate) <= 7) {
                                                                $badgeClass = 'badge-warning';
                                                                $statusText = $timeString . ' lagi';
                                                            } else {
                                                                $badgeClass = 'badge-success';
                                                                $statusText = $timeString . ' lagi';
                                                            }
                                                        }
                                                    @endphp
                                                    <span
                                                        class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            {{-- Status service --}}
                                            <td>
                                                @if ($item->waktu_diservice_selanjutnya)
                                                    @php
                                                        $today = \Carbon\Carbon::now();
                                                        $serviceDate = \Carbon\Carbon::parse(
                                                            $item->waktu_diservice_selanjutnya,
                                                        );
                                                        $diffDays = $today->diffInDays($serviceDate, false);

                                                        if ($diffDays < 0) {
                                                            // Sudah lewat batas
                                                            $badgeClass = 'badge-danger';
                                                            $statusText = 'Perlu Service';
                                                        } elseif ($diffDays <= 7) {
                                                            // Kurang dari 7 hari
                                                            $badgeClass = 'badge-warning';
                                                            $statusText = 'Akan Service';
                                                        } else {
                                                            // Masih lama
                                                            $badgeClass = 'badge-success';
                                                            $statusText = 'Kondisi Baik';
                                                        }
                                                    @endphp
                                                    <span
                                                        class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                                @else
                                                    <span class="badge badge-secondary">Belum Diatur</span>
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

                                                    <!-- Button Update Status Servis -->
                                                    <button class="btn btn-info btn-sm btn-update-service"
                                                        data-id="{{ $item->id }}" data-km="{{ $item->km }}"
                                                        data-service-terakhir="{{ $item->waktu_diservice_terakhir }}"
                                                        data-service-selanjutnya="{{ $item->waktu_diservice_selanjutnya }}">
                                                        <i class="fas fa-wrench" style="margin-right: 5px"></i>
                                                        Update Servis
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('kendaraan.histori', ['id' => Crypt::encryptString($item->id)]) }}">
                                                    Histori Pajak
                                                </a>
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('kendaraan.histori-service', ['id' => Crypt::encryptString($item->id)]) }}">
                                                    Histori Service
                                                </a>
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
            <form id="formUpdatePajak" action="" method="POST" onsubmit="return confirmSubmit()">
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

    <!-- Modal Update Status Servis -->
    <div class="modal" id="modalUpdateService">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Status Servis Kendaraan</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form id="formUpdateService" action="" method="POST" onsubmit="return confirmUpdateService()">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="update_km">Jarak Tempuh (KM)</label>
                        <input type="number" class="form-control" id="update_km" name="km"
                            placeholder="Masukkan jarak tempuh saat ini" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="update_waktu_diservice_terakhir">Waktu Diservice
                            Terakhir</label>
                        <input type="text" class="form-control" id="update_waktu_diservice_terakhir"
                            name="waktu_diservice_terakhir" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="update_waktu_diservice_selanjutnya">Waktu Diservice
                            Selanjutnya</label>
                        <input type="text" class="form-control" id="update_waktu_diservice_selanjutnya"
                            name="waktu_diservice_selanjutnya" required>
                        <small class="text-muted">Servis selanjutnya biasanya 3-6 bulan setelah servis terakhir</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnBatalUpdateService">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                </div>
            </form>
        </div>
    </div>

</body>

{{-- Components --}}
<script src="{{ asset('js/components.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Flatpickr untuk semua date input
        flatpickr("#pajak_berlaku_hingga", {
            dateFormat: "Y-m-d",
            allowInput: true
        });

        flatpickr("#update_pajak_berlaku_hingga", {
            dateFormat: "Y-m-d",
            allowInput: true
        });

        flatpickr("#update_waktu_diservice_terakhir", {
            dateFormat: "Y-m-d",
            allowInput: true
        });

        flatpickr("#update_waktu_diservice_selanjutnya", {
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
        const modalUpdateService = document.getElementById('modalUpdateService');

        // Button elements
        const btnTambah = document.getElementById('btnTambahKendaraan');
        const btnBatalTambah = document.getElementById('btnBatalTambah');
        const btnBatalEdit = document.getElementById('btnBatalEdit');
        const btnBatalUpdatePajak = document.getElementById('btnBatalUpdatePajak');
        const btnBatalUpdateService = document.getElementById('btnBatalUpdateService');

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

        // Show modal update service
        document.querySelectorAll('.btn-update-service').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const km = this.getAttribute('data-km');
                const serviceTerakhir = this.getAttribute('data-service-terakhir');
                const serviceSelanjutnya = this.getAttribute('data-service-selanjutnya');

                // Set values to form
                document.getElementById('update_km').value = km || '';
                document.getElementById('update_waktu_diservice_terakhir').value =
                    serviceTerakhir || '';
                document.getElementById('update_waktu_diservice_selanjutnya').value =
                    serviceSelanjutnya || '';

                // Set form action
                document.getElementById('formUpdateService').action =
                    `/kendaraan/${id}/update-service`;

                modalUpdateService.classList.add('show');
            });
        });

        // Close modals
        function closeAllModals() {
            modalTambah.classList.remove('show');
            modalEdit.classList.remove('show');
            modalUpdatePajak.classList.remove('show');
            modalUpdateService.classList.remove('show');
        }

        btnBatalTambah.addEventListener('click', closeAllModals);
        btnBatalEdit.addEventListener('click', closeAllModals);
        btnBatalUpdatePajak.addEventListener('click', closeAllModals);
        btnBatalUpdateService.addEventListener('click', closeAllModals);

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
            if (event.target === modalUpdateService) {
                modalUpdateService.classList.remove('show');
            }
        });
    });

    function confirmSubmit() {
        return confirm(
            "⚠️ PERINGATAN SERIUS!\n\n" +
            "Apakah Anda benar-benar yakin ingin menyimpan data kendaraan ini?\n\n" +
            "Setelah data disimpan, *seluruh histori yang dicatat tidak dapat diubah atau dihapus!* " +
            "\n\nTekan 'OK' untuk melanjutkan, atau 'Cancel' untuk membatalkan."
        );
    }

    function confirmUpdateService() {
        return confirm(
            "⚠️ PERINGATAN!\n\nApakah Anda yakin ingin memperbarui data servis kendaraan ini?\n" +
            "Setelah disimpan, data jarak tempuh dan waktu servis akan tercatat permanen dalam histori!\n\n" +
            "Tekan OK untuk melanjutkan atau Cancel untuk membatalkan."
        );
    }
</script>

</html>
