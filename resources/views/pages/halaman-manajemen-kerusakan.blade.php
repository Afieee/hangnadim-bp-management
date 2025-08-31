<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kerusakan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <style>
        .content-area {
            padding: 20px;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .table-container {
            overflow-x: auto;
            border-radius: 0 0 8px 8px;
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
        }
        
        thead {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: white;
        }
        
        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #eaeaea;
        }
        
        th {
            font-weight: 600;
            color: white;
            position: sticky;
            top: 0;
        }
        
        tbody tr {
            transition: all 0.2s ease;
        }
        
        tbody tr:hover {
            background-color: #f8faff;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        tbody tr.selected {
            background-color: #e6f0ff;
            position: relative;
        }
        
        tbody tr.selected::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #4b6cb7;
        }
        
        .table-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #eaeaea;
            background-color: #fafbfc;
        }
        
        .btn {
            padding: 10px 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
            font-size: 14px;
        }
        
/* congz */
        .btn i {
            margin-right: 6px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: white;
            box-shadow: 0 2px 6px rgba(75, 108, 183, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        
        .btn-outline-primary {
            background-color: transparent;
            color: #4b6cb7;
            border: 1px solid #4b6cb7;
        }
        
        .btn-outline-primary:hover {
            background-color: #4b6cb7;
            color: white;
            transform: translateY(-2px);
        }
        
        .selected-count {
            font-weight: 500;
            color: #495057;
            font-size: 15px;
            background-color: #f0f4ff;
            padding: 8px 14px;
            border-radius: 20px;
            border: 1px dashed #4b6cb7;
        }
        
        .checkbox-cell {
            width: 50px;
            text-align: center;
        }
        
        .image-preview {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #eaeaea;
        }
        
        .image-preview:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .no-image {
            color: #6c757d;
            font-style: italic;
            font-size: 13px;
        }
        
        .date-cell {
            white-space: nowrap;
            color: #495057;
            font-size: 13px;
        }
        
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
            background-color: rgba(0,0,0,0.9);
        }
        
        .modal-content {
            display: block;
            margin: 0 auto;
            max-width: 90%;
            max-height: 80vh;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        
        .close {
            position: absolute;
            top: 20px;
            right: 40px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .close:hover {
            color: #bbb;
        }
        
        @media (max-width: 992px) {
            th, td {
                padding: 12px 14px;
            }
            
            .table-actions {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .btn {
                padding: 8px 14px;
                font-size: 13px;
            }
        }
        
        @media (max-width: 768px) {
            th, td {
                padding: 10px 12px;
                font-size: 13px;
            }
            
            .image-preview {
                width: 60px;
                height: 45px;
            }
            
            .selected-count {
                font-size: 14px;
                padding: 6px 12px;
            }
        }
        
        /* Zebra striping for better readability */
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        tbody tr:nth-child(even):hover {
            background-color: #f1f5ff;
        }
        
        tbody tr:nth-child(even).selected {
            background-color: #e0ebff;
        }
    </style>
</head>

<body>
    <x-navbar />
    <x-sidebar />
    
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

    <!-- Modal untuk gambar -->
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-calendar-check"></i> Laporan Kerusakan</li>
                </ul>
            </div>
        </div>

        <div class="content-area">
            <div class="card">
                <div class="table-actions">
                    <div style="display: flex; gap: 10px;">
                        <button id="selectAllBtn" class="btn btn-outline-primary">
                            <i class="fas fa-check-square"></i> Pilih Semua
                        </button>
                        <button id="deselectAllBtn" class="btn btn-outline-primary">
                            <i class="fas fa-times-circle"></i> Batalkan
                        </button>
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <span id="selectedCount" class="selected-count">0 data terpilih</span>
                        <button id="exportPdfBtn" class="btn btn-primary" disabled>
                            <i class="fas fa-file-pdf"></i> Ekspor ke PDF
                        </button>
                    </div>
                </div>
                
                <div class="table-container">
                    <table id="kerusakanTable">
                        <thead>
                            <tr>
                                <th class="checkbox-cell">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>ID</th>
                                <th>Nama Gedung</th>
                                <th>Judul Kerusakan</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Dilaporkan</th>
                                <th>Bukti Lampiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kerusakanList as $kerusakan)
                                <tr data-id="{{ $kerusakan->id }}">
                                    <td class="checkbox-cell">
                                        <input type="checkbox" class="row-checkbox">
                                    </td>
                                    <td>{{ $kerusakan->id }}</td>
                                    <td>{{ $kerusakan->inspeksiGedung->gedung->nama_gedung ?? '-' }}</td>
                                    <td>{{ $kerusakan->judul_bukti_kerusakan ?? '-' }}</td>
                                    <td>{{ $kerusakan->deskripsi_bukti_kerusakan ?? '-' }}</td>
                                    <td class="date-cell">
                                        @if($kerusakan->created_at)
                                            {{ \Carbon\Carbon::parse($kerusakan->created_at)->translatedFormat('d F Y, H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($kerusakan->file_bukti_kerusakan)
                                            <img src="{{ asset('storage/' . $kerusakan->file_bukti_kerusakan) }}" 
                                                 alt="Foto Kerusakan" 
                                                 class="image-preview"
                                                 data-src="{{ asset('storage/' . $kerusakan->file_bukti_kerusakan) }}">
                                        @else
                                            <span class="no-image">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/components.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi jsPDF
            window.jsPDF = window.jspdf.jsPDF;
            
            const table = document.getElementById('kerusakanTable');
            const selectAll = document.getElementById('selectAll');
            const selectAllBtn = document.getElementById('selectAllBtn');
            const deselectAllBtn = document.getElementById('deselectAllBtn');
            const exportPdfBtn = document.getElementById('exportPdfBtn');
            const selectedCount = document.getElementById('selectedCount');
            const checkboxes = document.querySelectorAll('.row-checkbox');
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const closeModal = document.querySelector('.close');
            
            let selectedRows = new Set();
            
            // Fungsi untuk memperbarui jumlah data yang dipilih
            function updateSelectedCount() {
                selectedCount.textContent = `${selectedRows.size} data terpilih`;
                exportPdfBtn.disabled = selectedRows.size === 0;
            }
            
            // Toggle pilih semua
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                    const row = checkbox.closest('tr');
                    const id = row.getAttribute('data-id');
                    
                    if (this.checked) {
                        selectedRows.add(id);
                        row.classList.add('selected');
                    } else {
                        selectedRows.delete(id);
                        row.classList.remove('selected');
                    }
                });
                updateSelectedCount();
            });
            
            // Tombol pilih semua
            selectAllBtn.addEventListener('click', function() {
                selectAll.checked = true;
                selectAll.dispatchEvent(new Event('change'));
            });
            
            // Tombol batalkan pilihan
            deselectAllBtn.addEventListener('click', function() {
                selectAll.checked = false;
                selectAll.dispatchEvent(new Event('change'));
            });
            
            // Toggle pilih per baris
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const row = this.closest('tr');
                    const id = row.getAttribute('data-id');
                    
                    if (this.checked) {
                        selectedRows.add(id);
                        row.classList.add('selected');
                    } else {
                        selectedRows.delete(id);
                        row.classList.remove('selected');
                        selectAll.checked = false;
                    }
                    
                    // Periksa apakah semua checkbox terpilih
                    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                    selectAll.checked = allChecked;
                    
                    updateSelectedCount();
                });
            });
            
            // Fungsi untuk mengonversi gambar ke base64
            function getBase64Image(img) {
                return new Promise((resolve, reject) => {
                    // Buat canvas
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    
                    // Set ukuran canvas sesuai dengan gambar
                    canvas.width = img.naturalWidth;
                    canvas.height = img.naturalHeight;
                    
                    // Gambar gambar ke canvas
                    ctx.drawImage(img, 0, 0);
                    
                    // Dapatkan data base64
                    try {
                        const dataURL = canvas.toDataURL('image/jpeg', 0.8);
                        resolve(dataURL);
                    } catch (e) {
                        reject(e);
                    }
                });
            }
            
            // Format tanggal untuk PDF
            function formatDateForPdf(dateString) {
                if (!dateString || dateString === '-') return '-';
                
                try {
                    const date = new Date(dateString);
                    return date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                } catch (e) {
                    return dateString;
                }
            }
            
            // Ekspor ke PDF
            exportPdfBtn.addEventListener('click', async function() {
                // Tampilkan loading
                exportPdfBtn.disabled = true;
                const originalText = exportPdfBtn.innerHTML;
                exportPdfBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                
                try {
                    // Siapkan data yang dipilih
                    const selectedData = [];
                    const headers = ['ID', 'Nama Gedung', 'Judul Kerusakan', 'Deskripsi', 'Tanggal Dilaporkan', 'Gambar Bukti'];
                    
                    // Kumpulkan semua gambar yang perlu diproses
                    const imagePromises = [];
                    const rowImages = [];
                    
                    document.querySelectorAll('tr[data-id]').forEach(row => {
                        const id = row.getAttribute('data-id');
                        if (selectedRows.has(id)) {
                            const cells = row.querySelectorAll('td');
                            const imgElement = row.querySelector('img');
                            
                            // Lewati sel checkbox (indeks 0)
                            const rowData = {
                                id: cells[1].textContent,
                                gedung: cells[2].textContent,
                                judul: cells[3].textContent,
                                deskripsi: cells[4].textContent,
                                tanggal: cells[5].textContent,
                                hasImage: imgElement !== null
                            };
                            
                            if (imgElement) {
                                // Tambahkan promise untuk konversi gambar
                                imagePromises.push(
                                    getBase64Image(imgElement).then(base64 => {
                                        rowImages.push({
                                            id: id,
                                            base64: base64
                                        });
                                    })
                                );
                            } else {
                                rowImages.push({
                                    id: id,
                                    base64: null
                                });
                            }
                            
                            selectedData.push(rowData);
                        }
                    });
                    
                    // Tunggu semua gambar selesai diproses
                    await Promise.all(imagePromises);
                    
                    // Buat dokumen PDF
                    const doc = new jsPDF();
                    
                    // Judul laporan
                    const title = "LAPORAN KERUSAKAN GEDUNG";
                    doc.setFontSize(18);
                    doc.setTextColor(41, 128, 185);
                    doc.text(title, 105, 20, { align: 'center' });
                    
                    // Garis pemisah
                    doc.setDrawColor(200, 200, 200);
                    doc.line(14, 25, 196, 25);
                    
                    // Tanggal ekspor
                    const exportDate = new Date().toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    
                    doc.setFontSize(10);
                    doc.setTextColor(100, 100, 100);
                    doc.text(`Diekspor pada: ${exportDate}`, 14, 35);
                    
                    // Siapkan data untuk tabel
                    const tableData = selectedData.map(row => [
                        row.id,
                        row.gedung,
                        row.judul,
                        row.deskripsi.length > 50 ? row.deskripsi.substring(0, 50) + '...' : row.deskripsi,
                        formatDateForPdf(row.tanggal),
                        row.hasImage ? "Tersedia" : "Tidak tersedia"
                    ]);
                    
                    // Buat tabel
                    doc.setFontSize(11);
                    doc.setTextColor(0, 0, 0);
                    
                    // Buat tabel utama
                    doc.autoTable({
                        head: [headers],
                        body: tableData,
                        startY: 45,
                        theme: 'grid',
                        styles: {
                            fontSize: 10,
                            cellPadding: 4,
                            overflow: 'linebreak',
                            lineColor: [220, 220, 220]
                        },
                        headStyles: {
                            fillColor: [75, 108, 183],
                            textColor: 255,
                            fontStyle: 'bold',
                            fontSize: 11
                        },
                        alternateRowStyles: {
                            fillColor: [245, 247, 250]
                        },
                        margin: { top: 45 },
                        // Tambahkan gambar setelah tabel
                        didDrawPage: function(data) {
                            // Jika ini halaman terakhir, tambahkan gambar
                            if (data.pageCount === data.pageNumber) {
                                let yPosition = data.cursor.y + 15;
                                
                                selectedData.forEach((row, index) => {
                                    if (row.hasImage) {
                                        const imageInfo = rowImages.find(img => img.id === row.id);
                                        if (imageInfo && imageInfo.base64) {
                                            // Tambahkan judul untuk gambar
                                            if (yPosition > 200) {
                                                doc.addPage();
                                                yPosition = 20;
                                            }
                                            
                                            doc.setFontSize(12);
                                            doc.setTextColor(75, 108, 183);
                                            doc.text(`Bukti Kerusakan - ID: ${row.id} - ${row.judul}`, 14, yPosition);
                                            yPosition += 8;
                                            
                                            // Tambahkan gambar (maksimal lebar 120, tinggi 90)
                                            doc.addImage(imageInfo.base64, 'JPEG', 14, yPosition, 120, 90);
                                            yPosition += 100;
                                        }
                                    }
                                });
                            }
                        }
                    });
                    
                    // Simpan PDF
                    doc.save('laporan-kerusakan-gedung.pdf');
                    
                } catch (error) {
                    console.error('Error generating PDF:', error);
                    alert('Terjadi kesalahan saat membuat PDF. Silakan coba lagi.');
                } finally {
                    // Kembalikan tombol ke keadaan semula
                    exportPdfBtn.disabled = selectedRows.size === 0;
                    exportPdfBtn.innerHTML = originalText;
                }
            });
            
            // Tambahkan event listener untuk memilih baris dengan mengklik di mana saja pada baris
            document.querySelectorAll('tbody tr').forEach(row => {
                row.addEventListener('click', function(e) {
                    // Jangan aktifkan jika yang diklik adalah checkbox
                    if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'LABEL') {
                        const checkbox = this.querySelector('.row-checkbox');
                        checkbox.checked = !checkbox.checked;
                        checkbox.dispatchEvent(new Event('change'));
                    }
                });
            });
            
            // Modal untuk gambar
            document.querySelectorAll('.image-preview').forEach(img => {
                img.addEventListener('click', function() {
                    modal.style.display = 'block';
                    modalImg.src = this.getAttribute('data-src');
                });
            });
            
            closeModal.addEventListener('click', function() {
                modal.style.display = 'none';
            });
            
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>