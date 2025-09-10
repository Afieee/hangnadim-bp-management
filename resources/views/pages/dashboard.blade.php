@if (Auth::user()->role == "Staff Pelaksana")
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















@elseif (Auth::user()->role == "Kedatangan Schedulers")
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






































@elseif (Auth::user()->role == "Kepala Seksi")
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
                    <div class="stat-trend trend-up">
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.2); color: #dc3545;">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="stat-title">Kerusakan Belum Diperbaiki</h3>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="stat-belum-diperbaiki">{{ $buktiKerusakanYangBelumDiperbaiki }}</div>
                    <div class="stat-label">Bukti kerusakan yang masih menunggu perbaikan</div>
                </div>
            </div>
            <!-- <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background-color: rgba(108, 117, 125, 0.2); color: #6c757d;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 class="stat-title">Total Kerusakan</h3>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="stat-total-kerusakan">{{ $totalKerusakan }}</div>
                    <div class="stat-trend trend-down">
                    </div>
                </div>
            </div> -->
<!-- 
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background-color: rgba(23, 162, 184, 0.2); color: #17a2b8;">
                        <i class="fas fa-wrench"></i>
                    </div>
                    <h3 class="stat-title">Perbaikan Dilakukan</h3>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="stat-perbaikan-dilakukan">{{ $buktiPerbaikanPenutupKerusakan }}</div>
                    <div class="stat-label">Jumlah Perbaikan Dari Semua Kerusakan</div>
                </div>
            </div> -->

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.2); color: #ffc107;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="stat-title">Ratio Perbaikan</h3>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="stat-ratio-perbaikan">{{ number_format(($buktiPerbaikanPenutupKerusakan / max($totalKerusakan, 1)) * 100, 2) }}%</div>
                    <div class="stat-label">Persentase perbaikan terhadap kerusakan</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background-color: rgba(111, 66, 193, 0.2); color: #6f42c1;">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="stat-title">Rata-rata Rating Tamu VVIP</h3>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="stat-rating-pelayanan">{{ number_format($indeksRatingPelayananRataRata, 1) }}%</div>
                    <div class="stat-label">Rata-rata penilaian tamu</div>
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.2); color: #28a745;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="stat-title">Jumlah Staff Pelaksana</h3>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="stat-staff-pelaksana">{{ $jumlahStaffPelaksana }}</div>
                    <div class="stat-label">Total staff yang aktif</div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-container">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Distribusi Feedback Pelayanan</h3>
                    <div class="chart-filter">
                        <label for="feedback-year-filter">Tahun:</label>
                        <select id="feedback-year-filter" class="chart-year-filter">
                            <!-- Opsi tahun akan diisi secara dinamis oleh JavaScript -->
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
                        <select id="repair-year-filter" class="chart-year-filter">
                            <!-- Opsi tahun akan diisi secara dinamis oleh JavaScript -->
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
                        <select id="damage-year-filter" class="chart-year-filter">
                            <!-- Opsi tahun akan diisi secara dinamis oleh JavaScript -->
                        </select>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="damageTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/components.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk menghasilkan opsi tahun
    function generateYearOptions(selectElement, selectedYear = null) {
        const currentYear = new Date().getFullYear();
        
        // Kosongkan opsi yang ada
        selectElement.innerHTML = '';
        
        // Tambahkan opsi untuk semua tahun
        const optionAll = document.createElement('option');
        optionAll.value = 'all';
        optionAll.textContent = 'Semua Tahun';
        optionAll.selected = selectedYear === null || selectedYear === 'all';
        selectElement.appendChild(optionAll);
        
        // Tambahkan opsi untuk 6 tahun ke belakang dan 6 tahun ke depan
        for (let year = currentYear - 6; year <= currentYear + 6; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            option.selected = selectedYear === year.toString();
            selectElement.appendChild(option);
        }
    }
    
    // Panggil fungsi untuk menghasilkan opsi tahun untuk semua filter
    generateYearOptions(document.getElementById('year-filter'));
    generateYearOptions(document.getElementById('feedback-year-filter'));
    generateYearOptions(document.getElementById('repair-year-filter'));
    generateYearOptions(document.getElementById('damage-year-filter'));

    // Data dari controller
    let feedbackData = {
        sangatBaik: {{ $hitungFeedbackSangatBaik }},
        baik: {{ $hitungFeedbackBaik }},
        kurangBaik: {{ $hitungFeedbackKurangBaik }},
        tidakBaik: {{ $hitungFeedbackTidakBaik }}
    };

    // Data tipe kerusakan dari controller
    let damageTypeData = {
        furniture: {{ $buktiKerusakanFurniture }},
        fireSystem: {{ $buktiKerusakanFireSystem }},
        bangunan: {{ $buktiKerusakanBangunan }},
        mekanikalElektrikal: {{ $buktiKerusakanMekanikalElektrikal }},
        it: {{ $buktiKerusakanIT }},
        interior: {{ $buktiKerusakanInterior }},
        eksterior: {{ $buktiKerusakanEksterior }},
        sanitasi: {{ $buktiKerusakanSanitasi }}
    };

    // Inisialisasi variabel chart
    let feedbackPieChart;
    let repairStatusChart;
    let damageTypeChart;

    // Fungsi untuk inisialisasi chart
    function initCharts() {
        // Pie Chart untuk Feedback
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
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Doughnut Chart untuk Status Perbaikan
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
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Pie Chart untuk Tipe Kerusakan
        const damageTypeCtx = document.getElementById('damageTypeChart').getContext('2d');
        damageTypeChart = new Chart(damageTypeCtx, {
            type: 'pie',
            data: {
                labels: [
                    'Furniture', 
                    'Fire System', 
                    'Bangunan', 
                    'Mekanikal Elektrikal', 
                    'IT', 
                    'Interior', 
                    'Eksterior', 
                    'Sanitasi'
                ],
                datasets: [{
                    data: [
                        damageTypeData.furniture,
                        damageTypeData.fireSystem,
                        damageTypeData.bangunan,
                        damageTypeData.mekanikalElektrikal,
                        damageTypeData.it,
                        damageTypeData.interior,
                        damageTypeData.eksterior,
                        damageTypeData.sanitasi
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',    // Merah muda
                        'rgba(54, 162, 235, 0.8)',    // Biru
                        'rgba(255, 206, 86, 0.8)',    // Kuning
                        'rgba(75, 192, 192, 0.8)',    // Hijau kebiruan
                        'rgba(153, 102, 255, 0.8)',   // Ungu
                        'rgba(255, 159, 64, 0.8)',    // Jingga
                        'rgba(199, 199, 199, 0.8)',   // Abu-abu
                        'rgba(83, 102, 255, 0.8)'     // Biru tua
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
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Inisialisasi chart pertama kali
    initCharts();

    // Event listener untuk filter utama
    document.getElementById('apply-filter').addEventListener('click', function() {
        const year = document.getElementById('year-filter').value;
        
        // Tampilkan loading state
        const filterButton = document.getElementById('apply-filter');
        filterButton.classList.add('loading');
        
        // Kirim permintaan AJAX untuk mengambil data terfilter
        fetch('/dashboard/filter', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                year: year === 'all' ? null : year,
                month: null
            })
        })
        .then(response => response.json())
        .then(data => {
            // Perbarui statistik
            document.getElementById('stat-jumlah-inspeksi').textContent = data.jumlahInspeksi;
            document.getElementById('stat-belum-diperbaiki').textContent = data.buktiKerusakanYangBelumDiperbaiki;
            document.getElementById('stat-perbaikan-dilakukan').textContent = data.buktiPerbaikanPenutupKerusakan;
            document.getElementById('stat-total-kerusakan').textContent = data.totalKerusakan;
            
            // Hitung dan perbarui ratio perbaikan
            const ratio = (data.buktiPerbaikanPenutupKerusakan / Math.max(data.totalKerusakan, 1)) * 100;
            document.getElementById('stat-ratio-perbaikan').textContent = ratio.toFixed(2) + '%';
            
            // Perbarui rating pelayanan
            document.getElementById('stat-rating-pelayanan').textContent = data.indeksRatingPelayananRataRata.toFixed(1) + '%';
            
            // Perbarui data feedback
            feedbackData = {
                sangatBaik: data.hitungFeedbackSangatBaik,
                baik: data.hitungFeedbackBaik,
                kurangBaik: data.hitungFeedbackKurangBaik,
                tidakBaik: data.hitungFeedbackTidakBaik
            };
            
            // Perbarui semua chart
            feedbackPieChart.data.datasets[0].data = [
                feedbackData.sangatBaik,
                feedbackData.baik,
                feedbackData.kurangBaik,
                feedbackData.tidakBaik
            ];
            feedbackPieChart.update();
            
            repairStatusChart.data.datasets[0].data = [
                data.buktiPerbaikanPenutupKerusakan,
                data.buktiKerusakanYangBelumDiperbaiki
            ];
            repairStatusChart.update();
            
            // Perbarui URL dengan parameter filter
            const url = new URL(window.location);
            if (year === 'all') {
                url.searchParams.delete('year');
            } else {
                url.searchParams.set('year', year);
            }
            window.history.pushState({}, '', url);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memfilter data.');
        })
        .finally(() => {
            // Hilangkan loading state
            filterButton.classList.remove('loading');
        });
    });

    // Event listener untuk filter chart individu
    document.getElementById('feedback-year-filter').addEventListener('change', function() {
        const year = this.value;
        filterChartData('feedback', year);
    });

    document.getElementById('repair-year-filter').addEventListener('change', function() {
        const year = this.value;
        filterChartData('repair', year);
    });

    document.getElementById('damage-year-filter').addEventListener('change', function() {
        const year = this.value;
        filterChartData('damage', year);
    });

    // Fungsi untuk memfilter data berdasarkan tahun untuk chart tertentu
    function filterChartData(chartType, year) {
        // Kirim permintaan AJAX untuk mengambil data terfilter
        fetch('/dashboard/filter', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                year: year === 'all' ? null : year,
                month: null
            })
        })
        .then(response => response.json())
        .then(data => {
            // Perbarui data chart berdasarkan tipe
            if (chartType === 'feedback') {
                feedbackData = {
                    sangatBaik: data.hitungFeedbackSangatBaik,
                    baik: data.hitungFeedbackBaik,
                    kurangBaik: data.hitungFeedbackKurangBaik,
                    tidakBaik: data.hitungFeedbackTidakBaik
                };
                
                // Perbarui chart feedback
                feedbackPieChart.data.datasets[0].data = [
                    feedbackData.sangatBaik,
                    feedbackData.baik,
                    feedbackData.kurangBaik,
                    feedbackData.tidakBaik
                ];
                feedbackPieChart.update();
            } 
            else if (chartType === 'repair') {
                // Perbarui chart status perbaikan
                repairStatusChart.data.datasets[0].data = [
                    data.buktiPerbaikanPenutupKerusakan,
                    data.buktiKerusakanYangBelumDiperbaiki
                ];
                repairStatusChart.update();
            }
            else if (chartType === 'damage') {
                // Untuk chart tipe kerusakan, kita perlu memanggil endpoint khusus
                // karena data ini tidak termasuk dalam response filter biasa
                fetch('/dashboard/filter-damage-type', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        year: year === 'all' ? null : year
                    })
                })
                .then(response => response.json())
                .then(damageData => {
                    damageTypeData = {
                        furniture: damageData.buktiKerusakanFurniture,
                        fireSystem: damageData.buktiKerusakanFireSystem,
                        bangunan: damageData.buktiKerusakanBangunan,
                        mekanikalElektrikal: damageData.buktiKerusakanMekanikalElektrikal,
                        it: damageData.buktiKerusakanIT,
                        interior: damageData.buktiKerusakanInterior,
                        eksterior: damageData.buktiKerusakanEksterior,
                        sanitasi: damageData.buktiKerusakanSanitasi
                    };
                    
                    // Perbarui chart tipe kerusakan
                    damageTypeChart.data.datasets[0].data = [
                        damageTypeData.furniture,
                        damageTypeData.fireSystem,
                        damageTypeData.bangunan,
                        damageTypeData.mekanikalElektrikal,
                        damageTypeData.it,
                        damageTypeData.interior,
                        damageTypeData.eksterior,
                        damageTypeData.sanitasi
                    ];
                    damageTypeChart.update();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memfilter data tipe kerusakan.');
                });
            }
            
            // Perbarui URL dengan parameter filter
            const url = new URL(window.location);
            const paramName = `${chartType}Year`;
            if (year === 'all') {
                url.searchParams.delete(paramName);
            } else {
                url.searchParams.set(paramName, year);
            }
            window.history.replaceState({}, '', url);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memfilter data.');
        });
    }

    // Baca parameter filter dari URL saat halaman dimuat
    const urlParams = new URLSearchParams(window.location.search);
    const yearParam = urlParams.get('year');
    const feedbackYearParam = urlParams.get('feedbackYear');
    const repairYearParam = urlParams.get('repairYear');
    const damageYearParam = urlParams.get('damageYear');
    
    if (yearParam) {
        document.getElementById('year-filter').value = yearParam;
    }
    
    if (feedbackYearParam) {
        document.getElementById('feedback-year-filter').value = feedbackYearParam;
        filterChartData('feedback', feedbackYearParam);
    }
    
    if (repairYearParam) {
        document.getElementById('repair-year-filter').value = repairYearParam;
        filterChartData('repair', repairYearParam);
    }
    
    if (damageYearParam) {
        document.getElementById('damage-year-filter').value = damageYearParam;
        filterChartData('damage', damageYearParam);
    }
    
    // Terapkan filter otomatis jika parameter tahun utama ada
    if (yearParam) {
        document.getElementById('apply-filter').click();
    }
});
</script>
</body>
</html>
@endif