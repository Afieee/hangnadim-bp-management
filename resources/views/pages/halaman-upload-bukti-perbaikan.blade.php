<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard - Bukti Perbaikan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            color: #333;
            line-height: 1.6;
        }
        
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
            transition: var(--transition);
        }
        
        .breadcrumb-container {
        }
        
        .breadcrumb ul {
            display: flex;
            list-style: none;
        }
        
        .breadcrumb li {
            margin-right: 10px;
            font-size: 14px;
            color: var(--gray);
        }
        
        .breadcrumb li:not(:last-child):after {
            content: "/";
            margin-left: 10px;
            color: var(--light-gray);
        }
        
        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .breadcrumb a:hover {
            color: var(--secondary);
        }
        
        .content-area {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-bottom: 20px;
        }
        
        .card h2 {
            margin-bottom: 20px;
            color: var(--dark);
            font-weight: 600;
            border-bottom: 2px solid var(--light-gray);
            padding-bottom: 10px;
        }
        
        .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        @media (max-width: 992px) {
            .form-container {
                grid-template-columns: 1fr;
            }
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }
        
        .gallery-container {
            margin-top: 30px;
        }
        
        .gallery-title {
            margin-bottom: 20px;
            color: var(--dark);
            font-weight: 600;
            border-bottom: 2px solid var(--light-gray);
            padding-bottom: 10px;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        
        .gallery-item {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            cursor: pointer;
        }
        
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .gallery-img-container {
            position: relative;
            overflow: hidden;
            height: 200px;
        }
        
        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .gallery-item:hover .gallery-img {
            transform: scale(1.05);
        }
        
        .gallery-info {
            padding: 15px;
        }
        
        .gallery-info p {
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .gallery-info strong {
            color: var(--dark);
        }
        
        .no-image {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px;
            background: var(--light-gray);
            color: var(--gray);
        }
        
        .file-input-container {
            position: relative;
        }
        
        .file-input-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            border: 2px dashed var(--light-gray);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .file-input-label:hover {
            border-color: var(--primary);
        }
        
        .file-input-label i {
            font-size: 32px;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .file-input-label span {
            color: var(--gray);
        }
        
        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        /* Modal untuk gambar yang diperbesar */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.9);
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            display: block;
            margin: 0 auto;
            max-width: 90%;
            max-height: 80vh;
            border-radius: 8px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
        }
        
        .modal-caption {
            margin: 15px auto;
            width: 80%;
            text-align: center;
            color: #fff;
            font-size: 16px;
        }
        
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .close:hover {
            color: var(--success);
        }
        
        /* Loading spinner */
        .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
    </style>
</head>
<x-navbar/>
<x-sidebar/>
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
                                    <input type="file" class="file-input" name="file_bukti_perbaikan" accept="image/*" required>
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
</html>