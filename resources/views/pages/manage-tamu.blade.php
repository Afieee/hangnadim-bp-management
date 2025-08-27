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
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

    <!-- Extra Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        /* Isolasi komponen x dari CSS yang sudah ada */
        x-navbar, x-sidebar {
            all: initial;
        }
    
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        
        .card-custom {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }
        
        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        
        .table-custom thead th {
            background-color: #f1f5f9;
            color: #64748b;
            font-weight: 600;
            padding: 12px 15px;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .table-custom tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        
        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }
        
        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }
        
        .badge-time {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .btn-jadwalkan {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }
        
        .btn-jadwalkan:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .search-container {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }
        
        .search-input {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
            min-width: 280px;
            transition: all 0.2s ease;
            height: 42px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        
        .search-btn {
            height: 42px;
            border-radius: 8px;
            padding: 0 20px;
            font-weight: 500;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .pagination {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 20px;
        }
        
        .page-item {
            display: inline-block;
        }
        
        .page-link {
            padding: 8px 15px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .page-link:hover {
            background-color: #f1f5f9;
            color: #3b82f6;
        }
        
        .page-item.active .page-link {
            background-color: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }
        
        .alert-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #10b981;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            animation: fadeIn 0.3s ease, fadeOut 0.5s ease 2.5s forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-10px); }
        }
        
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .header-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-container {
                width: 100%;
            }
            
            .search-input {
                min-width: auto;
                flex-grow: 1;
            }
        }
        
        @media (max-width: 576px) {
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-input, .search-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Komponen x diisolasi dari CSS halaman -->
    <div style="all: initial">
        <x-navbar />
    </div>
    
    <div style="all: initial">
        <x-sidebar />
    </div>
    
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-calendar-check"></i> Manage Kedatangan</li>
                </ul>
            </div>
        </div>
        
        <div class="content-area">
            <div class="card">
                    <div class="card-custom p-4">
                        <!-- Header dengan judul, pencarian, dan tombol -->
                        <div class="header-container">
                            <h2 class="page-title">Daftar Kedatangan Tamu</h2>
                            
                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                <form action="{{ route('tampil.manage.kedatangan') }}" method="GET" class="search-container">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="search-input" placeholder="Cari tamu, level, kode, tanggal...">
                                    <button type="submit" class="btn btn-primary search-btn">
                                        <i class="fas fa-search me-1"></i> Cari
                                    </button>
                                </form>
                                
                                <a href="/halaman-manage-kedatangan"
                                class="btn-jadwalkan bg-blue-500 hover:bg-blue-600 text-white">
                                    <i class="fas fa-plus"></i> Jadwalkan
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Tamu</th>
                                        <th>Level Tamu</th>
                                        <th>Waktu Berangkat</th>
                                        <th>Waktu Mendarat</th>
                                        <th>Kode Penerbangan</th>
                                        <th>Kode Bandara Asal</th>
                                        <th>Lembar Disposisi</th>
                                        <th>Link Feedback</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tamu as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ($tamu->currentPage() - 1) * $tamu->perPage() }}</td>
                                        <td class="fw-medium">{{ $item->subjek_tamu }}</td>
                                        <td><span class="badge bg-secondary">{{ $item->level_tamu }}</span></td>
                                        <td>
                                            <span class="badge-time bg-blue-100 text-blue-800">
                                                {{ \Carbon\Carbon::parse($item->waktu_tamu_berangkat)
                                                    ->locale('id')
                                                    ->translatedFormat('l, d F Y • H:i') }} WIB
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-time bg-green-100 text-green-800">
                                                {{ \Carbon\Carbon::parse($item->waktu_tamu_mendarat)
                                                    ->locale('id')
                                                    ->translatedFormat('l, d F Y • H:i') }} WIB
                                            </span>
                                        </td>
                                        <td><code>{{ $item->kode_penerbangan }}</code></td>
                                        <td><code>{{ $item->kode_bandara_asal }}</code></td>
                                        <td>
                                            @if($item->lembar_disposisi)
                                                <a href="{{ asset('storage/'.$item->lembar_disposisi) }}" target="_blank"
                                                class="text-primary text-decoration-none">
                                                    <i class="fas fa-file-alt me-1"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-muted fst-italic">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href=""></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fs-1 d-block mb-2"></i>
                                            Tidak ada data ditemukan
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $tamu->withQueryString()->links() }}
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/components.js') }}"></script>
</body>
</html>