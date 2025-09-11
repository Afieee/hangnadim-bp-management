    <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <img src="{{ asset('/storage/images/logo_bp.png') }}" alt="User Profile">
                    <div class="logo-text">
                        <strong>BP BATAM</strong><br>
                        <div style="color: #d49c24">Direktorat Pengelolaan Kawasan Bandara</div>
                    </div>
                </div>
                <div class="sidebar-close" id="sidebar-close">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <ul class="sidebar-menu">
                @if (Auth::user()->role == "Admin")
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="/jadwalkan-inspeksi"><i class="fas fa-calendar-alt"></i> Jadwalkan Inspeksi</a></li>
                    <li><a href="/halaman-inspeksi-petugas"><i class="fas fa-clipboard-check"></i> Monitoring Inspeksi</a></li>
                    <li><a href="/halaman-tindak-lanjut-laporan-pribadi"><i class="fas fa-exclamation-triangle"></i> Monitor Crash Condition</a></li>  
                    <li><a href="/halaman-rekapitulasi-kerusakan"><i class="fas fa-exclamation-triangle"></i> Rekapitulasi Inspeksi</a></li>   
                    <li><a href="/manage-kedatangan"><i class="fas fa-plane-arrival"></i>  Management Kedatangan VVIP</a></li>
                    <li><a href="/halaman-data-feedback"><i class="fas fa-history"></i> History Feedback Tamu</a></li>
                    <li><a href="/manage-user"><i class="fas fa-users"></i> Pengguna & Petugas</a></li>

                @elseif (Auth::user()->role == "Kepala Seksi")
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="/jadwalkan-inspeksi"><i class="fas fa-calendar-alt"></i> Jadwalkan Inspeksi</a></li>
                    <li><a href="/halaman-inspeksi-petugas"><i class="fas fa-clipboard-check"></i> Monitoring Inspeksi</a></li>
                    <li><a href="/halaman-tindak-lanjut-laporan-pribadi"><i class="fas fa-exclamation-triangle"></i> Monitor Crash Condition</a></li>  
                    <li><a href="/halaman-rekapitulasi-kerusakan"><i class="fas fa-exclamation-triangle"></i> Rekapitulasi Inspeksi</a></li>   
                    <li><a href="/manage-kedatangan"><i class="fas fa-plane-arrival"></i>  Management Kedatangan VVIP</a></li>

                @elseif (Auth::user()->role == "Staff Pelaksana")

                    <li><a href="/dashboard"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="/halaman-inspeksi-petugas"><i class="fas fa-clipboard-check"></i> Proses Inspeksi Mingguan</a></li>
                    <li><a href="/halaman-manajemen-kerusakan-parah"><i class="fas fa-exclamation-triangle"></i> Laporan Kerusakan Parah</a></li>
                    <li><a href="/halaman-laporan-pribadi"><i class="fas fa-file-alt"></i> Laporkan Crash Condition</a></li>
                    <li><a href="/halaman-tindak-lanjut-laporan-pribadi"><i class="fas fa-exclamation-triangle"></i> Tindak Crash Condition</a></li>

                @elseif (Auth::user()->role == "Tata Usaha")
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="/manage-kedatangan"><i class="fas fa-plane-arrival"></i>  Management Kedatangan VVIP</a></li>
                    <li><a href="/halaman-data-feedback"><i class="fas fa-history"></i> History Feedback Tamu</a></li>
                    
                @elseif (in_array(Auth::user()->role, ['Direktur', 'Kepala Sub Direktorat']))
                    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="/manage-kedatangan"><i class="fas fa-plane-arrival"></i>  Management Kedatangan VVIP</a></li>
                    <li><a href="/halaman-data-feedback"><i class="fas fa-history"></i> History Feedback Tamu</a></li>
                @endif
            </ul>
        </div>

    
