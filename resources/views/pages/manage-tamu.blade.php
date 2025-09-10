@if (Auth::user()->role == "Tata Usaha")
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
    <link rel="stylesheet" href="{{ asset('css/manage-tamu.css') }}">



</head>

<style>

<style>
.toast {
    opacity: 0;
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #198754;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    transition: opacity 0.3s ease;
}

.toast.show {
    opacity: 1;
}
</style>

</style>
<body>
    <!-- Komponen x diisolasi dari CSS halaman -->
    <div style="all: initial">
        <x-navbar />
    </div>
    
    <div style="all: initial">
        <x-sidebar />
    </div>
    <div id="toastCopy" class="toast">Link berhasil disalin!</div>


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
                                                @if($item->feedbacks()->exists())
                                                    <span style="color: gray; cursor: not-allowed;">Feedback Sudah Ada</span>
                                                @else
                                                    <div class="d-flex align-items-center gap-2">
                                                        <input type="text" 
                                                            value="{{ route('halaman.feedback.tamu', ['id' => Crypt::encryptString($item->id)]) }}"
                                                            class="form-control form-control-sm" 
                                                            readonly 
                                                            id="feedbackLink{{ $item->id }}">
                                                        <button class="btn btn-sm btn-outline-primary" onclick="copyLink({{ $item->id }})">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                @endif
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
    <script src="{{ asset('js/manage-tamu.js') }}"></script>


</body>
</html>














@elseif (in_array(Auth::user()->role, ['Direktur', 'Kepala Seksi', 'Kepala Sub Direktorat', 'Deputi']))
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
    <link rel="stylesheet" href="{{ asset('css/manage-tamu.css') }}">
</head>

<style>

<style>
.toast {
    opacity: 0;
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #198754;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    transition: opacity 0.3s ease;
}

.toast.show {
    opacity: 1;
}
</style>

</style>
<body>
    <!-- Komponen x diisolasi dari CSS halaman -->
    <div style="all: initial">
        <x-navbar />
    </div>
    
    <div style="all: initial">
        <x-sidebar />
    </div>
    <div id="toastCopy" class="toast">Link berhasil disalin!</div>


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
                                
                                {{-- <a href="/halaman-manage-kedatangan"
                                class="btn-jadwalkan bg-blue-500 hover:bg-blue-600 text-white">
                                    <i class="fas fa-plus"></i> Jadwalkan
                                </a> --}}
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
                                                @if($item->feedbacks()->exists())
                                                    <span style="color: gray; cursor: not-allowed;">Feedback Sudah Ada</span>
                                                @else
                                                    <div class="d-flex align-items-center gap-2">
                                                        <input type="text" 
                                                            value="{{ route('halaman.feedback.tamu', ['id' => Crypt::encryptString($item->id)]) }}"
                                                            class="form-control form-control-sm" 
                                                            readonly 
                                                            id="feedbackLink{{ $item->id }}">
                                                        <button class="btn btn-sm btn-outline-primary" onclick="copyLink({{ $item->id }})">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                @endif
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
    <script src="{{ asset('js/manage-tamu.js') }}"></script>


</body>
</html>

@endif