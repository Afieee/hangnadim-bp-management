            @if (in_array(Auth::user()->role, [
                    'Admin',
                    'Pengelola Asset',
                    'Kepala Sub Direktorat',
                    'Direktur',
                    'Deputi',
                    'Kepala Seksi',
                ]))
                <!DOCTYPE html>
                <html lang="id">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Bukti Upload</title>
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
                    <link rel="stylesheet" href="{{ asset('css/halaman-upload-bukti-perbaikan.css') }}">
                    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

                </head>
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

                <body>
                    <!-- Content Wrapper -->
                    <div class="content-wrapper" id="content-wrapper">
                        <!-- Breadcrumb Navigation -->
                        <div class="breadcrumb-container">
                            <div class="breadcrumb">
                                <ul>
                                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                                    <li class="active"><i class="fas fa-tools"></i> Bukti Perbaikan</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Content Area -->

                        <div class="content-area">
                            <div class="card">
                                <div class="gallery-container">
                                    <h2 class="gallery-title">Data Bukti Perbaikan</h2>

                                    <div class="gallery-grid">
                                        @foreach ($buktiPerbaikan as $perbaikan)
                                            <div class="gallery-item"
                                                onclick="openModal('{{ asset('storage/' . $perbaikan->file_bukti_perbaikan) }}', '{{ $perbaikan->catatan_perbaikan }}')">

                                                @if ($perbaikan->file_bukti_perbaikan)
                                                    <div class="gallery-img-container">
                                                        @if (Str::endsWith($perbaikan->file_bukti_perbaikan, ['.pdf']))
                                                            <iframe
                                                                src="{{ asset('storage/' . $perbaikan->file_bukti_perbaikan) }}"
                                                                class="gallery-img"
                                                                style="width:100%;height:200px;border:none;"></iframe>
                                                        @else
                                                            <img src="{{ asset('storage/' . $perbaikan->file_bukti_perbaikan) }}"
                                                                alt="Bukti Perbaikan" class="gallery-img">
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="no-image">
                                                        <i class="fas fa-image"></i>
                                                        <span>Tidak ada foto</span>
                                                    </div>
                                                @endif

                                                <div class="gallery-info">
                                                    <p><strong>Catatan Dari Petugas:</strong>
                                                        {{ $perbaikan->catatan_perbaikan }}</p>
                                                    <p><strong>Petugas Inspeksi:</strong>
                                                        {{ $perbaikan->userInspektor->name ?? '-' }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal untuk gambar yang diperbesar -->
                    <div id="imageModal" class="modal">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <div class="loader" id="modalLoader"></div>
                        <img class="modal-content" id="modalImage">
                        <div class="modal-caption" id="modalCaption"></div>
                    </div>

                    <script>
                        // Script untuk menampilkan nama file yang dipilih
                        document.querySelectorAll('.file-input').forEach(input => {
                            input.addEventListener('change', function(e) {
                                const fileName = e.target.files[0]?.name || 'Tidak ada file dipilih';
                                const label = this.closest('.file-input-container').querySelector('span');
                                label.textContent = fileName;
                            });
                        });

                        // Fungsi untuk membuka modal dengan gambar yang lebih besar
                        function openModal(imageSrc, caption) {
                            const modal = document.getElementById('imageModal');
                            const modalImg = document.getElementById('modalImage');
                            const captionText = document.getElementById('modalCaption');
                            const loader = document.getElementById('modalLoader');

                            // Tampilkan modal dan loader
                            modal.style.display = 'block';
                            loader.style.display = 'block';
                            modalImg.style.display = 'none';

                            // Set gambar dan caption
                            modalImg.onload = function() {
                                loader.style.display = 'none';
                                modalImg.style.display = 'block';
                            };

                            modalImg.src = imageSrc;
                            captionText.innerHTML = caption || 'Bukti Perbaikan';

                            // Tambahkan event listener untuk menutup modal dengan tombol ESC
                            document.addEventListener('keydown', handleKeyPress);
                        }

                        // Fungsi untuk menutup modal
                        function closeModal() {
                            document.getElementById('imageModal').style.display = 'none';
                            document.removeEventListener('keydown', handleKeyPress);
                        }

                        // Fungsi untuk menangani penekanan tombol ESC
                        function handleKeyPress(e) {
                            if (e.key === 'Escape') {
                                closeModal();
                            }
                        }

                        // Tutup modal ketika mengklik di luar gambar
                        document.getElementById('imageModal').addEventListener('click', function(e) {
                            if (e.target === this) {
                                closeModal();
                            }
                        });
                    </script>
                </body>
                <script src="{{ asset('js/components.js') }}"></script>
                <script src="{{ asset('js/halaman-upload-bukti-perbaikan.js') }}"></script>
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
                </script>

                </html>
            @elseif (Auth::user()->role == 'Staff Pelaksana Asset')
                <!DOCTYPE html>
                <html lang="id">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Bukti Upload</title>
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
                    <link rel="stylesheet" href="{{ asset('css/halaman-upload-bukti-perbaikan.css') }}">
                    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

                </head>
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

                <body>
                    <!-- Content Wrapper -->
                    <div class="content-wrapper" id="content-wrapper">
                        <!-- Breadcrumb Navigation -->
                        <div class="breadcrumb-container">
                            <div class="breadcrumb">
                                <ul>
                                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                                    <li class="active"><i class="fas fa-tools"></i> Bukti Perbaikan</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Content Area -->

                        <div class="content-area">
                            <div class="card">
                                <h2>Form Bukti Perbaikan Kerusakan Pada Pendaraan</h2>
                                <form action="{{ route('simpan.bukti.perbaikan.kerusakan.kendaraan') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">
                                            <label for="catatan">Catatan Perbaikan:</label>
                                            <input type="text" id="catatan" name="catatan_perbaikan"
                                                class="form-control" placeholder="Masukkan catatan perbaikan"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>Foto Bukti Perbaikan:</label>
                                            <div class="file-input-container">
                                                <label class="file-input-label">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <span>Klik untuk upload foto</span>
                                                    <input type="file" class="file-input"
                                                        name="file_bukti_perbaikan"
                                                        accept=".jpg,.jpeg,.png,.gif,.pdf,.webp" required>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" id="id_kerusakan_kendaraan"
                                                name="id_kerusakan_kendaraan" hidden class="form-control"
                                                value="{{ $kerusakan->id }}" readonly required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn">
                                        <i class="fas fa-save"></i> Simpan Bukti Perbaikan
                                    </button>
                                </form>

                                <div class="gallery-container">
                                    <h2 class="gallery-title">Data Bukti Perbaikan</h2>

                                    <div class="gallery-grid">
                                        @foreach ($buktiPerbaikan as $perbaikan)
                                            <div class="gallery-item"
                                                onclick="openModal('{{ asset('storage/' . $perbaikan->file_bukti_perbaikan) }}', '{{ $perbaikan->catatan_perbaikan }}')">

                                                @if ($perbaikan->file_bukti_perbaikan)
                                                    <div class="gallery-img-container">
                                                        @if (Str::endsWith($perbaikan->file_bukti_perbaikan, ['.pdf']))
                                                            <iframe
                                                                src="{{ asset('storage/' . $perbaikan->file_bukti_perbaikan) }}"
                                                                class="gallery-img"
                                                                style="width:100%;height:200px;border:none;"></iframe>
                                                        @else
                                                            <img src="{{ asset('storage/' . $perbaikan->file_bukti_perbaikan) }}"
                                                                alt="Bukti Perbaikan" class="gallery-img">
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="no-image">
                                                        <i class="fas fa-image"></i>
                                                        <span>Tidak ada foto</span>
                                                    </div>
                                                @endif

                                                <div class="gallery-info">
                                                    <p><strong>Catatan Dari Petugas:</strong>
                                                        {{ $perbaikan->catatan_perbaikan }}</p>
                                                    <p><strong>Petugas Inspeksi:</strong>
                                                        {{ $perbaikan->userInspektor->name ?? '-' }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal untuk gambar yang diperbesar -->
                    <div id="imageModal" class="modal">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <div class="loader" id="modalLoader"></div>
                        <img class="modal-content" id="modalImage">
                        <div class="modal-caption" id="modalCaption"></div>
                    </div>

                    <script>
                        // Script untuk menampilkan nama file yang dipilih
                        document.querySelectorAll('.file-input').forEach(input => {
                            input.addEventListener('change', function(e) {
                                const fileName = e.target.files[0]?.name || 'Tidak ada file dipilih';
                                const label = this.closest('.file-input-container').querySelector('span');
                                label.textContent = fileName;
                            });
                        });

                        // Fungsi untuk membuka modal dengan gambar yang lebih besar
                        function openModal(imageSrc, caption) {
                            const modal = document.getElementById('imageModal');
                            const modalImg = document.getElementById('modalImage');
                            const captionText = document.getElementById('modalCaption');
                            const loader = document.getElementById('modalLoader');

                            // Tampilkan modal dan loader
                            modal.style.display = 'block';
                            loader.style.display = 'block';
                            modalImg.style.display = 'none';

                            // Set gambar dan caption
                            modalImg.onload = function() {
                                loader.style.display = 'none';
                                modalImg.style.display = 'block';
                            };

                            modalImg.src = imageSrc;
                            captionText.innerHTML = caption || 'Bukti Perbaikan';

                            // Tambahkan event listener untuk menutup modal dengan tombol ESC
                            document.addEventListener('keydown', handleKeyPress);
                        }

                        // Fungsi untuk menutup modal
                        function closeModal() {
                            document.getElementById('imageModal').style.display = 'none';
                            document.removeEventListener('keydown', handleKeyPress);
                        }

                        // Fungsi untuk menangani penekanan tombol ESC
                        function handleKeyPress(e) {
                            if (e.key === 'Escape') {
                                closeModal();
                            }
                        }

                        // Tutup modal ketika mengklik di luar gambar
                        document.getElementById('imageModal').addEventListener('click', function(e) {
                            if (e.target === this) {
                                closeModal();
                            }
                        });
                    </script>
                </body>
                <script src="{{ asset('js/components.js') }}"></script>
                <script src="{{ asset('js/halaman-upload-bukti-perbaikan.js') }}"></script>
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
                </script>

                </html>

            @endif
