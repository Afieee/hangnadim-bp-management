<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembaruan Status Inspeksi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            background: #fff;
            margin: auto;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            font-size: 15px;
        }
        strong {
            color: #555;
        }
        .chip {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 20px;
            color: white;
        }
        .chip-biru {
            background-color: #3498db;
        }
        .chip-kuning {
            background-color: #f1c40f;
            color: #333;
        }
        .chip-hijau {
            background-color: #27ae60;
        }
        .chip-merah {
            background-color: #e74c3c;
        }
        p {
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📢 Pembaruan Status Inspeksi</h2>
        <p>Halo <strong>Kepala Seksi</strong>,</p>
        <p>Telah terjadi pembaruan pada data inspeksi gedung:</p>

        <ul>
            <li><strong>Gedung:</strong> {{ $namaGedung }}</li>
            <li><strong>Field yang diubah:</strong> {{ $field }}</li>
            <li>
                <strong>Nilai baru:</strong> 
                @php
                    $kelasChip = '';
                    if ($nilaiBaru === 'Baik') {
                        $kelasChip = 'chip-biru';
                    } elseif ($nilaiBaru === 'Sedang Diperbaiki') {
                        $kelasChip = 'chip-kuning';
                    } elseif ($nilaiBaru === 'Sudah Diperbaiki') {
                        $kelasChip = 'chip-hijau';
                    } elseif ($nilaiBaru === 'Rusak') {
                        $kelasChip = 'chip-merah';
                    }
                @endphp
                <span class="chip {{ $kelasChip }}">{{ $nilaiBaru }}</span>
            </li>
            <li><strong>Diubah oleh:</strong> {{ $pengubah }}</li>
            <li><strong>Email Pengubah:</strong> {{ $emailPengubah }}</li>
            <li><strong>Tanggal & Waktu:</strong> {{ $tanggalUpdate }}</li>
        </ul>

        <p>Harap periksa sistem untuk detail lebih lanjut.</p>
    </div>
</body>
</html>
