<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tindak Crash Condition</title>
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

</head>
<style>
    /* Modal untuk foto */
    .modal-image {
        display: none;
        position: fixed;
        z-index: 9999;
        padding-top: 50px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
        animation: fadeIn 0.3s;
    }

    .modal-image-content {
        display: block;
        margin: 0 auto;
        max-width: 90%;
        max-height: 80%;
        border-radius: 5px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        animation: zoomIn 0.3s;
    }

    .close-modal {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .close-modal:hover,
    .close-modal:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Tabel styling */
    .table-container {
        border-radius: 10px;
        padding: 20px;
        overflow-x: auto;
    }

    .table-title {
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
        font-weight: 600;
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.9rem;
    }

    .table-modern thead th {
        background-color: #4e73df;
        color: white;
        font-weight: 600;
        padding: 12px 15px;
        border: none;
        text-align: left;
    }

    .table-modern tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #eef1f7;
    }

    .table-modern tbody tr:hover {
        background-color: #f8f9fc;
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

    .thumbnail-img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .thumbnail-img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-upload {
        background: #4e73df;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 0.85rem;
        transition: all 0.3s;
        display: inline-block;
        text-decoration: none;
    }

    .btn-upload:hover {
        background: #2e59d9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(78, 115, 223, 0.3);
        color: white;
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

    .btn-export {
        background: #1cc88a;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-weight: 500;
    }

    .btn-export:hover {
        background: #17a673;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(28, 200, 138, 0.3);
        color: white;
    }
</style>

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
                        <div class="table-header"
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h2 class="table-title">Rekapitulasi Kerusakan</h2>
                            <a href="{{ route('rekapitulasi.export') }}" class="btn-export">
                                <i class="fas fa-file-export"></i> Ekspor ke Excel
                            </a>
                        </div>

                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Objek Kerusakan</th>
                                    <th>Deskripsi</th>
                                    <th>Gedung</th>
                                    <th>Pelapor</th>
                                    <th>Lokasi</th>
                                    <th>Tipe Kerusakan</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Waktu Dilaporkan</th>
                                    <th>Tipe Pelaporan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startNumber =
                                        ($buktiKerusakan->currentPage() - 1) * $buktiKerusakan->perPage() + 1;
                                @endphp
                                @foreach ($buktiKerusakan as $bukti)
                                    <tr>
                                        <td>{{ $startNumber++ }}</td>
                                        <td>{{ $bukti->judul_bukti_kerusakan }}</td>
                                        <td>{{ $bukti->deskripsi_bukti_kerusakan }}</td>
                                        <td>
                                            {{ implode(' - ', array_filter([$bukti->gedung?->nama_gedung, $bukti->inspeksiGedung?->gedung?->nama_gedung])) }}
                                        </td>
                                        <td>{{ $bukti->userInspektor->name }}</td>
                                        <td>{{ $bukti->lokasi_bukti_kerusakan }}</td>
                                        <td>{{ $bukti->tipe_kerusakan }}</td>
                                        <td>
                                            @if ($bukti->file_bukti_kerusakan)
                                                <img src="{{ asset('storage/' . $bukti->file_bukti_kerusakan) }}"
                                                    alt="Bukti Kerusakan" class="thumbnail-img"
                                                    onclick="showImageModal('{{ asset('storage/' . $bukti->file_bukti_kerusakan) }}')">
                                            @else
                                                <span class="text-muted">Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bukti->buktiPerbaikan)
                                                <span class="status-chip status-closed">Kasus Ditutup</span>
                                            @else
                                                <span class="status-chip status-waiting">Menunggu Perbaikan</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($bukti->created_at)->translatedFormat('d F Y H:i') }}
                                        </td>
                                        <td>{{ $bukti->tipe_pelaporan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            <div class="pagination-info">
                                Menampilkan {{ $buktiKerusakan->firstItem() }} - {{ $buktiKerusakan->lastItem() }}
                                dari {{ $buktiKerusakan->total() }} hasil
                            </div>

                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($buktiKerusakan->onFirstPage())
                                    <li class="disabled"><span>&laquo;</span></li>
                                @else
                                    <li><a href="{{ $buktiKerusakan->previousPageUrl() }}" rel="prev">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($buktiKerusakan->getUrlRange(1, $buktiKerusakan->lastPage()) as $page => $url)
                                    @if ($page == $buktiKerusakan->currentPage())
                                        <li class="active"><span>{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($buktiKerusakan->hasMorePages())
                                    <li><a href="{{ $buktiKerusakan->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                @else
                                    <li class="disabled"><span>&raquo;</span></li>
                                @endif
                            </ul>
                        </div>
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
