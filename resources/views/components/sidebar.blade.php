    <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h3>                    
                    <img src="{{ asset('/storage/images/logo_bp.png') }}" alt="User Profile" style="width: 100px; height: 100px;">
                    BP Batam
                </h3>
                <div class="sidebar-close" id="sidebar-close">
                    <i class="fas fa-times"></i>
                </div> 
            </div>
            <ul class="sidebar-menu">
                @if (Auth::user()->role == "Kepala Seksi")
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="/jadwalkan-inspeksi"><i class="fas fa-calendar-alt"></i> Jadwalkan Inspeksi</a></li>
                    <li><a href="/halaman-inspeksi-petugas"><i class="fas fa-clipboard-check"></i> Monitoring Inspeksi</a></li>
                    <li><a href="/manage-kedatangan"><i class="fas fa-plane-arrival"></i>  Manage Kedatangan</a></li>
                    <li><a href="/halaman-data-feedback"><i class="fas fa-history"></i> History Feedback Tamu</a></li>
                    <li><a href="/manage-user"><i class="fas fa-users"></i> Pengguna & Petugas</a></li>
                @elseif (Auth::user()->role == "Staff Pelaksana")
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="/halaman-inspeksi-petugas"><i class="fas fa-clipboard-check"></i> Proses Inspeksi</a></li>
                @endif

            </ul>
        </div>

    
