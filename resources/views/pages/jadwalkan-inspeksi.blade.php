<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jadwalkan-inspeksi.css') }}">

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