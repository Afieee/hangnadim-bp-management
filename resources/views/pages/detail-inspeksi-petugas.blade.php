
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>
    <x-navbar />
    <x-sidebar />

    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
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
                
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Inspeksi</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-2">Informasi Gedung</h2>
        <p><strong>Nama Gedung:</strong> {{ $inspeksi->gedung->nama_gedung ?? '-' }} - {{ $inspeksi->created_at ?? '-' }}</p>
        <hr class="my-4">

        <h2 class="text-xl font-semibold mb-2">Informasi Petugas</h2>
        <p><strong>Nama Petugas:</strong> {{ $inspeksi->user->name ?? '-' }}</p>
        <p><strong>Email:</strong> {{ $inspeksi->user->email ?? '-' }}</p>

        <hr class="my-4">

        <h2 class="text-xl font-semibold mb-2">Detail Inspeksi</h2>
        <p><strong>ID Inspeksi:</strong> {{ $inspeksi->id }}</p>
        <p><strong>Tanggal Inspeksi:</strong> {{ $inspeksi->created_at ?? '-' }}</p>







        <p><strong>Status Access Door:</strong></p>
        <select name="status_access_door" class="border rounded px-2 py-1">
            <option>Belum Diperiksa</option>
            <option value="Tidak Baik">Tidak Baik</option>
            <option value="Baik">Perlu Perbaikan</option>
        </select>

        <p><strong>Status CCTV:</strong></p>
        <select name="status_cctv" class="border rounded px-2 py-1">
            <option>Belum Diperiksa</option>
            <option value="Tidak Baik">Tidak Baik</option>
            <option value="Baik">Perlu Perbaikan</option>
        </select>

        <p><strong>Status Lampu:</strong></p>
        <select name="status_lampu" class="border rounded px-2 py-1">
            <option>Belum Diperiksa</option>
            <option value="Tidak Baik">Tidak Baik</option>
            <option value="Baik">Perlu Perbaikan</option>
        </select>







<hr>
        <p><strong>Status:</strong> {{ $inspeksi->status_keseluruhan_inspeksi ?? '-' }}</p>

        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali</a>
        </div>
    </div>
</div>
            </div>
        </div>

<x-footer />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('js/components.js') }}"></script>
