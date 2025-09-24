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

                        @if ($buktiKerusakanPribadi->isEmpty())
                            <div class="alert alert-info">
                                Tidak ada bukti kerusakan pribadi.
                            </div>
                        @else
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
                                        <th>Aksi</th>
                                        <th>Status</th>
                                        <th>Waktu Dilaporkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $startNumber =
                                            ($buktiKerusakanPribadi->currentPage() - 1) *
                                                $buktiKerusakanPribadi->perPage() +
                                            1;
                                    @endphp
                                    @foreach ($buktiKerusakanPribadi as $index => $bukti)
                                        <tr>
                                            <td>{{ $startNumber + $index }}</td>
                                            <td>{{ $bukti->judul_bukti_kerusakan }}</td>
                                            <td>{{ Str::limit($bukti->deskripsi_bukti_kerusakan, 50) }}</td>
                                            <td>{{ $bukti->gedung->nama_gedung }}</td>
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
                                                <a href="{{ route('bukti-perbaikan.create', \Illuminate\Support\Facades\Crypt::encryptString($bukti->id)) }}"
                                                    class="btn-upload">
                                                    Penanganan
                                                </a>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination sederhana dan modern -->
                            <div class="pagination-container">
                                <div class="pagination-info">
                                    Menampilkan {{ $buktiKerusakanPribadi->firstItem() }} -
                                    {{ $buktiKerusakanPribadi->lastItem() }} dari
                                    {{ $buktiKerusakanPribadi->total() }} data
                                </div>

                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($buktiKerusakanPribadi->onFirstPage())
                                        <li class="disabled"><span>&laquo;</span></li>
                                    @else
                                        <li><a href="{{ $buktiKerusakanPribadi->previousPageUrl() }}"
                                                rel="prev">&laquo;</a></li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @for ($i = 1; $i <= $buktiKerusakanPribadi->lastPage(); $i++)
                                        @if ($i == $buktiKerusakanPribadi->currentPage())
                                            <li class="active"><span>{{ $i }}</span></li>
                                        @else
                                            <li><a
                                                    href="{{ $buktiKerusakanPribadi->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endfor

                                    {{-- Next Page Link --}}
                                    @if ($buktiKerusakanPribadi->hasMorePages())
                                        <li><a href="{{ $buktiKerusakanPribadi->nextPageUrl() }}"
                                                rel="next">&raquo;</a></li>
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
