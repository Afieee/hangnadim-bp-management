<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard - Detail Inspeksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --danger: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fb;
            color: #333;
            line-height: 1.6;
        }
        
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease;
            min-height: 100vh;
            padding-bottom: 60px;
        }
        
        .breadcrumb-container {
            background: white;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .breadcrumb ul {
            display: flex;
            list-style: none;
            flex-wrap: wrap;
        }
        
        .breadcrumb li {
            margin-right: 10px;
            display: flex;
            align-items: center;
        }
        
        .breadcrumb li:not(:last-child):after {
            content: '/';
            margin-left: 10px;
            color: var(--gray);
        }
        
        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
        }
        
        .breadcrumb .active {
            color: var(--gray);
        }
        
        .content-area {
            margin-top: 20px;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin-bottom: 25px;
        }
        
        h1 {
            font-size: 28px;
            color: var(--dark);
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        h2 {
            font-size: 20px;
            color: var(--dark);
            margin-bottom: 15px;
            font-weight: 600;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .info-item {
            background: var(--light);
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid var(--primary);
        }
        
        .info-item strong {
            display: block;
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .info-item p {
            font-size: 16px;
            color: var(--dark);
        }
        
        .status-selector {
            margin: 20px 0;
        }
        
        .status-item {
            margin-bottom: 15px;
        }
        
        .status-item label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .status-item select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            background: white;
            font-size: 14px;
            color: var(--dark);
            transition: all 0.3s;
        }
        
        .status-item select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }
        
        .form-container {
            background: var(--light);
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
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
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }
        
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--secondary);
        }
        
        .btn-secondary {
            background: var(--light-gray);
            color: var(--dark);
        }
        
        .btn-secondary:hover {
            background: #dcdcdc;
        }
        
        .gallery-container {
            margin: 30px 0;
        }
        
        .gallery-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .gallery-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .gallery-image {
            height: 180px;
            overflow: hidden;
            position: relative;
        }
        
        .gallery-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .gallery-item:hover .gallery-image img {
            transform: scale(1.05);
        }
        
        .file-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            background: var(--light);
            font-size: 48px;
            color: var(--primary);
        }
        
        .gallery-content {
            padding: 15px;
        }
        
        .gallery-content h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: var(--dark);
        }
        
        .gallery-content p {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .gallery-meta {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--gray);
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }
        
        .modal-content {
            background: white;
            max-width: 800px;
            margin: 40px auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h3 {
            font-size: 22px;
            color: var(--dark);
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--gray);
        }
        
        .modal-body {
            padding: 25px;
        }
        
        .modal-image {
            margin-bottom: 20px;
            text-align: center;
        }
        
        .modal-image img {
            max-width: 100%;
            max-height: 400px;
            border-radius: 8px;
        }
        
        .modal-details {
            margin-bottom: 25px;
        }
        
        .modal-detail-item {
            margin-bottom: 15px;
        }
        
        .modal-detail-item strong {
            display: block;
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .modal-detail-item p {
            font-size: 16px;
            color: var(--dark);
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }
        
        .no-evidence {
            text-align: center;
            padding: 40px;
            color: var(--gray);
        }
        
        .no-evidence i {
            font-size: 48px;
            margin-bottom: 15px;
            color: var(--light-gray);
        }
        
        @media (max-width: 992px) {
            .content-wrapper {
                margin-left: 0;
                padding: 15px;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
            
            .modal-content {
                margin: 20px auto;
            }
        }
    </style>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="/dashboard"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-eye"></i> Penjadwalan Inspeksi</li>
                    <li class="active">
                        <i class="fas fa-eye"></i> 
                        Inspeksi {{ $inspeksi->gedung->nama_gedung ?? '-' }} - 
                        {{ \Carbon\Carbon::parse($inspeksi->created_at)->format('F Y') }}, 
                        Minggu ke-{{ \Carbon\Carbon::parse($inspeksi->created_at)->weekOfMonth }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div class="card">
                <h1>Detail Inspeksi</h1>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif
                
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nama Gedung</strong>
                        <p>{{ $inspeksi->gedung->nama_gedung ?? '-' }}</p>
                    </div>
                    
                    <div class="info-item">
                        <strong>Petugas Inspeksi</strong>
                        <p>{{ $inspeksi->user->name ?? '-' }}</p>
                    </div>
                    
                    <div class="info-item">
                        <strong>Email Petugas</strong>
                        <p>{{ $inspeksi->user->email ?? '-' }}</p>
                    </div>
                    
                    <div class="info-item">
                        <strong>ID Inspeksi</strong>
                        <p>#{{ $inspeksi->id }}</p>
                    </div>
                    
                    <div class="info-item">
                        <strong>Tanggal Inspeksi</strong>
                        <p>{{ \Carbon\Carbon::parse($inspeksi->created_at)->format('d F Y, H:i') }}</p>
                    </div>
                    
                    <div class="info-item">
                        <strong>Status Keseluruhan</strong>
                        <p>{{ $inspeksi->status_keseluruhan_inspeksi ?? 'Belum Diperiksa' }}</p>
                    </div>
                </div>
                
                <h2>Status Komponen</h2>
                
                <div class="status-selector">
                    <div class="status-item">
                        <label for="furniture">Furniture</label>
                        <select name="furniture" id="furniture" class="form-control">
                            <option>Belum Diperiksa</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>
                    
                    <div class="status-item">
                        <label for="fire_system">Fire System</label>
                        <select name="fire_system" id="fire_system" class="form-control">
                            <option>Belum Diperiksa</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>
                    
                    <div class="status-item">
                        <label for="bangunan">Bangunan</label>
                        <select name="bangunan" id="bangunan" class="form-control">
                            <option>Belum Diperiksa</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>
                    
                    <div class="status-item">
                        <label for="mekanikal_elektrikal">Mekanikal Elektrikal</label>
                        <select name="mekanikal_elektrikal" id="mekanikal_elektrikal" class="form-control">
                            <option>Belum Diperiksa</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>
                    
                    <div class="status-item">
                        <label for="it">IT</label>
                        <select name="it" id="it" class="form-control">
                            <option>Belum Diperiksa</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>
                </div>
                
                <h2>Tambah Bukti Kerusakan</h2>
                
                <div class="form-container">
                    <form action="{{ route('bukti-kerusakan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="judul_bukti_kerusakan">Judul Bukti Kerusakan</label>
                            <input type="text" name="judul_bukti_kerusakan" id="judul_bukti_kerusakan" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="deskripsi_bukti_kerusakan">Deskripsi Bukti Kerusakan</label>
                            <textarea name="deskripsi_bukti_kerusakan" id="deskripsi_bukti_kerusakan" class="form-control" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="tipe_kerusakan">Tipe Kerusakan</label>
                            <select name="tipe_kerusakan" id="tipe_kerusakan" class="form-control">
                                <option value="Furniture">Furniture</option>
                                <option value="Fire System">Fire System</option>
                                <option value="Bangunan">Bangunan</option>
                                <option value="Mekanikal Elektrikal">Mekanikal Elektrikal</option>
                                <option value="IT">IT</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="file_bukti_kerusakan">File Bukti Kerusakan</label>
                            <input type="file" name="file_bukti_kerusakan" id="file_bukti_kerusakan" class="form-control">
                        </div>
                        
                        <input type="hidden" name="id_inspeksi_gedung" value="{{ $inspeksi->id }}">
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Bukti Kerusakan
                        </button>
                    </form>
                </div>
                
                <div class="gallery-container">
                    <div class="gallery-title">
                        <h2>Bukti Kerusakan</h2>
                        <span class="badge">{{ count($buktiKerusakans) }} Item</span>
                    </div>
                    
                    @if(count($buktiKerusakans) > 0)
                        <div class="gallery-grid" id="evidence-gallery">
                            @foreach ($buktiKerusakans as $buktiKerusakan)
                                <div class="gallery-item" data-id="{{ $buktiKerusakan->id }}">
                                    <div class="gallery-image">
                                        @if ($buktiKerusakan->file_bukti_kerusakan)
                                            @if(pathinfo($buktiKerusakan->file_bukti_kerusakan, PATHINFO_EXTENSION) === 'pdf')
                                                <div class="file-icon">
                                                    <i class="fas fa-file-pdf"></i>
                                                </div>
                                            @else
                                                <img src="{{ asset('storage/' . $buktiKerusakan->file_bukti_kerusakan) }}" alt="{{ $buktiKerusakan->judul_bukti_kerusakan }}">
                                            @endif
                                        @else
                                            <div class="file-icon">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="gallery-content">
                                        <h3>{{ $buktiKerusakan->judul_bukti_kerusakan }}</h3>
                                        <p>{{ $buktiKerusakan->deskripsi_bukti_kerusakan }}</p>
                                        <div class="gallery-meta">
                                            <span>{{ $buktiKerusakan->tipe_kerusakan }}</span>
                                            <span>{{ \Carbon\Carbon::parse($buktiKerusakan->created_at)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-evidence">
                            <i class="fas fa-folder-open"></i>
                            <p>Belum ada bukti kerusakan yang dilaporkan</p>
                        </div>
                    @endif
                </div>
                
                <div class="action-buttons">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Modal for evidence details -->
        <div class="modal" id="evidenceModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">Detail Bukti Kerusakan</h3>
                    <button class="close-modal" id="closeModal">&times;</button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Content will be loaded via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <x-footer />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/components.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // Open modal when gallery item is clicked
            $('.gallery-item').on('click', function() {
                const id = $(this).data('id');
                loadEvidenceDetails(id);
            });
            
            // Close modal when X is clicked
            $('#closeModal').on('click', function() {
                $('#evidenceModal').hide();
            });
            
            // Close modal when clicking outside the content
            $(window).on('click', function(event) {
                if ($(event.target).is('#evidenceModal')) {
                    $('#evidenceModal').hide();
                }
            });
            
            // Function to load evidence details via AJAX
            function loadEvidenceDetails(id) {
                // In a real application, you would fetch this data from your server
                // For demonstration, we'll use the data from the gallery items
                
                const item = $(`[data-id="${id}"]`);
                const title = item.find('h3').text();
                const description = item.find('p').text();
                const type = item.find('.gallery-meta span:first-child').text();
                const date = item.find('.gallery-meta span:last-child').text();
                const imageSrc = item.find('img').attr('src');
                const hasImage = imageSrc !== undefined;
                
                let modalContent = `
                    <div class="modal-image">
                        ${hasImage ? 
                            `<img src="${imageSrc}" alt="${title}">` : 
                            `<div class="file-icon"><i class="fas fa-file-pdf"></i></div>`
                        }
                    </div>
                    <div class="modal-details">
                        <div class="modal-detail-item">
                            <strong>Judul</strong>
                            <p>${title}</p>
                        </div>
                        <div class="modal-detail-item">
                            <strong>Deskripsi</strong>
                            <p>${description}</p>
                        </div>
                        <div class="modal-detail-item">
                            <strong>Tipe Kerusakan</strong>
                            <p>${type}</p>
                        </div>
                        <div class="modal-detail-item">
                            <strong>Tanggal Dilaporkan</strong>
                            <p>${date}</p>
                        </div>
                    </div>
                    <div class="action-buttons">
                        ${hasImage ? 
                            `<a href="${imageSrc}" target="_blank" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Buka Gambar</a>` : 
                            `<a href="${imageSrc}" target="_blank" class="btn btn-primary"><i class="fas fa-download"></i> Unduh Dokumen</a>`
                        }
                    </div>
                `;
                
                $('#modalTitle').text(title);
                $('#modalBody').html(modalContent);
                $('#evidenceModal').show();
            }
        });
    </script>
</body>
</html>