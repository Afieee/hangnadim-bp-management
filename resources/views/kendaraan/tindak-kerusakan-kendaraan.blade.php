<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tindak Crash Condition</title>
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tindak-laporan-pribadi.css') }}">

    <style>
        /* Styling untuk thumbnail foto di tabel */
        .thumbnail-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            transition: transform 0.2s;
            border: 1px solid #ddd;
        }

        .thumbnail-image:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Styling untuk modal gambar */
        .modal-image {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            overflow: auto;
        }

        .modal-image-content {
            display: block;
            margin: auto;
            max-width: 90%;
            max-height: 90%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
            transition: color 0.3s;
        }

        .close-modal:hover {
            color: #bbb;
        }

        /* Styling untuk sel foto di tabel */
        td img {
            display: block;
            margin: 0 auto;
        }

        /* Styling untuk sel tanpa foto */
        .no-photo {
            text-align: center;
            color: #999;
            font-style: italic;
        }

        .status-chip {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-closed {
            background-color: #1cc88a;
            color: white;
        }

        .status-waiting {
            background-color: #f6c23e;
            color: #2c2929;
        }

        .btn-penanganan {
            display: inline-flex;
            align-items: center;
            background-color: #4e73df;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            /* Sudut sedikit melengkung, bukan bulat */
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-penanganan i {
            margin-right: 6px;
        }

        .btn-penanganan:hover {
            background-color: #2e59d9;
        }

        /* Pagination styling - SEDERHANA DAN MODERN */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 8px;
        }

        .pagination li {
            margin: 0;
        }

        .pagination a,
        .pagination span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            color: #4e73df;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            background: white;
        }

        .pagination a:hover {
            background-color: #f0f4ff;
            border-color: #4e73df;
        }

        .pagination .active span {
            background-color: #4e73df;
            color: white;
            border-color: #4e73df;
        }

        .pagination .disabled span {
            color: #b0b0b0;
            background-color: #f9f9f9;
            border-color: #e0e0e0;
        }

        /* Table responsive */
        @media (max-width: 992px) {
            .table-container {
                padding: 15px;
            }

            .table-modern {
                display: block;
                overflow-x: auto;
            }

            .pagination-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .pagination-info {
                order: 2;
                margin-top: 10px;
            }

            .pagination {
                order: 1;
            }
        }

        @media (max-width: 576px) {
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }

            .pagination a,
            .pagination span {
                min-width: 34px;
                height: 34px;
                font-size: 0.85rem;
            }
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
                    <li class="active"><i class="fas fa-calendar-check"></i> Laporan Kerusakan Pribadi</li>
                </ul>
            </div>
        </div>

        <div class="content-area">
            <div class="card">
                <div class="container">
                    <div class="table-container">
                        <h2 class="table-title">Tindak Lanjut Laporan Crash Condition</h2>

                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kendaraan</th>
                                    <th>Objek Kerusakan</th>
                                    <th>Tipe Kerusakan</th>
                                    <th>Deskripsi</th>
                                    <th>Foto</th>
                                    <th>Status Kerusakan</th>
                                    <th>Pelapor</th>
                                    <th>Waktu Dilaporkan</th>
                                    <th>Status Perbaikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kerusakanKendaraan as $index => $kerusakan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $kerusakan->kendaraan->tipe_kendaraan }} -
                                            {{ $kerusakan->kendaraan->plat_kendaraan }}
                                        </td>
                                        <td>{{ $kerusakan->objek_kerusakan }}</td>
                                        <td>{{ $kerusakan->tipe_kerusakan }}</td>
                                        <td>{{ $kerusakan->deskripsi_kerusakan }}</td>
                                        <td>
                                            @if ($kerusakan->foto_kerusakan)
                                                <img src="{{ asset('storage/' . $kerusakan->foto_kerusakan) }}"
                                                    alt="Foto Kerusakan" class="thumbnail-image"
                                                    onclick="showImageModal(this.src)">
                                            @else
                                                <span class="no-photo">Tidak Ada Foto</span>
                                            @endif
                                        </td>
                                        <td>{{ $kerusakan->status_kerusakan }}</td>
                                        <td>{{ $kerusakan->user->name }}</td>
                                        <td>{{ $kerusakan->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            @if ($kerusakan->perbaikanKerusakanKendaraan->isNotEmpty())
                                                <span class="status-chip status-closed"> Kasus Ditutup</span>
                                            @else
                                                <span class="status-chip status-waiting"> Menunggu Perbaikan</span>
                                            @endif
                                        </td>


                                        <td>
                                            <a href="{{ route('bukti-perbaikan-kerusakan-kendaraan.create', \Illuminate\Support\Facades\Crypt::encryptString($kerusakan->id)) }}"
                                                class="btn-penanganan">
                                                <i class="fas fa-wrench"></i>
                                                Penanganan
                                            </a>


                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-container">
                            <div class="pagination-info">
                                Menampilkan {{ $kerusakanKendaraan->firstItem() }} -
                                {{ $kerusakanKendaraan->lastItem() }} dari {{ $kerusakanKendaraan->total() }} hasil
                            </div>

                            <!-- Custom Pagination -->
                            @if ($kerusakanKendaraan->lastPage() > 1)
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    <li class="{{ $kerusakanKendaraan->onFirstPage() ? 'disabled' : '' }}">
                                        @if ($kerusakanKendaraan->onFirstPage())
                                            <span>&laquo;</span>
                                        @else
                                            <a href="{{ $kerusakanKendaraan->previousPageUrl() }}"
                                                rel="prev">&laquo;</a>
                                        @endif
                                    </li>

                                    {{-- Pagination Elements --}}
                                    @for ($i = 1; $i <= $kerusakanKendaraan->lastPage(); $i++)
                                        <li class="{{ $kerusakanKendaraan->currentPage() == $i ? 'active' : '' }}">
                                            @if ($kerusakanKendaraan->currentPage() == $i)
                                                <span>{{ $i }}</span>
                                            @else
                                                <a href="{{ $kerusakanKendaraan->url($i) }}">{{ $i }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    {{-- Next Page Link --}}
                                    <li class="{{ $kerusakanKendaraan->hasMorePages() ? '' : 'disabled' }}">
                                        @if ($kerusakanKendaraan->hasMorePages())
                                            <a href="{{ $kerusakanKendaraan->nextPageUrl() }}"
                                                rel="next">&raquo;</a>
                                        @else
                                            <span>&raquo;</span>
                                        @endif
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk menampilkan foto -->
        <div id="imageModal" class="modal-image">
            <span class="close-modal" onclick="closeImageModal()">&times;</span>
            <img class="modal-image-content" id="modalImage">
        </div>
        <script src="{{ asset('js/components.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.getElementById('toast');
                if (toast) {
                    // Show toast with animation
                    setTimeout(() => {
                        toast.classList.add('show');
                    }, 100);

                    // Close toast when close button is clicked
                    const closeBtn = toast.querySelector('.toast-close');
                    closeBtn.addEventListener('click', () => {
                        toast.classList.remove('show');
                    });

                    // Auto-hide after 3 seconds
                    setTimeout(() => {
                        toast.classList.remove('show');
                    }, 3000);
                }
            });

            // Fungsi untuk menampilkan modal gambar
            function showImageModal(imageSrc) {
                document.getElementById('modalImage').src = imageSrc;
                document.getElementById('imageModal').style.display = 'block';
                document.body.style.overflow = 'hidden'; // Mencegah scroll saat modal terbuka
            }

            // Fungsi untuk menutup modal gambar
            function closeImageModal() {
                document.getElementById('imageModal').style.display = 'none';
                document.body.style.overflow = 'auto'; // Mengembalikan scroll
            }

            // Tutup modal jika mengklik di luar gambar
            document.getElementById('imageModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeImageModal();
                }
            });

            // Tutup modal dengan tombol ESC
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeImageModal();
                }
            });
        </script>
</body>

</html>
