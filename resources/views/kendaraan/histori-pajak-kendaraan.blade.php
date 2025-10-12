<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerocity Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/list-kendaraan.css') }}">
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

</head>

<body class="bg-light">
    {{-- Components --}}
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
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="/kendaraan"><i class="fas fa-user"></i> Asset Kendaraan Operasional</a></li>
                    <li class="active"><i class="fas fa-car"></i> Histori Pajak Kendaraan - {{ $detailPlatKendaraan }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-area">
            <div class="card">
                <div class="card-custom p-4">
                    <!-- Header dengan judul, pencarian, dan tombol -->
                    <div class="header-container" style="padding: 25px;">
                        <div class="table-header">
                            <h2 class="page-title">Histori Pajak Kendaraan - {{ $detailPlatKendaraan }}
                                ({{ $detailTipeKendaraan }}) </h2>
                            {{-- <button class="btn btn-primary" id="btnTambahKendaraan">
                                <i class="fas fa-plus" style="margin-right: 5px;"></i> Tambah Kendaraan
                            </button> --}}
                        </div>


                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Histori Pajak</th>
                                        <th>Dicatat Oleh</th>
                                        <th>Data Ditulis Tanggal</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historiPajak as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                Tanggal Awal Aktif Hingga -
                                                {{ $item->catatan_pencatatan_pajak
                                                    ? \Carbon\Carbon::parse($item->catatan_pencatatan_pajak)->translatedFormat('d F Y')
                                                    : '-' }}
                                            </td>
                                            <td>{{ $item->user->name ?? '-' }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i:s') }}
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
    </div>
