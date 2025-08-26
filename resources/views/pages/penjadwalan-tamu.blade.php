<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerocity Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">


</head>

<body>
<x-navbar/>
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

    <!-- Content Wrapper -->
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-calendar-check"></i> Kedatangan Tamu</li>

                </ul>
            </div>
        </div>

        <div class="content-area">
            <div class="card">
                <h2>Tambah Penjadwalan Tamu</h2>

                <form action="{{ route('penjadwalan-tamu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="level_tamu">Level Tamu:</label>
                    <select name="level_tamu" id="level_tamu" required>
                        <option selected>-Pilihan-</option>
                        <option value="Kepresidenan">Kepresidenan</option>
                        <option value="Pejabat Negara">Pejabat Negara</option>
                        <option value="Tamu Negara">Tamu Negara</option>
                        <option value="Instansi Lain">Instansi Lain</option>
                    </select>
                    <br><br>

                    <label for="subjek_tamu">Subjek Tamu:</label>
                    <input type="text" name="subjek_tamu" id="subjek_tamu" required>
                    <br><br>

                    <label for="waktu_tamu_berangkat">Waktu Tamu Berangkat:</label>
                    <input type="datetime-local" name="waktu_tamu_berangkat" id="waktu_tamu_berangkat">
                    <br><br>

                    <label for="waktu_tamu_mendarat">Waktu Tamu Mendarat:</label>
                    <input type="datetime-local" name="waktu_tamu_mendarat" id="waktu_tamu_mendarat">
                    <br><br>

                    <label for="kode_penerbangan">Kode Penerbangan:</label>
                    <input type="text" name="kode_penerbangan" id="kode_penerbangan">
                    <br><br>

                    <label for="kode_bandara_asal">Kode Bandara Asal:</label>
                    <input type="text" name="kode_bandara_asal" id="kode_bandara_asal">
                    <br><br>

                    <label for="lembar_disposisi">Lembar Disposisi (PDF):</label>
                    <input type="file" name="lembar_disposisi" id="lembar_disposisi" accept="application/pdf">
                    <br><br>

                    <!-- Hidden field -->
                    <input type="hidden" name="id_gedung" value="5">
                    <input type="hidden" name="id_user" value="{{ Auth::id() }}">

                    <button type="submit">Simpan</button>
                </form>
        
            </div>
        </div>

<script src="{{ asset('js/components.js') }}"></script>
</body>
</html>