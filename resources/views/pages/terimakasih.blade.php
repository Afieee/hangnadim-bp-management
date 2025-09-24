<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwalkan Tamu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/penjadwalan-tamu.css') }}">

</head>


<body>
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

    <!-- Content Wrapper -->
    <div class="content-wrapper">
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
                <div>
                    <h2 class="card-title" style="padding-top: 25px; padding-left:25px">Pencatatan Penggunaan Gedung VIP
                        & VVIP</h2>
                </div>
                <div class="container">
                    <form action="{{ route('penjadwalan-tamu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="level_tamu">Level Tamu:</label>
                            <div class="select-wrapper">
                                <select name="level_tamu" id="level_tamu" required>
                                    <option selected disabled>-Pilihan-</option>
                                    <option value="Kepresidenan">Kepresidenan</option>
                                    <option value="Kementerian">Kementerian</option>
                                    <option value="Lembaga Negara">Lembaga Negara</option>
                                    <option value="Tamu Negara">Tamu Negara</option>
                                    <option value="Instansi Lain">Instansi Lain</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subjek_tamu">Subjek Tamu:</label>
                            <input type="text" name="subjek_tamu" id="subjek_tamu" placeholder="Masukkan subjek tamu"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="subjek_tamu">Instansi:</label>
                            <input type="text" name="instansi" id="instansi" placeholder="Masukkan Instansi"
                                required>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="waktu_penggunaan_gedung">Waktu Penggunaan Gedung:</label>
                                    <input type="datetime-local" name="waktu_penggunaan_gedung"
                                        id="waktu_penggunaan_gedung">
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="waktu_selesai_penggunaan_gedung">Waktu Selesai Penggunaan
                                        Gedung:</label>
                                    <input type="datetime-local" name="waktu_selesai_penggunaan_gedung"
                                        id="waktu_selesai_penggunaan_gedung">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="kode_penerbangan">Kode Penerbangan:</label>
                                    <input type="text" name="kode_penerbangan" id="kode_penerbangan"
                                        placeholder="Contoh: GA-215">
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="kode_bandara_asal">Kode Bandara Asal:</label>
                                    <input type="text" name="kode_bandara_asal" id="kode_bandara_asal"
                                        placeholder="Contoh: CGK">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lembar_disposisi">Lembar Disposisi (PDF):</label>
                            <div class="file-input-wrapper">
                                <div class="file-input-button">
                                    <i class="fas fa-upload"></i> Pilih File PDF
                                </div>
                                <input type="file" name="lembar_disposisi" id="lembar_disposisi"
                                    accept="application/pdf">
                            </div>
                            <div class="file-name" id="file-name">Belum ada file dipilih</div>
                        </div>

                        <!-- Hidden field -->
                        <input type="hidden" name="id_gedung" value="5">
                        <input type="hidden" name="id_user" value="{{ Auth::id() }}">

                        <button type="submit"><i class="fas fa-save"></i> Simpan Jadwal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="{{ asset('js/components.js') }}"></script>
<script src="{{ asset('js/penjadwalan-tamu.js') }}"></script>
<script></script>

</html>
