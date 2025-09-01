<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pribadi</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="background: white; padding: 20px; border-radius: 8px;">
        <h2 style="color: #007bff;">📢 Laporan Pribadi - Bukti Kerusakan</h2>
        <p>Halo Kepada Semua Staff Pelaksana & Kepala Seksi,</p>
        <p>Mohon Untuk Segera Ditindak</p>
        <p>Berikut detail laporan pribadi yang baru saja diunggah:</p>

        <ul>
            <li><strong>Objek:</strong> {{ $data['judul_bukti_kerusakan'] }}</li>
            <li><strong>Deskripsi Kerusakan:</strong> {{ $data['deskripsi_bukti_kerusakan'] }}</li>
            <li><strong>Lokasi Detail:</strong> {{ $data['lokasi_bukti_kerusakan'] }}</li>
            <li><strong>Tipe Kerusakan:</strong> {{ $data['tipe_kerusakan'] }}</li>
            <li><strong>Pelapor:</strong> {{ $data['nama_pelapor'] }}</li>
        </ul>
        <p>Terima kasih,<br> Sistem Pelaporan</p>
    </div>
</body>
</html>
