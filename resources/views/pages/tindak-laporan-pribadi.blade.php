<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kerusakan Pribadi</title>

    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            from {transform: scale(0.8); opacity: 0;}
            to {transform: scale(1); opacity: 1;}
        }
        
        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
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
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
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
                    <div class="table-container">
                        <h2 class="table-title">Tindak Lanjut Laporan Pribadi</h2>

                        @if($buktiKerusakanPribadi->isEmpty())
                            <div class="alert alert-info">
                                Tidak ada bukti kerusakan pribadi.
                            </div>
                        @else
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Gedung</th>
                                        <th>Pelapor</th>
                                        <th>Lokasi</th>
                                        <th>Tipe Kerusakan</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                        <th>Status</th>
                                        <th>Waktu Dilaporkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $startNumber = ($buktiKerusakanPribadi->currentPage() - 1) * $buktiKerusakanPribadi->perPage() + 1;
                                    @endphp
                                    @foreach($buktiKerusakanPribadi as $index => $bukti)
                                        <tr>
                                            <td>{{ $startNumber + $index }}</td>
                                            <td>{{ $bukti->judul_bukti_kerusakan }}</td>
                                            <td>{{ Str::limit($bukti->deskripsi_bukti_kerusakan, 50) }}</td>
                                            <td>{{ $bukti->gedung->nama_gedung }}</td>
                                            <td>{{ $bukti->userInspektor->name }}</td>
                                            <td>{{ $bukti->lokasi_bukti_kerusakan }}</td>
                                            <td>{{ $bukti->tipe_kerusakan }}</td>
                                            <td>
                                                @if($bukti->file_bukti_kerusakan)
                                                    <img src="{{ asset('storage/' . $bukti->file_bukti_kerusakan) }}" 
                                                         alt="Bukti Kerusakan" 
                                                         class="thumbnail-img"
                                                         onclick="showImageModal('{{ asset('storage/' . $bukti->file_bukti_kerusakan) }}')">
                                                @else
                                                    <span class="text-muted">Tidak ada foto</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('bukti-perbaikan.create', \Illuminate\Support\Facades\Crypt::encryptString($bukti->id)) }}" 
                                                   class="btn-upload">
                                                    Penanganan
                                                </a>
                                            </td>
                                            <td>
                                                @if($bukti->buktiPerbaikan)
                                                    <span class="status-chip status-closed">Kasus Ditutup</span>
                                                @else
                                                    <span class="status-chip status-waiting">Menunggu Perbaikan</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($bukti->created_at)->translatedFormat('d F Y H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <!-- Pagination sederhana dan modern -->
                            <div class="pagination-container">
                                <div class="pagination-info">
                                    Menampilkan {{ $buktiKerusakanPribadi->firstItem() }} - {{ $buktiKerusakanPribadi->lastItem() }} dari {{ $buktiKerusakanPribadi->total() }} data
                                </div>
                                
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($buktiKerusakanPribadi->onFirstPage())
                                        <li class="disabled"><span>&laquo;</span></li>
                                    @else
                                        <li><a href="{{ $buktiKerusakanPribadi->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @for ($i = 1; $i <= $buktiKerusakanPribadi->lastPage(); $i++)
                                        @if ($i == $buktiKerusakanPribadi->currentPage())
                                            <li class="active"><span>{{ $i }}</span></li>
                                        @else
                                            <li><a href="{{ $buktiKerusakanPribadi->url($i) }}">{{ $i }}</a></li>
                                        @endif
                                    @endfor

                                    {{-- Next Page Link --}}
                                    @if ($buktiKerusakanPribadi->hasMorePages())
                                        <li><a href="{{ $buktiKerusakanPribadi->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                    @else
                                        <li class="disabled"><span>&raquo;</span></li>
                                    @endif
                                </ul>
                            </div>
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