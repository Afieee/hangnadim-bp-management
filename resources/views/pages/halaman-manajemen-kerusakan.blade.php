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
        /* CSS yang sudah ada tetap dipertahankan */
        .content-area {
            padding: 20px;
        }
        
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
        }
        
        .table-container {
            overflow-x: auto;
            border-radius: 0 0 8px 8px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        thead {
            background-color: #4b6cb7;
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
            transition: background-color 0.2s ease;
        }
        
        tbody tr:hover {
            background-color: #f5f7ff;
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
        
        .btn i {
            margin-right: 6px;
        }
        
        .btn-primary {
            background-color: #4b6cb7;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #3a5a9f;
        }
        
        .btn-outline-primary {
            background-color: transparent;
            color: #4b6cb7;
            border: 1px solid #4b6cb7;
        }
        
        .btn-outline-primary:hover {
            background-color: #f0f4ff;
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
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
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
        
        .description-cell {
            max-width: 300px;
            overflow: hidden;
            white-space: normal;
            word-wrap: break-word;
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
            
            .description-cell {
                max-width: 200px;
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
            
            .description-cell {
                max-width: 150px;
            }
        }
        
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
                <div class="container">
                    <h2 style="margin: 20px">Laporan Kerusakan Parah</h2>

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
                                    <th>Objek Kerusakan</th>
                                    <th>Gedung Lokasi Kerusakan</th>
                                    <th>Catatan Petugas</th>
                                    <th>Tipe Kerusakan</th>
                                    <th>Tanggal Dilaporkan</th>
                                    <th>Petugas Pelapor</th>
                                    <th>Email Petugas</th>
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
                                        <td>{{ $kerusakan->judul_bukti_kerusakan ?? '-' }}</td>

                                        <td>
                                            @php
                                                $gedungInspeksi = $kerusakan->inspeksiGedung->gedung->nama_gedung ?? null;
                                                $gedungLangsung = $kerusakan->gedung->nama_gedung ?? null;
                                            @endphp

                                            {{ implode(' / ', array_filter([$gedungInspeksi, $gedungLangsung])) ?: '-' }}
                                        </td>
                                        <td class="description-cell">
                                            {{ $kerusakan->deskripsi_bukti_kerusakan ?? '-' }}
                                        </td>

                                        <td>{{ $kerusakan->tipe_kerusakan }}</td>

                                        <td class="date-cell">
                                            @if($kerusakan->created_at)
                                                {{ \Carbon\Carbon::parse($kerusakan->created_at)->translatedFormat('d F Y, H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $kerusakan->userInspektor->name }}</td>
                                        <td>{{ $kerusakan->userInspektor->email }}</td>

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
            
            // Fungsi untuk mengonversi logo BP ke base64
            function getLogoBase64() {
                return new Promise((resolve, reject) => {
                    const logoImg = new Image();
                    logoImg.crossOrigin = "Anonymous";
                    logoImg.src = "{{ asset('/storage/images/logo_bp.png') }}";
                    
                    logoImg.onload = function() {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');
                        
                        // Set ukuran canvas sesuai dengan gambar
                        canvas.width = logoImg.width;
                        canvas.height = logoImg.height;
                        
                        // Gambar gambar ke canvas
                        ctx.drawImage(logoImg, 0, 0);
                        
                        // Dapatkan data base64
                        try {
                            const dataURL = canvas.toDataURL('image/png');
                            resolve(dataURL);
                        } catch (e) {
                            reject(e);
                        }
                    };
                    
                    logoImg.onerror = function() {
                        reject(new Error('Gagal memuat logo'));
                    };
                });
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
                    const headers = ['ID', 'Objek Kerusakan', 'Gedung', 'Catatan Petugas', 'Tipe Kerusakan', 'Tanggal Dilaporkan', 'Petugas'];
                    
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
                                objek: cells[2].textContent,
                                gedung: cells[3].textContent,
                                catatan: cells[4].textContent,
                                tipe: cells[5].textContent,
                                tanggal: cells[6].textContent,
                                petugas: cells[7].textContent,
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
                    
                    // Dapatkan base64 logo BP
                    const logoBase64 = await getLogoBase64();
                    
                    // Buat dokumen PDF
                    const doc = new jsPDF();
                    
                    // Tambahkan Times New Roman font
                    doc.setFont("Times", "normal");
                    
                    // Tambahkan logo BP di pojok kiri atas
                    doc.addImage(logoBase64, 'PNG', 14, 10, 30, 30);
                    
                    // Judul laporan
                    const title = "LAPORAN KERUSAKAN INSPEKSI";
                    doc.setFontSize(16); // Diperkecil dari 18
                    doc.setTextColor(0, 0, 0);
                    doc.text(title, 105, 20, { align: 'center' });
                    
                    // Informasi instansi di bawah judul
                    doc.setFontSize(10); // Diperkecil dari 12
                    doc.setTextColor(0, 0, 0);
                    doc.text("DIREKTORAT PENGELOLAAN KAWASAN BANDARA", 105, 27, { align: 'center' });
                    doc.setFontSize(9); // Diperkecil dari 10
                    doc.text("AERO-CITY", 105, 32, { align: 'center' });
                    
                    // Garis pemisah
                    doc.setDrawColor(0, 0, 0);
                    doc.line(14, 40, 196, 40); // Dipindah lebih atas
                    
                    // Tanggal ekspor
                    const exportDate = new Date().toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    
                    doc.setFontSize(8); // Diperkecil dari 10
                    doc.setTextColor(0, 0, 0);
                    doc.text(`Dicetak pada: ${exportDate}`, 34, 57);
                    
                    // Siapkan data untuk tabel
                    const tableData = selectedData.map(row => [
                        row.id,
                        {content: row.objek, styles: {cellWidth: 25}},
                        {content: row.gedung, styles: {cellWidth: 25}},
                        {content: row.catatan, styles: {cellWidth: 40, valign: 'top'}},
                        {content: row.tipe, styles: {cellWidth: 20}},
                        {content: formatDateForPdf(row.tanggal), styles: {cellWidth: 30}},
                        {content: row.petugas, styles: {cellWidth: 30}}
                    ]);
                    
                    // Buat tabel
                    doc.setFontSize(9); // Diperkecil dari 11
                    
                    // Buat tabel utama
                    const tableOptions = {
                        head: [headers],
                        body: tableData,
                        startY: 45, // Dipindah lebih atas
                        theme: 'grid',
                        styles: {
                            font: "Times",
                            fontStyle: "normal",
                            fontSize: 8, // Diperkecil dari 10
                            cellPadding: 3, // Diperkecil dari 4
                            overflow: 'linebreak',
                            lineColor: [0, 0, 0],
                            textColor: [0, 0, 0],
                            valign: 'top', // Pastikan align top
                            halign: 'left' // Pastikan align left
                        },
                        headStyles: {
                            fillColor: [75, 108, 183],
                            textColor: 255,
                            fontStyle: 'bold',
                            fontSize: 9, // Diperkecil dari 11
                            halign: 'left',
                            valign: 'middle'
                        },
                        bodyStyles: {
                            halign: 'left',
                            valign: 'top' // Pastikan align top untuk body
                        },
                        alternateRowStyles: {
                            fillColor: [245, 247, 250],
                            halign: 'left',
                            valign: 'top'
                        },
                        columnStyles: {
                            0: {cellWidth: 15, valign: 'top'},
                            1: {cellWidth: 25, valign: 'top'},
                            2: {cellWidth: 25, valign: 'top'},
                            3: {cellWidth: 40, valign: 'top'},
                            4: {cellWidth: 20, valign: 'top'},
                            5: {cellWidth: 30, valign: 'top'},
                            6: {cellWidth: 30, valign: 'top'}
                        },
                        margin: { top: 45 },
                        pageBreak: 'auto',
                        tableWidth: 'wrap'
                    };
                    
                    // Generate tabel
                    doc.autoTable(tableOptions);
                    
                    // Tambahkan gambar setelah tabel selesai
                    let yPosition = doc.lastAutoTable.finalY + 10;
                    
                    // Hanya tambahkan gambar jika ada gambar yang tersedia
                    if (selectedData.some(row => row.hasImage)) {
                        // Cek jika perlu halaman baru untuk bagian gambar
                        if (yPosition > 160) {
                            doc.addPage();
                            yPosition = 20;
                        }
                        
                        // Judul bagian gambar
                        doc.setFontSize(12); // Diperkecil dari 14
                        doc.setTextColor(0, 0, 0);
                        doc.text("BUKTI FOTO KERUSAKAN", 105, yPosition, { align: 'center' });
                        yPosition += 8;
                        
                        // Loop untuk setiap data yang dipilih
                        for (let i = 0; i < selectedData.length; i++) {
                            const row = selectedData[i];
                            if (row.hasImage) {
                                const imageInfo = rowImages.find(img => img.id === row.id);
                                if (imageInfo && imageInfo.base64) {
                                    // Cek jika perlu halaman baru
                                    if (yPosition > 120) {
                                        doc.addPage();
                                        yPosition = 20;
                                    }
                                    
                                    // Tambahkan judul untuk gambar
                                    doc.setFontSize(9);
                                    doc.setTextColor(0, 0, 0);
                                    doc.text(`Kasus ID: ${row.id} - ${row.objek}`, 14, yPosition);
                                    yPosition += 6;
                                    
                                    // Tambahkan gambar (diperkecil dari 120x90 menjadi 100x75)
                                    try {
                                        doc.addImage(imageInfo.base64, 'JPEG', 14, yPosition, 100, 75);
                                    } catch (e) {
                                        console.error("Error adding image to PDF:", e);
                                        doc.text("Gagal memuat gambar", 14, yPosition + 35);
                                    }
                                    yPosition += 80;
                                    
                                    // Tambahkan garis pemisah antar gambar
                                    if (i < selectedData.length - 1) {
                                        doc.setDrawColor(200, 200, 200);
                                        doc.line(14, yPosition, 196, yPosition);
                                        yPosition += 10;
                                    }
                                }
                            }
                        }
                    }
                    
                    // Dapatkan posisi akhir dokumen
                    const finalY = doc.lastAutoTable ? doc.lastAutoTable.finalY : yPosition;
                    
                    // Tambahkan halaman baru jika posisi akhir terlalu tinggi untuk tanda tangan
                    if (finalY > 200) {
                        doc.addPage();
                    }
                    
                    // Tambahkan bagian tanda tangan di akhir dokumen
                    doc.setFontSize(10);
                    doc.setTextColor(0, 0, 0);
                    
                    // Hitung posisi untuk tanda tangan (di pojok kanan)
                    const signatureY = doc.lastAutoTable ? doc.lastAutoTable.finalY + 30 : 160;
                    const signatureX = 140; // Posisi di sebelah kanan
                    
                    // Garis untuk tanda tangan
                    doc.setDrawColor(0, 0, 0);
                    doc.line(signatureX, signatureY, signatureX + 50, signatureY);
                    
                    // Teks "Mengetahui,"
                    doc.text("Mengetahui,", signatureX + 25, signatureY + 10, { align: 'center' });
                    
                    // Teks "Direktur" atau jabatan lainnya
                    doc.setFontSize(10);
                    doc.setFont(undefined, 'bold');
                    doc.text("Subjek Diubah", signatureX + 25, signatureY + 25, { align: 'center' });
                    
                    // Teks "Aero-City"
                    doc.setFont(undefined, 'normal');
                    doc.text("Akan Diisi", signatureX + 25, signatureY + 35, { align: 'center' });
                    
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