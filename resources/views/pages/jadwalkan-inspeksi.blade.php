<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <style>
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












        /* Additional custom styles */
        .inspection-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .inspection-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid #4a6cf7;
        }
        
        .inspection-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        
        .inspection-card h3 {
            margin-top: 0;
            color: #333;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }
        
        .inspection-card h3 i {
            margin-right: 10px;
            color: #4a6cf7;
        }
        
        .inspection-card .building-image {
            height: 150px;
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            margin: 15px 0;
        }
        
        .inspection-card .btn-schedule {
            background: #4a6cf7;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .inspection-card .btn-schedule:hover {
            background: #3a5bd9;
        }
        
        .inspection-card .btn-schedule i {
            margin-right: 8px;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .success-message i {
            margin-right: 10px;
        }
        
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #333;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
            color: #4a6cf7;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .container {
            padding: 25px;
        }
    </style>
</head>
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
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-calendar-check"></i> Schedule Inspection</li>
                </ul>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div class="card">
                <div class="container">
                    <h2 class="section-title"><i class="fas fa-building"></i> Building Inspection Scheduling</h2>
                    <div class="inspection-container">
                        <!-- Building A -->
                        <div class="inspection-card">
                            <h3><i class="fas fa-university"></i> GEDUNG A</h3>
                            <div class="building-image" style="background-image: url('{{ asset('/storage/images/gedung_a.jpeg') }}');"></div>
                            <form action="{{ route('jadwalkan.inspeksi.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="furniture" value="Belum Diperiksa">
                                <input type="hidden" name="furniture" value="Belum Diperiksa">
                                <input type="hidden" name="fire_system" value="Belum Diperiksa">
                                <input type="hidden" name="bangunan" value="Belum Diperiksa">
                                <input type="hidden" name="mekanikal_elektrikal" value="Belum Diperiksa">
                                <input type="hidden" name="it" value="Belum Diperiksa">
                                <input type="hidden" name="interior" value="Belum Diperiksa">
                                <input type="hidden" name="eksterior" value="Belum Diperiksa">
                                <input type="hidden" name="sanitasi" value="Belum Diperiksa">
                                <input type="hidden" name="id_gedung" value="1">
                                <button type="submit" class="btn-schedule">
                                    <i class="fas fa-calendar-plus"></i> Schedule Inspection
                                </button>
                            </form>
                        </div>

                        <!-- Building B -->
                        <div class="inspection-card">
                            <h3><i class="fas fa-university"></i> GEDUNG B</h3>
                            <div class="building-image" style="background-image: url('{{ asset('/storage/images/gedung_b.jpeg') }}');"></div>
                            <form action="{{ route('jadwalkan.inspeksi.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="furniture" value="Belum Diperiksa">
                                <input type="hidden" name="fire_system" value="Belum Diperiksa">
                                <input type="hidden" name="bangunan" value="Belum Diperiksa">
                                <input type="hidden" name="mekanikal_elektrikal" value="Belum Diperiksa">
                                <input type="hidden" name="it" value="Belum Diperiksa">
                                <input type="hidden" name="interior" value="Belum Diperiksa">
                                <input type="hidden" name="eksterior" value="Belum Diperiksa">
                                <input type="hidden" name="sanitasi" value="Belum Diperiksa">
                                <input type="hidden" name="id_gedung" value="2">
                                <button type="submit" class="btn-schedule">
                                    <i class="fas fa-calendar-plus"></i> Schedule Inspection
                                </button>
                            </form>
                        </div>

                        <!-- Building C -->
                        <div class="inspection-card">
                            <h3><i class="fas fa-university"></i> GEDUNG C</h3>
                            <div class="building-image" style="background-image: url('{{ asset('/storage/images/gedung_c.jpeg') }}');"></div>
                            <form action="{{ route('jadwalkan.inspeksi.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="furniture" value="Belum Diperiksa">
                                <input type="hidden" name="fire_system" value="Belum Diperiksa">
                                <input type="hidden" name="bangunan" value="Belum Diperiksa">
                                <input type="hidden" name="mekanikal_elektrikal" value="Belum Diperiksa">
                                <input type="hidden" name="it" value="Belum Diperiksa">
                                <input type="hidden" name="interior" value="Belum Diperiksa">
                                <input type="hidden" name="eksterior" value="Belum Diperiksa">
                                <input type="hidden" name="sanitasi" value="Belum Diperiksa">
                                <input type="hidden" name="id_gedung" value="3">
                                <button type="submit" class="btn-schedule">
                                    <i class="fas fa-calendar-plus"></i> Schedule Inspection
                                </button>
                            </form>
                        </div>

                        <!-- Equipment Building -->
                        <div class="inspection-card">
                            <h3><i class="fas fa-tools"></i> GEDUNG PERLENGKAPAN</h3>
                            <div class="building-image" style="background-image: url('{{ asset('/storage/images/gedung_perlengkapan.jpeg') }}');"></div>
                            <form action="{{ route('jadwalkan.inspeksi.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="furniture" value="Belum Diperiksa">
                                <input type="hidden" name="fire_system" value="Belum Diperiksa">
                                <input type="hidden" name="bangunan" value="Belum Diperiksa">
                                <input type="hidden" name="mekanikal_elektrikal" value="Belum Diperiksa">
                                <input type="hidden" name="it" value="Belum Diperiksa">
                                <input type="hidden" name="interior" value="Belum Diperiksa">
                                <input type="hidden" name="eksterior" value="Belum Diperiksa">
                                <input type="hidden" name="sanitasi" value="Belum Diperiksa">
                                <input type="hidden" name="id_gedung" value="4">
                                <button type="submit" class="btn-schedule">
                                    <i class="fas fa-calendar-plus"></i> Schedule Inspection
                                </button>
                            </form>
                        </div>

                        <!-- POS GT Building -->
                        <div class="inspection-card">
                            <h3><i class="fas fa-warehouse"></i> GEDUNG POS GT</h3>
                            <div class="building-image" style="background-image: url('{{ asset('/storage/images/gedung_pos_gt.jpeg') }}');"></div>
                            <form action="{{ route('jadwalkan.inspeksi.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="furniture" value="Belum Diperiksa">
                                <input type="hidden" name="fire_system" value="Belum Diperiksa">
                                <input type="hidden" name="bangunan" value="Belum Diperiksa">
                                <input type="hidden" name="mekanikal_elektrikal" value="Belum Diperiksa">
                                <input type="hidden" name="it" value="Belum Diperiksa">
                                <input type="hidden" name="interior" value="Belum Diperiksa">
                                <input type="hidden" name="eksterior" value="Belum Diperiksa">
                                <input type="hidden" name="sanitasi" value="Belum Diperiksa">
                                <input type="hidden" name="id_gedung" value="6">
                                <button type="submit" class="btn-schedule">
                                    <i class="fas fa-calendar-plus"></i> Schedule Inspection
                                </button>
                            </form>
                        </div>

                        <!-- Cargo Building -->
                        <div class="inspection-card">
                            <h3><i class="fas fa-city"></i> Gedung Masjid Tanjak</h3>
                            <div class="building-image" style="background-image: url('{{ asset('/storage/images/gedung_masjid_tanjak.jpeg') }}');"></div>
                            <form action="{{ route('jadwalkan.inspeksi.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="furniture" value="Belum Diperiksa">
                                <input type="hidden" name="fire_system" value="Belum Diperiksa">
                                <input type="hidden" name="bangunan" value="Belum Diperiksa">
                                <input type="hidden" name="mekanikal_elektrikal" value="Belum Diperiksa">
                                <input type="hidden" name="it" value="Belum Diperiksa">
                                <input type="hidden" name="interior" value="Belum Diperiksa">
                                <input type="hidden" name="eksterior" value="Belum Diperiksa">
                                <input type="hidden" name="sanitasi" value="Belum Diperiksa">
                                <input type="hidden" name="id_gedung" value="7">
                                <button type="submit" class="btn-schedule">
                                    <i class="fas fa-calendar-plus"></i> Schedule Inspection
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/components.js') }}"></script>
    <script>
        // You can add additional JavaScript here if needed
        $(document).ready(function() {
            // Add any interactive functionality here
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






</body>
</html>