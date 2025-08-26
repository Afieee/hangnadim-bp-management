<!-- resources/views/manage-kedatangan.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Kedatangan</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

    <!-- Extra Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .card {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
        .responsive{
            padding: 10px
        }
    </style>
</head>

<body class="bg-gray-100">

    <x-navbar />
    <x-sidebar />

    @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg flex items-center space-x-2">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-tools"></i> Manage Tamu</li>

                </ul>
            </div>
        </div>

        <div class="card">
            <!-- Card Tabel + Tombol -->
            <div class="bg-white rounded-lg shadow p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="text-lg font-semibold text-gray-700">Daftar Kedatangan Tamu</h2>
                    <a href="/halaman-manage-kedatangan"
                    class="bg-blue-500 hover:bg-blue-600 text-white rounded shadow transition duration-200 btn-jadwalkan responsive">
                        <i class="fas fa-plus"></i> Jadwalkan
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>NO</th>
                                <th>Nama Tamu</th>
                                <th>Level Tamu</th>
                                <th>Waktu Berangkat</th>
                                <th>Waktu Mendarat</th>
                                <th>Kode Penerbangan</th>
                                <th>Kode Bandara Asal</th>
                                <th>Lembar Disposisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tamu as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->subjek_tamu }}</td>
                                <td>{{ $item->level_tamu }}</td>
                                <td>
                                    <span class="badge bg-blue-500 text-white px-2 py-1 rounded">
                                        {{ \Carbon\Carbon::parse($item->waktu_tamu_berangkat)->translatedFormat('Y F d, H:i') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-green-500 text-white px-2 py-1 rounded">
                                        {{ \Carbon\Carbon::parse($item->waktu_tamu_mendarat)->translatedFormat('Y F d, H:i') }}
                                    </span>
                                </td>
                                <td>{{ $item->kode_penerbangan }}</td>
                                <td>{{ $item->kode_bandara_asal }}</td>
                                <td>
                                    @if($item->lembar_disposisi)
                                        <a href="{{ asset('storage/'.$item->lembar_disposisi) }}" target="_blank"
                                           class="text-primary"><i class="fas fa-file-alt"></i> Lihat</a>
                                    @else
                                        <span class="text-muted fst-italic">Tidak ada</span>
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


</body>
<script src="{{ asset('js/components.js') }}"></script>
</html>
