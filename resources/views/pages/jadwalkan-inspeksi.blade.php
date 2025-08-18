    

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
                </ul>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div class="card">
                <div class="container">
                    <h2>Jadwalkan Inspeksi Gedung</h2>

                    @if(session('success'))
                        <div style="color: green;">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('jadwalkan.inspeksi.store') }}" method="POST">
                        @csrf

                        <div>
                            <select name="status_access_door" required hidden>
                                <option value="belum diperiksa">Belum Diperiksa</option>
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>

                        <div>
                            <select name="status_cctv" required hidden>
                                <option value="belum diperiksa">Belum Diperiksa</option>
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>

                        <div>
                            <select name="status_lampu" required hidden>
                                <option value="belum diperiksa">Belum Diperiksa</option>
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>



                        <button type="submit">Jadwalkan Inspeksi Semua Gedung</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/components.js') }}"></script>

