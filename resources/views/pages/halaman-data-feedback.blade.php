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
    <link rel="stylesheet" href="{{ asset('css/halaman-data-feedback.css') }}">


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

                    @if($errorMessage)
                        <div class="alert alert-danger">
                            {!! $errorMessage !!}
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