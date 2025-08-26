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
<x-navbar :user="$user" />
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
                </ul>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.2); color: #28a745;">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h3>Total Inspeksi</h3>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $jumlahInspeksi }}</div>
                        <div class="stat-trend trend-up">
                        </div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.2); color: #dc3545;">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3>Kerusakan Belum Diperbaiki</h3>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $buktiKerusakanYangBelumDiperbaiki }}</div>
                        <div class="stat-label">Bukti kerusakan yang masih menunggu perbaikan</div>
                    </div>
                    <div class="progress-container">
                    </div>
                </div>
                
            </div>
            
            <!-- Chart Section -->
            {{-- <div class="chart-container">
                <div class="chart-header">
                    <h3><i class="fas fa-chart-line"></i> Tren Inspeksi & Perbaikan</h3>
                    <div class="chart-actions">
                        <button>Bulanan</button>
                        <button>Mingguan</button>
                        <button>Harian</button>
                    </div>
                </div>
                <div class="chart-placeholder">
                    <p>Grafik akan menampilkan tren inspeksi dan perbaikan dari waktu ke waktu</p>
                </div> --}}
            </div>
            
<script src="{{ asset('js/components.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>