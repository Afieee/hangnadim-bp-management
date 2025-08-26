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
<style>
        /* Modern Toast Notification */
    .toast {
        position: fixed;
        top: 20px; /* Changed from 50% to 20px from top */
        left: 50%;
        transform: translateX(-50%) scale(0.8); /* Removed Y translation */
        background-color: #fff;
        color: #333;
        padding: 20px 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        font-family: 'Segoe UI', sans-serif;
        font-size: 16px;
        z-index: 9999;
        opacity: 0;
        display: flex;
        align-items: center;
        gap: 15px;
        border-left: 5px solid #4CAF50;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        max-width: 350px;
        width: 90%;
    }

    /* Show toast with animation */
    .toast.show {
        opacity: 1;
        transform: translateX(-50%) scale(1); /* Removed Y translation */
    }

    /* Checkmark icon container */
    .toast-icon {
        width: 40px;
        height: 40px;
        background-color: #4CAF50;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
    }

    /* Checkmark animation */
    .toast-icon::before {
        content: "";
        position: absolute;
        width: 20px;
        height: 10px;
        border-left: 3px solid white;
        border-bottom: 3px solid white;
        transform: rotate(-45deg) scale(0);
        top: 12px;
        left: 8px;
        transition: transform 0.3s ease 0.2s;
    }

    .toast.show .toast-icon::before {
        transform: rotate(-45deg) scale(1);
    }

    /* Toast content */
    .toast-content {
        flex-grow: 1;
    }

    /* Toast title */
    .toast-title {
        font-weight: 600;
        margin-bottom: 5px;
        color: #222;
    }

    /* Close button */
    .toast-close {
        background: none;
        border: none;
        color: #999;
        font-size: 18px;
        cursor: pointer;
        padding: 5px;
        margin-left: 10px;
        transition: color 0.2s;
    }

    .toast-close:hover {
        color: #666;
    }

    /* Progress bar */
    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background-color: rgba(76, 175, 80, 0.2);
    }

    .toast-progress::before {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        height: 100%;
        width: 100%;
        background-color: #4CAF50;
        animation: progress 3s linear forwards;
    }



        /* Custom styles for the dashboard cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 20px;
        }
        
        .stat-content {
            flex-grow: 1;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 14px;
        }
        
        .stat-trend {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 14px;
        }
        
        .trend-up {
            color: #28a745;
        }
        
        .trend-down {
            color: #dc3545;
        }
        
        .progress-container {
            margin-top: 15px;
        }
        
        .progress-bar {
            height: 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            border-radius: 4px;
        }
        
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .chart-actions button {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        }
        
        .chart-placeholder {
            height: 300px;
            background-color: #f8f9fa;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

</style>

<body>
<x-navbar />
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
                    <h2 class="card-title">Formulir Penjadwalan Tamu</h2>
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
                                    <option value="Pejabat Negara">Pejabat Negara</option>
                                    <option value="Tamu Negara">Tamu Negara</option>
                                    <option value="Instansi Lain">Instansi Lain</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subjek_tamu">Subjek Tamu:</label>
                            <input type="text" name="subjek_tamu" id="subjek_tamu" placeholder="Masukkan subjek tamu" required>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="waktu_tamu_berangkat">Waktu Tamu Berangkat:</label>
                                    <input type="datetime-local" name="waktu_tamu_berangkat" id="waktu_tamu_berangkat">
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="waktu_tamu_mendarat">Waktu Tamu Mendarat:</label>
                                    <input type="datetime-local" name="waktu_tamu_mendarat" id="waktu_tamu_mendarat">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="kode_penerbangan">Kode Penerbangan:</label>
                                    <input type="text" name="kode_penerbangan" id="kode_penerbangan" placeholder="Contoh: GA-215">
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="kode_bandara_asal">Kode Bandara Asal:</label>
                                    <input type="text" name="kode_bandara_asal" id="kode_bandara_asal" placeholder="Contoh: CGK">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lembar_disposisi">Lembar Disposisi (PDF):</label>
                            <div class="file-input-wrapper">
                                <div class="file-input-button">
                                    <i class="fas fa-upload"></i> Pilih File PDF
                                </div>
                                <input type="file" name="lembar_disposisi" id="lembar_disposisi" accept="application/pdf">
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
    <script>
        // Simple script to show selected file name (without changing structure)
        document.getElementById('lembar_disposisi').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Belum ada file dipilih';
            document.getElementById('file-name').textContent = fileName;
        });




        document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast');
        if(toast) {
            // Show toast with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Close toast when close button is clicked
            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                toast.classList.remove('show');
            });
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    });

    </script>
</html>