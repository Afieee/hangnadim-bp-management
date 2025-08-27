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
    
    /* Styling untuk tabel yang lebih modern */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .modern-table thead th {
        background-color: #3b82f6;
        color: white;
        font-weight: 600;
        padding: 12px 15px;
        text-align: left;
    }
    
    .modern-table tbody tr {
        transition: background-color 0.2s;
    }
    
    .modern-table tbody tr:nth-child(even) {
        background-color: #f8fafc;
    }
    
    .modern-table tbody tr:hover {
        background-color: #eef2ff;
    }
    
    .modern-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .rating-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .rating-excellent {
        background-color: #10b981;
        color: white;
    }
    
    .rating-good {
        background-color: #3b82f6;
        color: white;
    }
    
    .rating-average {
        background-color: #f59e0b;
        color: white;
    }
    
    .rating-poor {
        background-color: #ef4444;
        color: white;
    }
    
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .pagination .page-item .page-link {
        color: #3b82f6;
        border: 1px solid #e2e8f0;
        padding: 8px 16px;
        border-radius: 6px;
        margin: 0 4px;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #3b82f6;
        border-color: #3b82f6;
        color: white;
    }
    
    .pagination .page-item.disabled .page-link {
        color: #94a3b8;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 0;
        color: #64748b;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #cbd5e1;
    }
    
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .card-header {
        background-color: white;
        border-bottom: 1px solid #e2e8f0;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .card-title {
        margin: 0;
        font-weight: 600;
        color: #1e293b;
    }
    
    .filter-container {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .filter-select {
        padding: 8px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background-color: white;
    }



    .rating-blue {
        background-color: #3b82f6; /* Biru */
        color: white;
    }
    .rating-green {
        background-color: #10b981; /* Hijau */
        color: white;
    }
    .rating-yellow {
        background-color: #fbbf24; /* Kuning */
        color: white;
    }
    .rating-red {
        background-color: #ef4444; /* Merah */
        color: white;
    }
    .rating-default {
        background-color: #6b7280; /* Abu-abu default */
        color: white;
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
                    <div class="header-container">
                        <h2 class="page-title">Daftar Feedback Tamu</h2>
                        
                        <!-- Filter options -->
                        <div class="filter-container">
                            <h2>Conver ke excel</h2>
                            
                            <select class="filter-select" id="sortFilter">
                                <option value="newest">blabla</option>
                            </select>
                        </div>

                    @if ($errorMessage)
                        <div class="alert alert-danger">
                            {{ $errorMessage }}
                        </div>
                    @endif

                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Feedback</th>
                                    <th>Nama Tamu</th>
                                    <th>Catatan Feedback</th>
                                    <th>Indeks Rating</th>
                                    <th>Mutu Rating</th>
                                    <th>Predikat Rating</th>
                                    <th>Tanggal Kedatangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($feedback as $index => $item)
                                    <tr>
                                        <td>{{ $feedback->firstItem() + $index }}</td>
                                        <td>#{{ $item->id }}</td>
                                        <td>{{ $item->penjadwalanTamu->subjek_tamu ?? '-' }}</td>
                                        <td>
                                            @if($item->catatan_feedback)
                                                <div class="feedback-note">
                                                    {{ Str::limit($item->catatan_feedback, 50) }}
                                                    @if(strlen($item->catatan_feedback) > 50)
                                                    <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $item->id }}">Selengkapnya</a>
                                                    @endif
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $item->indeks_rating_pelayanan }}</td>
                                        <td>{{ $item->mutu_rating_pelayanan }}</td>
                                        <td>
                                                @php
                                                    switch ($item->predikat_rating_pelayanan) {
                                                        case 'Sangat Baik':
                                                            $predikatClass = 'rating-blue'; // Biru
                                                            break;
                                                        case 'Baik':
                                                            $predikatClass = 'rating-green'; // Hijau
                                                            break;
                                                        case 'Kurang Baik':
                                                            $predikatClass = 'rating-yellow'; // Kuning
                                                            break;
                                                        case 'Tidak Baik':
                                                            $predikatClass = 'rating-red'; // Merah
                                                            break;
                                                        default:
                                                            $predikatClass = 'rating-default';
                                                    }
                                                @endphp

                                            <span class="rating-badge {{ $predikatClass }}">{{ $item->predikat_rating_pelayanan }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->penjadwalanTamu->waktu_tamu_mendarat)->translatedFormat('d F Y, \\p\\u\\k\\u\\l H:i') }} WIB</td>
                                    </tr>
                                    
                                    <!-- Modal for full feedback note -->
                                    <div class="modal fade" id="feedbackModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Feedback Lengkap</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{ $item->catatan_feedback }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-state">
                                                <i class="fas fa-comment-slash"></i>
                                                <h4>Belum ada data feedback</h4>
                                                <p>Feedback dari tamu akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    {{-- Pagination --}}
                    @if($feedback->hasPages())
                    <div class="pagination-container">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($feedback->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $feedback->previousPageUrl() }}" rel="prev"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($feedback->getUrlRange(1, $feedback->lastPage()) as $page => $url)
                                    @if ($page == $feedback->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($feedback->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $feedback->nextPageUrl() }}" rel="next"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/components.js') }}"></script>
    <script src="{{ asset('js/manage-tamu.js') }}"></script>

    <script>
    // Filter functionality (contoh implementasi)
    document.addEventListener('DOMContentLoaded', function() {
        const ratingFilter = document.getElementById('ratingFilter');
        const sortFilter = document.getElementById('sortFilter');
        
        ratingFilter.addEventListener('change', applyFilters);
        sortFilter.addEventListener('change', applyFilters);
        
        function applyFilters() {
            // Implementasi filter dan sorting bisa dilakukan di sini
            // Bisa melalui AJAX request ke server atau filtering client-side
            console.log('Filter applied:', ratingFilter.value, sortFilter.value);
            // Untuk implementasi lengkap, perlu menambahkan logika AJAX
        }
        
        // Toast notification
        @if(session('success'))
            setTimeout(function() {
                const toast = document.getElementById('toast');
                if(toast) {
                    toast.classList.add('show');
                    setTimeout(function() {
                        toast.classList.remove('show');
                    }, 3000);
                }
            }, 500);
        @endif
    });
    </script>
</body>
</html>