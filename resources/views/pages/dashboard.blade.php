@if (Auth::user()->role == 'Staff Pelaksana')
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
                            <h3>Inspeksi Mingguan Yang Berjalan</h3>
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

                <script src="{{ asset('js/components.js') }}"></script>
                <script src="{{ asset('js/dashboard.js') }}"></script>
    </body>

    </html>
@elseif (Auth::user()->role == 'Kedatangan Schedulers')
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
                            <h3>Inspeksi Mingguan Yang Berjalan</h3>
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

                <script src="{{ asset('js/components.js') }}"></script>
                <script src="{{ asset('js/dashboard.js') }}"></script>
    </body>

    </html>
@elseif (in_array(Auth::user()->role, ['Admin', 'Direktur', 'Kepala Sub Direktorat', 'Kepala Seksi', 'Tata Usaha', 'IT']))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aerocity Dashboard</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.css">
        <link rel="stylesheet" href="{{ asset('css/components.css') }}">
        <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">
    </head>
    <style>
        /* Tambahan style untuk responsivitas dan perbaikan layout */
        .dashboard-container {
            padding: 15px;
            max-width: 100%;
            overflow-x: hidden;
        }

        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
            align-items: center;
        }

        .filter-item {
            display: flex;
            flex-direction: column;
            min-width: 120px;
            flex: 1;
        }

        .filter-select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 5px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        .filter-button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 23px;
            white-space: nowrap;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            min-height: 120px;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s;
        }

        .stat-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 18px;
        }

        .stat-title {
            font-size: 14px;
            font-weight: 600;
            color: #6c757d;
            margin: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .stat-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #343a40;
        }

        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .chart-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .chart-header {
            margin-bottom: 15px;
        }

        .chart-title {
            font-size: 16px;
            font-weight: 600;
            color: #343a40;
            margin: 0 0 10px 0;
        }

        .chart-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 12px;
        }

        .chart-filter label {
            margin-right: 5px;
            white-space: nowrap;
        }

        .chart-year-filter,
        .chart-month-filter,
        .chart-week-filter {
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ddd;
            margin-right: 10px;
            max-width: 80px;
        }

        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }

        /* Media Queries untuk Responsivitas */
        @media (max-width: 768px) {
            .filter-container {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-item {
                width: 100%;
            }

            .filter-button {
                margin-top: 10px;
                width: 100%;
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .chart-filter {
                flex-direction: column;
                gap: 5px;
            }

            .chart-year-filter,
            .chart-month-filter,
            .chart-week-filter {
                max-width: 100%;
                margin-right: 0;
                margin-bottom: 5px;
            }

            .stat-value {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 10px;
            }

            .stat-card {
                padding: 10px;
            }

            .chart-card {
                padding: 15px;
            }

            .chart-container {
                height: 200px;
            }
        }

        /* Perbaikan untuk zoom in/out */
        body {
            overflow-x: hidden;
        }

        .content-wrapper {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>

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
        <div class="content-wrapper" id="content-wrapper">
            <!-- Content Area -->
            <div class="dashboard-container">
                <!-- Filter Controls -->
                <div class="filter-container">
                    <div class="filter-item">
                        <label for="year-filter">Tahun:</label>
                        <select id="year-filter" class="filter-select">
                            <!-- Opsi tahun akan diisi secara dinamis oleh JavaScript -->
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="month-filter">Bulan:</label>
                        <select id="month-filter" class="filter-select">
                            <option value="all">Semua Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="week-filter">Minggu:</label>
                        <select id="week-filter" class="filter-select">
                            <option value="all">Semua Minggu</option>
                            <option value="1">Minggu 1 (tgl 1-7)</option>
                            <option value="2">Minggu 2 (tgl 8-14)</option>
                            <option value="3">Minggu 3 (tgl 15-21)</option>
                            <option value="4">Minggu 4 (tgl 22-akhir)</option>
                        </select>
                    </div>
                    <button class="filter-button" id="apply-filter">
                        <i class="fas fa-filter"></i> Terapkan Filter
                    </button>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.2); color: #28a745;">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <h3 class="stat-title">Inspeksi Mingguan Yang Berjalan</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-jumlah-inspeksi">{{ $jumlahInspeksi }}</div>
                            <div class="stat-trend trend-up"></div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.2); color: #ffc107;">
                                <i class="fas fa-tools"></i>
                            </div>
                            <h3 class="stat-title">Belum Diperbaiki</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-belum-diperbaiki">
                                {{ $buktiKerusakanYangBelumDiperbaiki }}</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background-color: rgba(23, 162, 184, 0.2); color: #17a2b8;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 class="stat-title">Perbaikan Dilakukan</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-perbaikan-dilakukan">
                                {{ $buktiPerbaikanPenutupKerusakan }}</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon"
                                style="background-color: rgba(108, 117, 125, 0.2); color: #6c757d;">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3 class="stat-title">Total Kerusakan</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-total-kerusakan">{{ $totalKerusakan }}</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background-color: rgba(0,123,255,0.1); color: #007bff;">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3 class="stat-title">Indeks Rating Pelayanan (%)</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-rating-pelayanan">{{ $indeksRatingPelayananRataRata }}%
                            </div>
                        </div>
                    </div>





                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background-color: rgba(0,123,255,0.1); color: #007bff;">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="stat-title">Staff Pelaksana</h3>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value" id="stat-rating-pelayanan">{{ $jumlahStaffPelaksana }}</div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-container">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Feedback Penggunaan Gedung VIP & VVIP</h3>
                            <div class="chart-filter">
                                <label for="feedback-year-filter">Tahun:</label>
                                <select id="feedback-year-filter" class="chart-year-filter"></select>
                                <label for="feedback-month-filter">Bulan:</label>
                                <select id="feedback-month-filter" class="chart-month-filter">
                                    <option value="all">Semua Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <label for="feedback-week-filter">Minggu:</label>
                                <select id="feedback-week-filter" class="chart-week-filter">
                                    <option value="all">Semua Minggu</option>
                                    <option value="1"> 1</option>
                                    <option value="2"> 2</option>
                                    <option value="3"> 3</option>
                                    <option value="4"> 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="feedbackPieChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Status Perbaikan Kerusakan</h3>
                            <div class="chart-filter">
                                <label for="repair-year-filter">Tahun:</label>
                                <select id="repair-year-filter" class="chart-year-filter"></select>
                                <label for="repair-month-filter">Bulan:</label>
                                <select id="repair-month-filter" class="chart-month-filter">
                                    <option value="all">Semua Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <label for="repair-week-filter">Minggu:</label>
                                <select id="repair-week-filter" class="chart-week-filter">
                                    <option value="all">Semua Minggu</option>
                                    <option value="1"> 1</option>
                                    <option value="2"> 2</option>
                                    <option value="3"> 3</option>
                                    <option value="4"> 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="repairStatusChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Distribusi Tipe Kerusakan</h3>
                            <div class="chart-filter">
                                <label for="damage-year-filter">Tahun:</label>
                                <select id="damage-year-filter" class="chart-year-filter"></select>
                                <label for="damage-month-filter">Bulan:</label>
                                <select id="damage-month-filter" class="chart-month-filter">
                                    <option value="all">Semua Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <label for="damage-week-filter">Minggu:</label>
                                <select id="damage-week-filter" class="chart-week-filter">
                                    <option value="all">Semua Minggu</option>
                                    <option value="1"> 1</option>
                                    <option value="2"> 2</option>
                                    <option value="3"> 3</option>
                                    <option value="4"> 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="damageTypeChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Level Tamu Penggunaan Gedung VIP & VVIP</h3>
                            <div class="chart-filter">
                                <label for="guest-year-filter">Tahun:</label>
                                <select id="guest-year-filter" class="chart-year-filter"></select>
                                <label for="guest-month-filter">Bulan:</label>
                                <select id="guest-month-filter" class="chart-month-filter">
                                    <option value="all">Semua Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <label for="guest-week-filter">Minggu:</label>
                                <select id="guest-week-filter" class="chart-week-filter">
                                    <option value="all">Semua Minggu</option>
                                    <option value="1"> 1</option>
                                    <option value="2"> 2</option>
                                    <option value="3"> 3</option>
                                    <option value="4"> 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="guestLevelChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('js/components.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Fungsi untuk menghasilkan opsi tahun (±4 tahun)
                function generateYearOptions(selectElement, selectedYear = null) {
                    const currentYear = new Date().getFullYear();
                    selectElement.innerHTML = '';

                    const optionAll = document.createElement('option');
                    optionAll.value = 'all';
                    optionAll.textContent = 'Semua Tahun';
                    optionAll.selected = selectedYear === null || selectedYear === 'all';
                    selectElement.appendChild(optionAll);

                    for (let year = currentYear - 4; year <= currentYear + 4; year++) {
                        const option = document.createElement('option');
                        option.value = year;
                        option.textContent = year;
                        option.selected = selectedYear === year.toString();
                        selectElement.appendChild(option);
                    }
                }

                // Generate untuk semua select tahun
                generateYearOptions(document.getElementById('year-filter'));
                generateYearOptions(document.getElementById('feedback-year-filter'));
                generateYearOptions(document.getElementById('repair-year-filter'));
                generateYearOptions(document.getElementById('damage-year-filter'));
                generateYearOptions(document.getElementById('guest-year-filter')); // TAMBAH INI

                // Data dari controller (initial)
                let feedbackData = {
                    sangatBaik: {{ $hitungFeedbackSangatBaik }},
                    baik: {{ $hitungFeedbackBaik }},
                    kurangBaik: {{ $hitungFeedbackKurangBaik }},
                    tidakBaik: {{ $hitungFeedbackTidakBaik }}
                };

                let damageTypeData = {
                    furniture: {{ $buktiKerusakanFurniture }},
                    fireSystem: {{ $buktiKerusakanFireSystem }},
                    gedungBangunan: {{ $buktiKerusakanGedungBangunan }},
                    mekanikalElektrikal: {{ $buktiKerusakanMekanikalElektrikal }},
                    it: {{ $buktiKerusakanIT }},
                    jalananJembatan: {{ $buktiKerusakanJalananJembatan }},
                    jaringanAir: {{ $buktiKerusakanJaringanAir }},
                    drainase: {{ $buktiKerusakanDrainase }}
                };

                // TAMBAH DATA LEVEL TAMU
                let guestLevelData = {
                    kepresidenan: {{ $jumlahLevelTamuKepresidenan }},
                    kementerian: {{ $jumlahLevelTamuKementerian }},
                    lembagaNegara: {{ $jumlahLevelTamuLembagaNegara }},
                    tamuNegara: {{ $jumlahLevelTamuTamuNegara }},
                    instansiLain: {{ $jumlahLevelInstansiLain }}
                };

                // Chart variables
                let feedbackPieChart;
                let repairStatusChart;
                let damageTypeChart;
                let guestLevelChart; // TAMBAH INI

                function initCharts() {
                    const feedbackPieCtx = document.getElementById('feedbackPieChart').getContext('2d');
                    feedbackPieChart = new Chart(feedbackPieCtx, {
                        type: 'pie',
                        data: {
                            labels: ['Sangat Baik', 'Baik', 'Kurang Baik', 'Tidak Baik'],
                            datasets: [{
                                data: [
                                    feedbackData.sangatBaik,
                                    feedbackData.baik,
                                    feedbackData.kurangBaik,
                                    feedbackData.tidakBaik
                                ],
                                backgroundColor: [
                                    'rgba(40, 167, 69, 0.8)',
                                    'rgba(23, 162, 184, 0.8)',
                                    'rgba(255, 193, 7, 0.8)',
                                    'rgba(220, 53, 69, 0.8)'
                                ],
                                borderColor: [
                                    'rgba(40, 167, 69, 1)',
                                    'rgba(23, 162, 184, 1)',
                                    'rgba(255, 193, 7, 1)',
                                    'rgba(220, 53, 69, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = total ? Math.round((value / total) * 100) :
                                                0;
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    const repairStatusCtx = document.getElementById('repairStatusChart').getContext('2d');
                    repairStatusChart = new Chart(repairStatusCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Sudah Diperbaiki', 'Belum Diperbaiki'],
                            datasets: [{
                                data: [
                                    {{ $buktiPerbaikanPenutupKerusakan }},
                                    {{ $buktiKerusakanYangBelumDiperbaiki }}
                                ],
                                backgroundColor: [
                                    'rgba(40, 167, 69, 0.8)',
                                    'rgba(220, 53, 69, 0.8)'
                                ],
                                borderColor: [
                                    'rgba(40, 167, 69, 1)',
                                    'rgba(220, 53, 69, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = total ? Math.round((value / total) * 100) :
                                                0;
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    const damageTypeCtx = document.getElementById('damageTypeChart').getContext('2d');
                    damageTypeChart = new Chart(damageTypeCtx, {
                        type: 'pie',
                        data: {
                            labels: [
                                'Furniture', 'Fire System', 'Gedung & Bangunan', 'Mekanikal Elektrikal',
                                'IT', 'Jalanan & Jembatan', 'Jaringan Air', 'Drainase'
                            ],
                            datasets: [{
                                data: [
                                    damageTypeData.furniture,
                                    damageTypeData.fireSystem,
                                    damageTypeData.gedungBangunan,
                                    damageTypeData.mekanikalElektrikal,
                                    damageTypeData.it,
                                    damageTypeData.jalananJembatan,
                                    damageTypeData.jaringanAir,
                                    damageTypeData.drainase
                                ],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.8)',
                                    'rgba(54, 162, 235, 0.8)',
                                    'rgba(255, 206, 86, 0.8)',
                                    'rgba(75, 192, 192, 0.8)',
                                    'rgba(153, 102, 255, 0.8)',
                                    'rgba(255, 159, 64, 0.8)',
                                    'rgba(199, 199, 199, 0.8)',
                                    'rgba(83, 102, 255, 0.8)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(199, 199, 199, 1)',
                                    'rgba(83, 102, 255, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = total ? Math.round((value / total) * 100) :
                                                0;
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // TAMBAH CHART LEVEL TAMU
                    const guestLevelCtx = document.getElementById('guestLevelChart').getContext('2d');
                    guestLevelChart = new Chart(guestLevelCtx, {
                        type: 'pie',
                        data: {
                            labels: [
                                'Kepresidenan', 'Kementerian', 'Lembaga Negara',
                                'Tamu Negara', 'Instansi Lain'
                            ],
                            datasets: [{
                                data: [
                                    guestLevelData.kepresidenan,
                                    guestLevelData.kementerian,
                                    guestLevelData.lembagaNegara,
                                    guestLevelData.tamuNegara,
                                    guestLevelData.instansiLain
                                ],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.8)',
                                    'rgba(54, 162, 235, 0.8)',
                                    'rgba(255, 206, 86, 0.8)',
                                    'rgba(75, 192, 192, 0.8)',
                                    'rgba(153, 102, 255, 0.8)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = total ? Math.round((value / total) * 100) :
                                                0;
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                initCharts();

                // helper: ambil nilai filter umum (year, month, week)
                function getMainFilters() {
                    const year = document.getElementById('year-filter').value;
                    const month = document.getElementById('month-filter').value;
                    const week = document.getElementById('week-filter').value;
                    return {
                        year: year === 'all' ? null : year,
                        month: month === 'all' ? null : month,
                        week: week === 'all' ? null : week
                    };
                }

                // klik tombol apply utama -> update semua statistik dan charts
                document.getElementById('apply-filter').addEventListener('click', function() {
                    const filters = getMainFilters();
                    const filterButton = this;
                    filterButton.classList.add('loading');

                    fetch('/dashboard/filter', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(filters)
                        })
                        .then(response => response.json())
                        .then(data => {
                            // update stat values
                            document.getElementById('stat-jumlah-inspeksi').textContent = data
                                .jumlahInspeksi;
                            document.getElementById('stat-belum-diperbaiki').textContent = data
                                .buktiKerusakanYangBelumDiperbaiki;
                            document.getElementById('stat-perbaikan-dilakukan').textContent = data
                                .buktiPerbaikanPenutupKerusakan;
                            document.getElementById('stat-total-kerusakan').textContent = data
                                .totalKerusakan;
                            document.getElementById('stat-rating-pelayanan').textContent = (data
                                .indeksRatingPelayananRataRata || 0).toFixed(2) + '%';

                            // update feedback data & chart
                            feedbackData = {
                                sangatBaik: data.hitungFeedbackSangatBaik,
                                baik: data.hitungFeedbackBaik,
                                kurangBaik: data.hitungFeedbackKurangBaik,
                                tidakBaik: data.hitungFeedbackTidakBaik
                            };
                            feedbackPieChart.data.datasets[0].data = [
                                feedbackData.sangatBaik,
                                feedbackData.baik,
                                feedbackData.kurangBaik,
                                feedbackData.tidakBaik
                            ];
                            feedbackPieChart.update();

                            // update repair chart
                            repairStatusChart.data.datasets[0].data = [
                                data.buktiPerbaikanPenutupKerusakan,
                                data.buktiKerusakanYangBelumDiperbaiki
                            ];
                            repairStatusChart.update();

                            // update URL main params
                            const url = new URL(window.location);
                            if (!filters.year) url.searchParams.delete('year');
                            else url.searchParams.set('year', filters.year);
                            if (!filters.month) url.searchParams.delete('month');
                            else url.searchParams.set('month', filters.month);
                            if (!filters.week) url.searchParams.delete('week');
                            else url.searchParams.set('week', filters.week);
                            window.history.pushState({}, '', url);
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Terjadi kesalahan saat memfilter data.');
                        })
                        .finally(() => {
                            filterButton.classList.remove('loading');
                        });
                });

                // chart filters -> memanggil filterChartData
                function addChartFilterListeners(prefix, chartType) {
                    document.getElementById(prefix + '-year-filter').addEventListener('change', function() {
                        const year = this.value;
                        const month = document.getElementById(prefix + '-month-filter').value;
                        const week = document.getElementById(prefix + '-week-filter').value;
                        filterChartData(chartType, year || 'all', month || 'all', week || 'all');
                    });
                    document.getElementById(prefix + '-month-filter').addEventListener('change', function() {
                        const year = document.getElementById(prefix + '-year-filter').value;
                        const month = this.value;
                        const week = document.getElementById(prefix + '-week-filter').value;
                        filterChartData(chartType, year || 'all', month || 'all', week || 'all');
                    });
                    document.getElementById(prefix + '-week-filter').addEventListener('change', function() {
                        const year = document.getElementById(prefix + '-year-filter').value;
                        const month = document.getElementById(prefix + '-month-filter').value;
                        const week = this.value;
                        filterChartData(chartType, year || 'all', month || 'all', week || 'all');
                    });
                }

                addChartFilterListeners('feedback', 'feedback');
                addChartFilterListeners('repair', 'repair');
                addChartFilterListeners('damage', 'damage');
                addChartFilterListeners('guest', 'guest'); // TAMBAH INI

                function filterChartData(chartType, year, month, week) {
                    // Jika chartType = 'damage' gunakan endpoint khusus untuk tipe kerusakan
                    const payload = {
                        year: year === 'all' ? null : year,
                        month: month === 'all' ? null : month,
                        week: week === 'all' ? null : week
                    };

                    if (chartType === 'damage') {
                        fetch('/dashboard/filter-damage-type', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(payload)
                            })
                            .then(r => r.json())
                            .then(damageDataResp => {
                                const newDamage = {
                                    furniture: damageDataResp.buktiKerusakanFurniture,
                                    fireSystem: damageDataResp.buktiKerusakanFireSystem,
                                    gedungBangunan: damageDataResp.buktiKerusakanGedungBangunan,
                                    mekanikalElektrikal: damageDataResp.buktiKerusakanMekanikalElektrikal,
                                    it: damageDataResp.buktiKerusakanIT,
                                    jalananJembatan: damageDataResp.buktiKerusakanJalananJembatan,
                                    jaringanAir: damageDataResp.buktiKerusakanJaringanAir,
                                    drainase: damageDataResp.buktiKerusakanDrainase
                                };
                                damageTypeChart.data.datasets[0].data = [
                                    newDamage.furniture,
                                    newDamage.fireSystem,
                                    newDamage.gedungBangunan,
                                    newDamage.mekanikalElektrikal,
                                    newDamage.it,
                                    newDamage.jalananJembatan,
                                    newDamage.jaringanAir,
                                    newDamage.drainase
                                ];
                                damageTypeChart.update();

                                // update URL params for this chart
                                const url = new URL(window.location);
                                if (year === 'all' || !year) url.searchParams.delete('damageYear');
                                else url.searchParams.set('damageYear', year);
                                if (month === 'all' || !month) url.searchParams.delete('damageMonth');
                                else url.searchParams.set('damageMonth', month);
                                if (week === 'all' || !week) url.searchParams.delete('damageWeek');
                                else url.searchParams.set('damageWeek', week);
                                window.history.replaceState({}, '', url);
                            })
                            .catch(err => {
                                console.error(err);
                                alert('Terjadi kesalahan pada filter tipe kerusakan.');
                            });
                        return;
                    }

                    // Jika chartType = 'guest' gunakan endpoint khusus untuk level tamu
                    if (chartType === 'guest') {
                        fetch('/dashboard/filter-guest-schedule', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(payload)
                            })
                            .then(r => r.json())
                            .then(guestDataResp => {
                                const newGuest = {
                                    kepresidenan: guestDataResp.jumlahLevelTamuKepresidenan,
                                    kementerian: guestDataResp.jumlahLevelTamuKementerian,
                                    lembagaNegara: guestDataResp.jumlahLevelTamuLembagaNegara,
                                    tamuNegara: guestDataResp.jumlahLevelTamuTamuNegara,
                                    instansiLain: guestDataResp.jumlahLevelInstansiLain
                                };
                                guestLevelChart.data.datasets[0].data = [
                                    newGuest.kepresidenan,
                                    newGuest.kementerian,
                                    newGuest.lembagaNegara,
                                    newGuest.tamuNegara,
                                    newGuest.instansiLain
                                ];
                                guestLevelChart.update();

                                // update URL params for this chart
                                const url = new URL(window.location);
                                if (year === 'all' || !year) url.searchParams.delete('guestYear');
                                else url.searchParams.set('guestYear', year);
                                if (month === 'all' || !month) url.searchParams.delete('guestMonth');
                                else url.searchParams.set('guestMonth', month);
                                if (week === 'all' || !week) url.searchParams.delete('guestWeek');
                                else url.searchParams.set('guestWeek', week);
                                window.history.replaceState({}, '', url);
                            })
                            .catch(err => {
                                console.error(err);
                                alert('Terjadi kesalahan pada filter level tamu.');
                            });
                        return;
                    }

                    // Umum untuk feedback dan repair: panggil endpoint umum
                    fetch('/dashboard/filter', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(payload)
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (chartType === 'feedback') {
                                feedbackData = {
                                    sangatBaik: data.hitungFeedbackSangatBaik,
                                    baik: data.hitungFeedbackBaik,
                                    kurangBaik: data.hitungFeedbackKurangBaik,
                                    tidakBaik: data.hitungFeedbackTidakBaik
                                };
                                feedbackPieChart.data.datasets[0].data = [
                                    feedbackData.sangatBaik,
                                    feedbackData.baik,
                                    feedbackData.kurangBaik,
                                    feedbackData.tidakBaik
                                ];
                                feedbackPieChart.update();

                                const url = new URL(window.location);
                                if (year === 'all' || !year) url.searchParams.delete('feedbackYear');
                                else url.searchParams.set('feedbackYear', year);
                                if (month === 'all' || !month) url.searchParams.delete('feedbackMonth');
                                else url.searchParams.set('feedbackMonth', month);
                                if (week === 'all' || !week) url.searchParams.delete('feedbackWeek');
                                else url.searchParams.set('feedbackWeek', week);
                                window.history.replaceState({}, '', url);
                            } else if (chartType === 'repair') {
                                repairStatusChart.data.datasets[0].data = [
                                    data.buktiPerbaikanPenutupKerusakan,
                                    data.buktiKerusakanYangBelumDiperbaiki
                                ];
                                repairStatusChart.update();

                                const url = new URL(window.location);
                                if (year === 'all' || !year) url.searchParams.delete('repairYear');
                                else url.searchParams.set('repairYear', year);
                                if (month === 'all' || !month) url.searchParams.delete('repairMonth');
                                else url.searchParams.set('repairMonth', month);
                                if (week === 'all' || !week) url.searchParams.delete('repairWeek');
                                else url.searchParams.set('repairWeek', week);
                                window.history.replaceState({}, '', url);
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Terjadi kesalahan saat memfilter data.');
                        });
                }

                // Baca parameter filter dari URL saat halaman dimuat
                const urlParams = new URLSearchParams(window.location.search);
                const yearParam = urlParams.get('year');
                const monthParam = urlParams.get('month');
                const weekParam = urlParams.get('week');
                const feedbackYearParam = urlParams.get('feedbackYear');
                const feedbackMonthParam = urlParams.get('feedbackMonth');
                const feedbackWeekParam = urlParams.get('feedbackWeek');
                const repairYearParam = urlParams.get('repairYear');
                const repairMonthParam = urlParams.get('repairMonth');
                const repairWeekParam = urlParams.get('repairWeek');
                const damageYearParam = urlParams.get('damageYear');
                const damageMonthParam = urlParams.get('damageMonth');
                const damageWeekParam = urlParams.get('damageWeek');
                const guestYearParam = urlParams.get('guestYear'); // TAMBAH INI
                const guestMonthParam = urlParams.get('guestMonth'); // TAMBAH INI
                const guestWeekParam = urlParams.get('guestWeek'); // TAMBAH INI

                if (yearParam) document.getElementById('year-filter').value = yearParam;
                if (monthParam) document.getElementById('month-filter').value = monthParam;
                if (weekParam) document.getElementById('week-filter').value = weekParam;

                if (feedbackYearParam) document.getElementById('feedback-year-filter').value = feedbackYearParam;
                if (feedbackMonthParam) document.getElementById('feedback-month-filter').value = feedbackMonthParam;
                if (feedbackWeekParam) document.getElementById('feedback-week-filter').value = feedbackWeekParam;

                if (repairYearParam) document.getElementById('repair-year-filter').value = repairYearParam;
                if (repairMonthParam) document.getElementById('repair-month-filter').value = repairMonthParam;
                if (repairWeekParam) document.getElementById('repair-week-filter').value = repairWeekParam;

                if (damageYearParam) document.getElementById('damage-year-filter').value = damageYearParam;
                if (damageMonthParam) document.getElementById('damage-month-filter').value = damageMonthParam;
                if (damageWeekParam) document.getElementById('damage-week-filter').value = damageWeekParam;

                if (guestYearParam) document.getElementById('guest-year-filter').value = guestYearParam; // TAMBAH INI
                if (guestMonthParam) document.getElementById('guest-month-filter').value =
                    guestMonthParam; // TAMBAH INI
                if (guestWeekParam) document.getElementById('guest-week-filter').value = guestWeekParam; // TAMBAH INI

                // Terapkan filter jika ada param di URL
                if (yearParam || monthParam || weekParam) {
                    document.getElementById('apply-filter').click();
                }
                if (feedbackYearParam || feedbackMonthParam || feedbackWeekParam) {
                    filterChartData('feedback', feedbackYearParam || 'all', feedbackMonthParam || 'all',
                        feedbackWeekParam || 'all');
                }
                if (repairYearParam || repairMonthParam || repairWeekParam) {
                    filterChartData('repair', repairYearParam || 'all', repairMonthParam || 'all', repairWeekParam ||
                        'all');
                }
                if (damageYearParam || damageMonthParam || damageWeekParam) {
                    filterChartData('damage', damageYearParam || 'all', damageMonthParam || 'all', damageWeekParam ||
                        'all');
                }
                if (guestYearParam || guestMonthParam || guestWeekParam) { // TAMBAH INI
                    filterChartData('guest', guestYearParam || 'all', guestMonthParam || 'all', guestWeekParam ||
                        'all');
                }
            });
        </script>
    </body>

    </html>
@endif
