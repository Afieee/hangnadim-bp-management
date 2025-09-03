<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Laporan Kerusakan</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png"/>
    <link rel="stylesheet" href="{{ asset('css/components.css') }}"/>

    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- jsPDF autotable (tidak kita pakai untuk layout kartu, tapi boleh dibiarkan) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <style>
        /* --- UI existing styles (dipertahankan & sedikit rapikan) --- */
        .content-area { padding: 20px; }
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; margin-bottom:20px; border:1px solid #e0e0e0;}
        .table-container { overflow-x:auto; border-radius:0 0 8px 8px; }
        table { width:100%; border-collapse:collapse; font-size:14px; }
        thead { background-color:#4b6cb7; color:white; }
        th, td { padding:14px 16px; text-align:left; border-bottom:1px solid #eaeaea; }
        th { font-weight:600; color:white; position: sticky; top:0; }
        tbody tr:hover { background-color:#f5f7ff; }
        .image-preview { width:80px; height:60px; object-fit:cover; border-radius:6px; cursor:pointer; transition:all .3s; box-shadow:0 2px 6px rgba(0,0,0,.1); border:1px solid #eaeaea;}
        .modal { display:none; position:fixed; z-index:1000; padding-top:50px; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,.9); }
        .modal-content { display:block; margin:0 auto; max-width:90%; max-height:80vh; border-radius:8px; }
        .close { position:absolute; top:20px; right:40px; color:#f1f1f1; font-size:40px; font-weight:bold; cursor:pointer; transition:color .2s; }
        .close:hover { color:#bbb; }
        .table-actions { display:flex; justify-content:space-between; align-items:center; padding:18px 24px; border-bottom:1px solid #eaeaea; background-color:#fafbfc; }
        .btn { padding:10px 18px; border-radius:6px; border:none; cursor:pointer; font-weight:500; display:inline-flex; align-items:center; transition:all .2s; font-size:14px; }
        .btn-primary { background-color:#4b6cb7; color:white; }
        .btn-outline-primary { background-color:transparent; color:#4b6cb7; border:1px solid #4b6cb7; }
        .selected-count { font-weight:500; color:#495057; font-size:15px; background-color:#f0f4ff; padding:8px 14px; border-radius:20px; border:1px dashed #4b6cb7; }

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
        <div class="toast-icon"><i class="fas fa-check" style="color:white; display:none"></i></div>
        <div class="toast-content">
            <div class="toast-title">Success!</div>
            <div class="toast-message">{{ session('success') }}</div>
        </div>
        <button class="toast-close">&times;</button>
        <div class="toast-progress"></div>
    </div>
    @endif

    <!-- Modal gambar -->
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage" alt="Preview Gambar"/>
    </div>

    <div class="content-wrapper">
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
                    <h2 style="margin:20px">Laporan Kerusakan Parah</h2>

                    <div class="table-actions">
                        <div style="display:flex; gap:10px;">
                            <button id="selectAllBtn" class="btn btn-outline-primary"><i class="fas fa-check-square"></i> Pilih Semua</button>
                            <button id="deselectAllBtn" class="btn btn-outline-primary"><i class="fas fa-times-circle"></i> Batalkan</button>
                        </div>

                        <div style="display:flex; align-items:center; gap:15px;">
                            <span id="selectedCount" class="selected-count">0 data terpilih</span>
                            <button id="exportPdfBtn" class="btn btn-primary" disabled><i class="fas fa-file-pdf"></i> Ekspor ke PDF</button>
                        </div>
                    </div>

                    <div class="table-container">
                        <table id="kerusakanTable">
                            <thead>
                                <tr>
                                    <th class="checkbox-cell"><input type="checkbox" id="selectAll"></th>
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
                                    <td class="checkbox-cell"><input type="checkbox" class="row-checkbox"></td>
                                    <td>{{ $kerusakan->id }}</td>
                                    <td>{{ $kerusakan->judul_bukti_kerusakan ?? '-' }}</td>

                                    <td>
                                        @php
                                            $gedungInspeksi = $kerusakan->inspeksiGedung->gedung->nama_gedung ?? null;
                                            $gedungLangsung = $kerusakan->gedung->nama_gedung ?? null;
                                        @endphp
                                        {{ implode(' / ', array_filter([$gedungInspeksi, $gedungLangsung])) ?: '-' }}
                                    </td>

                                    <td class="description-cell">{{ $kerusakan->deskripsi_bukti_kerusakan ?? '-' }}</td>
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
        // jsPDF init
        window.jsPDF = window.jspdf.jsPDF;

        const selectAll = document.getElementById('selectAll');
        const selectAllBtn = document.getElementById('selectAllBtn');
        const deselectAllBtn = document.getElementById('deselectAllBtn');
        const exportPdfBtn = document.getElementById('exportPdfBtn');
        const selectedCount = document.getElementById('selectedCount');
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        const closeModal = document.querySelector('.close');

        let selectedRows = new Set();
        
        // Dapatkan semua checkbox setelah DOM dimuat
        const checkboxes = document.querySelectorAll('.row-checkbox');

        // update counter
        function updateSelectedCount() {
            selectedCount.textContent = `${selectedRows.size} data terpilih`;
            exportPdfBtn.disabled = selectedRows.size === 0;
        }

        // checkbox housekeeping
        function setRowChecked(rowCheckbox, checked) {
            rowCheckbox.checked = checked;
            const row = rowCheckbox.closest('tr');
            const id = row.getAttribute('data-id');
            
            if (checked) {
                selectedRows.add(id);
                row.classList.add('selected');
            } else {
                selectedRows.delete(id);
                row.classList.remove('selected');
            }
            
            // refresh master checkbox state
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            const someChecked = Array.from(checkboxes).some(cb => cb.checked);
            
            selectAll.checked = allChecked;
            selectAll.indeterminate = someChecked && !allChecked;
            
            updateSelectedCount();
        }

        // master checkbox
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => setRowChecked(cb, this.checked));
        });

        selectAllBtn.addEventListener('click', function() {
            checkboxes.forEach(cb => setRowChecked(cb, true));
        });

        deselectAllBtn.addEventListener('click', function() {
            checkboxes.forEach(cb => setRowChecked(cb, false));
        });

        // individual checkbox listeners
        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                setRowChecked(this, this.checked);
            });
        });

        // row click toggles checkbox (excluding actual checkbox clicks)
        document.querySelectorAll('tbody tr').forEach(row => {
            const rb = row.querySelector('.row-checkbox');
            row.addEventListener('click', function(e) {
                if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'LABEL' && e.target.tagName !== 'IMG') {
                    setRowChecked(rb, !rb.checked);
                }
            });
        });

        // image modal
        document.querySelectorAll('.image-preview').forEach(img => {
            img.addEventListener('click', function(e) {
                modal.style.display = 'block';
                modalImg.src = this.getAttribute('data-src') || this.src;
            });
        });
        
        closeModal.addEventListener('click', () => modal.style.display = 'none');
        window.addEventListener('click', function(ev) { 
            if (ev.target === modal) modal.style.display = 'none'; 
        });

            // --- Utility: convert <img> DOM element to base64 safely ---
            function getBase64Image(img) {
                return new Promise((resolve, reject) => {
                    // jika sudah data url, langsung resolve
                    const src = img.src || img.getAttribute('data-src');
                    // buat image baru untuk menghindari cross-origin draw issue
                    const image = new Image();
                    image.crossOrigin = "Anonymous";
                    image.onload = function() {
                        try {
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');
                            // skala agar ukuran tidak terlalu besar di PDF
                            const maxW = 800;
                            const scale = image.width > maxW ? (maxW / image.width) : 1;
                            canvas.width = Math.round(image.width * scale);
                            canvas.height = Math.round(image.height * scale);
                            ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
                            const dataURL = canvas.toDataURL('image/jpeg', 0.8);
                            resolve(dataURL);
                        } catch (err) {
                            // fallback: resolve null agar proses PDF tetap berjalan
                            console.warn('getBase64Image fallback ->', err);
                            resolve(null);
                        }
                    };
                    image.onerror = function() {
                        // jika gagal muat (CORS, broken link), kembalikan null
                        console.warn('Gagal memuat gambar untuk konversi base64:', src);
                        resolve(null);
                    };
                    image.src = src;
                });
            }

            // Format tanggal (dari string cell) ke bentuk lebih rapi jika bisa di-parse
            function formatDateForPdf(dateString) {
                if (!dateString) return '-';
                // coba parse tanggal (mengandalling Date parse)
                const parsed = new Date(dateString);
                if (!isNaN(parsed.getTime())) {
                    return parsed.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                }
                // jika tidak bisa parse, kembalikan apa adanya
                return dateString;
            }

            // Fungsi utama: buat PDF rapi (kartu per kasus)
            exportPdfBtn.addEventListener('click', async function() {
                // toggle loading UI
                exportPdfBtn.disabled = true;
                const originalText = exportPdfBtn.innerHTML;
                exportPdfBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

                try {
                    // kumpulkan baris terpilih
                    const selectedData = [];
                    const imagePromises = []; // promises -> menghasilkan base64 untuk setiap gambar

                    document.querySelectorAll('tbody tr[data-id]').forEach(row => {
                        const id = row.getAttribute('data-id');
                        if (!selectedRows.has(id)) return;

                        const cells = row.querySelectorAll('td');
                        const imgElement = row.querySelector('img');

                        // ambil teks kolom dengan trim
                        const rowData = {
                            id: cells[1].textContent.trim(),
                            objek: cells[2].textContent.trim(),
                            gedung: cells[3].textContent.trim(),
                            catatan: cells[4].textContent.trim(),
                            tipe: cells[5].textContent.trim(),
                            tanggal: cells[6].textContent.trim(),
                            petugas: cells[7].textContent.trim(),
                            email: cells[8].textContent.trim(),
                            imgElement: imgElement // bisa null
                        };

                        selectedData.push(rowData);

                        if (imgElement) {
                            imagePromises.push(
                                getBase64Image(imgElement).then(base64 => ({ id, base64 }))
                            );
                        } else {
                            imagePromises.push(Promise.resolve({ id, base64: null }));
                        }
                    });

                    // tunggu semua konversi gambar selesai
                    const imageResults = await Promise.all(imagePromises);

                    // mapping id -> base64
                    const imageMap = {};
                    imageResults.forEach(it => { imageMap[it.id] = it.base64; });

                    // ambil logo base64 (berguna untuk header kiri)
                    async function getLogoBase64() {
                        return new Promise((resolve) => {
                            const logo = new Image();
                            logo.crossOrigin = "Anonymous";
                            logo.onload = function() {
                                try {
                                    const canvas = document.createElement('canvas');
                                    const ctx = canvas.getContext('2d');
                                    const maxW = 200;
                                    const scale = logo.width > maxW ? (maxW / logo.width) : 1;
                                    canvas.width = Math.round(logo.width * scale);
                                    canvas.height = Math.round(logo.height * scale);
                                    ctx.drawImage(logo, 0, 0, canvas.width, canvas.height);
                                    resolve(canvas.toDataURL('image/png'));
                                } catch (e) {
                                    resolve(null);
                                }
                            };
                            logo.onerror = function() { resolve(null); };
                            logo.src = "{{ asset('/storage/images/logo_bp.png') }}";
                        });
                    }

                    const logoBase64 = await getLogoBase64();

                    // buat doc
                    const doc = new jsPDF({
                        unit: 'mm',
                        format: 'a4'
                    });

                    // styling dasar
                    doc.setProperties({ title: 'Laporan Kerusakan' });
                    doc.setFont('Times', 'normal');

                    const pageWidth = doc.internal.pageSize.getWidth();
                    const pageHeight = doc.internal.pageSize.getHeight();
                    const margin = 14;
                    let y = margin;

                    // header umum di halaman 1
                    if (logoBase64) {
                        // logo kiri
                        doc.addImage(logoBase64, 'PNG', margin, y, 28, 28);
                    }
                    doc.setFontSize(16);
                    doc.setTextColor(30, 30, 30);
                    doc.text('LAPORAN INSPEKSI KERUSAKAN BERAT ', pageWidth / 2, y + 8, { align: 'center' });

                    doc.setFontSize(10);
                    doc.text('DIREKTORAT PENGELOLAAN KAWASAN BANDARA', pageWidth / 2, y + 14, { align: 'center' });
                    doc.setFontSize(9);

                    // garis
                    doc.setDrawColor(200, 200, 200);
                    doc.setLineWidth(0.5);
                    doc.line(margin, y + 32, pageWidth - margin, y + 32);

                    // tanggal cetak
                    const exportDate = new Date();
                    doc.setFontSize(8);
                    doc.setTextColor(100);
                    doc.text(`Dicetak pada: ${exportDate.toLocaleDateString('id-ID', { weekday: 'long', year:'numeric', month:'long', day:'numeric', hour:'2-digit', minute:'2-digit' })}`, margin, y + 38);

                    y += 46;

                    // untuk setiap record, render block/kartu rapi
                    for (let i = 0; i < selectedData.length; i++) {
                        const row = selectedData[i];
                        const imgBase64 = imageMap[row.id] || null;

                        // jika ruang di halaman kurang, buat halaman baru
                        const estimatedBlockHeight = 60; // estimasi minimal per kartu (akan disesuaikan lebih lanjut)
                        if (y + estimatedBlockHeight > pageHeight - margin - 60) {
                            doc.addPage();
                            y = margin;
                        }

                        // card background (soft)
                        const cardX = margin;
                        const cardW = pageWidth - margin * 2;
                        const cardY = y;
                        // kotak subtle
                        doc.setFillColor(250, 250, 251);
                        doc.roundedRect(cardX, cardY, cardW, 58, 3, 3, 'F');

                        // header ID (bold)
                        doc.setFontSize(11);
                        doc.setTextColor(26, 45, 79);
                        doc.setFont(undefined, 'bold');
                        doc.text(`Kasus Kerusakan • ID: ${row.id}`, cardX + 6, cardY + 8);
                        doc.setFont(undefined, 'normal');

                        // kiri: gambar (jika ada)
                        const imgX = cardX + 6;
                        const imgY = cardY + 12;
                        const imgW = 50;
                        const imgH = 40;
                        if (imgBase64) {
                            try {
                                doc.addImage(imgBase64, 'JPEG', imgX, imgY, imgW, imgH);
                            } catch (e) {
                                // jika gagal, tulis placeholder
                                doc.setFontSize(9);
                                doc.setTextColor(120);
                                doc.text('Gagal memuat gambar', imgX, imgY + 8);
                            }
                        } else {
                            // placeholder teks gambar tidak ada
                            doc.setFontSize(9);
                            doc.setTextColor(130);
                            doc.text('Tidak ada gambar', imgX, imgY + 20);
                        }

                        // kanan: detail metadata (Objek, Gedung, Tipe, Tanggal, Petugas, Email)
                        const metaX = imgX + imgW + 8;
                        let metaY = imgY + 3;
                        const metaMaxW = cardX + cardW - (metaX + 6);

                        doc.setFontSize(9);
                        doc.setTextColor(40);

                        // helper: draw label + value (value wrapped)
                        function drawKV(label, value) {
                            doc.setFont(undefined, 'bold');
                            doc.text(`${label}:`, metaX, metaY);
                            doc.setFont(undefined, 'normal');
                            // split value ke beberapa baris jika terlalu panjang
                            const valueLines = doc.splitTextToSize(value || '-', metaMaxW - 18);
                            doc.text(valueLines, metaX + 18, metaY);
                            // naikkan metaY sesuai jumlah baris (sekitar 5 mm per baris)
                            metaY += (valueLines.length * 5) + 2;
                        }

                        drawKV('Kerusakan', '   ' + (row.objek || '-'));
                        drawKV('Gedung', row.gedung || '-');
                        drawKV('Tipe', row.tipe || '-');
                        drawKV('Tanggal', formatDateForPdf(row.tanggal || '-'));
                        drawKV('Pelapor', row.petugas || '-');
                        drawKV('Email', row.email || '-');

                        // catatan: area terpisah di bawah
                        const catatanX = cardX + 6;
                        const catatanY = cardY + 12 + Math.max(imgH, (metaY - imgY)) + 4;
                        const catatanW = cardW - 12;

                        // batas bawah card: kita mungkin perlu memperbesar tinggi kartu sesuai catatan
                        const catatanLines = doc.splitTextToSize(`Catatan: ${row.catatan || '-'}`, catatanW - 6);
                        const catatanH = catatanLines.length * 5 + 6;

                        // jika catatan tinggi maka kita perlu redraw area card (buat ruang ekstra)
                        // untuk kesederhanaan, kita akan menggambar kotak catatan di bawah card (tanpa mengubah roundedRect sebelumnya)
                        doc.setDrawColor(220, 220, 220);
                        doc.setFillColor(255, 255, 255);
                        doc.roundedRect(catatanX, catatanY, catatanW, catatanH, 2, 2, 'FD');

                        doc.setFontSize(9);
                        doc.setTextColor(60);
                        doc.text(catatanLines, catatanX + 4, catatanY + 6);

                        // update y ke bawah area card + gap
                        y = catatanY + catatanH + 8;
                    }

                    // Setelah semua record, tambahkan tanda tangan di halaman terakhir
                    // Pastikan ada ruang, jika tidak maka buat halaman baru
                    if (y > pageHeight - margin - 40) {
                        doc.addPage();
                        y = margin;
                    }

                    // Tambahkan tanda tangan di posisi absolut kanan bawah
                    const signatureX = pageWidth - margin - 60; // 60mm dari kanan
                    const signatureY = pageHeight - margin - 30; // 30mm dari bawah

                    doc.setFontSize(10);
                    doc.setTextColor(40);
                    doc.text(`Batam, ${new Date().toLocaleDateString('id-ID', { day:'2-digit', month:'long', year:'numeric' })}`, signatureX - 7, signatureY);
                    doc.text('Petugas Inspeksi,', signatureX, signatureY + 5);

                    // garis tanda tangan
                    doc.setDrawColor(0); // warna hitam
                    doc.setLineWidth(0.1); // garis lebih tipis
                    doc.line(signatureX - 15, signatureY + 30, signatureX + 45, signatureY + 30);

                    // simpan
                    doc.save('laporan-kerusakan-gedung.pdf');
                } catch (err) {
                    console.error('Error saat membuat PDF:', err);
                    alert('Terjadi kesalahan saat membuat PDF. Silakan coba lagi atau periksa console.');
                } finally {
                    // restore tombol
                    exportPdfBtn.disabled = selectedRows.size === 0;
                    exportPdfBtn.innerHTML = originalText;
                }
            });

        });
    </script>
</body>
</html>