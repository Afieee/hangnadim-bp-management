{{-- Staff Pelaksana --}}
@if (Auth::user()->role == "Staff Pelaksana")
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/halaman-upload-bukti-perbaikan.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

</head>
<style>
        /* Modern Toast Notification */
    .toast {
        position: fixed;
        top: 20px; /* Changed from 50% to 20px from top */
        left: 50%;
        transform: translateX(-50%) scale(0.8); /* Removed Y translation */
        background-color: #fff;
        color: #333;
        padding: 20px 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        font-family: 'Segoe UI', sans-serif;
        font-size: 16px;
        z-index: 9999;
        opacity: 0;
        display: flex;
        align-items: center;
        gap: 15px;
        border-left: 5px solid #4CAF50;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        max-width: 350px;
        width: 90%;
    }

    /* Show toast with animation */
    .toast.show {
        opacity: 1;
        transform: translateX(-50%) scale(1); /* Removed Y translation */
    }

    /* Checkmark icon container */
    .toast-icon {
        width: 40px;
        height: 40px;
        background-color: #4CAF50;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
    }

    /* Checkmark animation */
    .toast-icon::before {
        content: "";
        position: absolute;
        width: 20px;
        height: 10px;
        border-left: 3px solid white;
        border-bottom: 3px solid white;
        transform: rotate(-45deg) scale(0);
        top: 12px;
        left: 8px;
        transition: transform 0.3s ease 0.2s;
    }

    .toast.show .toast-icon::before {
        transform: rotate(-45deg) scale(1);
    }

    /* Toast content */
    .toast-content {
        flex-grow: 1;
    }

    /* Toast title */
    .toast-title {
        font-weight: 600;
        margin-bottom: 5px;
        color: #222;
    }

    /* Close button */
    .toast-close {
        background: none;
        border: none;
        color: #999;
        font-size: 18px;
        cursor: pointer;
        padding: 5px;
        margin-left: 10px;
        transition: color 0.2s;
    }

    .toast-close:hover {
        color: #666;
    }

    /* Progress bar */
    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background-color: rgba(76, 175, 80, 0.2);
    }

    .toast-progress::before {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        height: 100%;
        width: 100%;
        background-color: #4CAF50;
        animation: progress 3s linear forwards;
    }



        /* Custom styles for the dashboard cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 20px;
        }
        
        .stat-content {
            flex-grow: 1;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 14px;
        }
        
        .stat-trend {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 14px;
        }
        
        .trend-up {
            color: #28a745;
        }
        
        .trend-down {
            color: #dc3545;
        }
        
        .progress-container {
            margin-top: 15px;
        }
        
        .progress-bar {
            height: 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            border-radius: 4px;
        }
        
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .chart-actions button {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        }
        
        .chart-placeholder {
            height: 300px;
            background-color: #f8f9fa;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

</style>
<x-navbar/>
<x-sidebar/>
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
                <h2>Form Bukti Perbaikan</h2>
                <form action="{{ route('bukti-perbaikan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-container">
                        <div class="form-group">
                            <label for="catatan">Catatan Perbaikan:</label>
                            <input type="text" id="catatan" name="catatan_bukti_perbaikan" class="form-control" placeholder="Masukkan catatan perbaikan" required>
                        </div>

                        <div class="form-group">
                            <label>Foto Bukti Perbaikan:</label>
                            <div class="file-input-container">
                                <label class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Klik untuk upload foto</span>
                                    <input type="file" 
                                        class="file-input" 
                                        name="file_bukti_perbaikan" 
                                        accept=".jpg,.jpeg,.png,.gif,.pdf,.webp" 
                                        required>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" id="id_kerusakan" name="id_bukti_kerusakan" class="form-control" hidden value="{{ $buktiKerusakan->id }}" readonly required>
                        </div>

                        <div class="form-group">
                            <input type="text" id="id_inspektor" name="id_user_inspektor" class="form-control" hidden value="{{ Auth::user()->id }}" readonly required>
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
                        <div class="gallery-item" onclick="openModal('{{ $perbaikan->url_foto }}', '{{ $perbaikan->catatan_bukti_perbaikan }}')">
                            @if ($perbaikan->url_foto)
                            <div class="gallery-img-container">
                                <img src="{{ $perbaikan->url_foto }}" alt="Bukti Perbaikan" class="gallery-img">
                            </div>
                            @else
                            <div class="no-image">
                                <i class="fas fa-image"></i>
                                <span>Tidak ada foto</span>
                            </div>
                            @endif
                            
                            <div class="gallery-info">
                                <p><strong>Catatan Dari Petugas:</strong> {{ $perbaikan->catatan_bukti_perbaikan }}</p>
                                <p><strong>Petugas Inspeksi:</strong> {{ $perbaikan->userInspektor->name ?? '-' }}</p>
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
        if(toast) {
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


















{{-- Kepala Seksi --}}
@elseif (Auth::user()->role == "Kepala Seksi")
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/halaman-upload-bukti-perbaikan.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

</head>
<x-navbar/>
<x-sidebar/>
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
<body>
    <!-- Content Wrapper -->
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-tools"></i> Bukti Perbaikan</li>
                </ul>
            </div>
        </div>

        <!-- Content Area -->

        <div class="content-area">
            <div class="card">
                <div class="gallery-container">
                    <h2 class="gallery-title">Data Bukti Perbaikan -  {{ $buktiKerusakan->judul_bukti_kerusakan }}</h2>
                    
                    <div class="gallery-grid">
                        @foreach ($buktiPerbaikan as $perbaikan)
                        <div class="gallery-item" onclick="openModal('{{ $perbaikan->url_foto }}', '{{ $perbaikan->catatan_bukti_perbaikan }}')">
                            @if ($perbaikan->url_foto)
                            <div class="gallery-img-container">
                                <img src="{{ $perbaikan->url_foto }}" alt="Bukti Perbaikan" class="gallery-img">
                            </div>
                            @else
                            <div class="no-image">
                                <i class="fas fa-image"></i>
                                <span>Tidak ada foto</span>
                            </div>
                            @endif
                            
                            <div class="gallery-info">
                                <p><strong>Catatan Dari Petugas:</strong> {{ $perbaikan->catatan_bukti_perbaikan }}</p>
                                <p><strong>Petugas Inspeksi:</strong> {{ $perbaikan->userInspektor->name ?? '-' }}</p>
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

</html>


@endif