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
            @if (Auth::user()->role == 'Admin')
                <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="/jadwalkan-inspeksi"><i class="fas fa-calendar-alt"></i> Jadwalkan Inspeksi</a></li>
                <li><a href="/halaman-inspeksi-petugas"><i class="fas fa-clipboard-check"></i> Monitoring Inspeksi</a>
                </li>
                <li>
                    <a href="/halaman-tindak-lanjut-laporan-pribadi">
                        <i class="fas fa-exclamation-triangle"></i> Monitor Crash Condition
                    </a>
                </li>
                <li>
                    <a href="/halaman-rekapitulasi-kerusakan">
                        <i class="fas fa-tools"></i> Rekapitulasi Inspeksi
                    </a>
                </li>

                <li><a href="/manage-kedatangan"><i class="fas fa-plane-arrival"></i> Laporan Penggunaan Gedung VIP &
                        VVIP</a></li>
                <li><a href="/halaman-data-feedback"><i class="fas fa-history"></i> Riwayat Respons Pengguna Gedung VIP
                        & VVIP</a></li>


                <li><a href="/kendaraan"><i class="fas fa-car"></i> Asset Kendaraan</a></li>
                <li><a href="/manage-user"><i class="fas fa-users"></i> Akses & Akun</a></li>
            @elseif (Auth::user()->role == 'Kepala Seksi')
                <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="/jadwalkan-inspeksi"><i class="fas fa-calendar-alt"></i> Jadwalkan Inspeksi</a></li>
                <li><a href="/halaman-inspeksi-petugas"><i class="fas fa-clipboard-check"></i> Monitoring Inspeksi</a>
                </li>
                <li><a href="/halaman-tindak-lanjut-laporan-pribadi"><i class="fas fa-exclamation-triangle"></i> Monitor
                        Crash Condition</a></li>
                <li><a href="/halaman-rekapitulasi-kerusakan"><i class="fas fa-exclamation-triangle"></i> Rekapitulasi
                        Inspeksi</a></li>
                <li><a href="/manage-kedatangan"><i class="fas fa-plane-arrival"></i> Laporan Penggunaan Gedung VIP &
                        VVIP</a></li>
            @elseif (Auth::user()->role == 'Staff Pelaksana')
                <li><a href="/dashboard"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="/halaman-inspeksi-petugas"><i class="fas fa-clipboard-check"></i> Proses Inspeksi
                        Mingguan</a></li>
                <li><a href="/halaman-manajemen-kerusakan-parah"><i class="fas fa-exclamation-triangle"></i> Laporan
                        Kerusakan Parah</a></li>
                <li><a href="/halaman-laporan-pribadi"><i class="fas fa-file-alt"></i> Laporkan Crash Condition</a></li>
                <li><a href="/halaman-tindak-lanjut-laporan-pribadi"><i class="fas fa-exclamation-triangle"></i> Tindak
                        Crash Condition</a></li>
                <li><a href="/halaman-laporan-kerusakan-kendaraan"><i class="fas fa-car"></i> Laporkan Kerusakan
                        Kendaraan</a></li>
                <li><a href="/tindak-kerusakan-kendaraan"><i class="fas fa-car"></i> Tindakan Kerusakan
                        Kendaraan</a></li>
                {{-- asd --}}
            @elseif (Auth::user()->role == 'Tata Usaha')
                <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="/manage-kedatangan"><i class="fas fa-plane-arrival"></i> Laporan Penggunaan Gedung VIP &
                        VVIP</a></li>
                <li><a href="/halaman-data-feedback"><i class="fas fa-history"></i> Riwayat Respons Pengguna Gedung VIP
                        & VVIP</a></li>
            @elseif (in_array(Auth::user()->role, ['Direktur', 'Kepala Sub Direktorat', 'Deputi']))
                <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="/manage-kedatangan"><i class="fas fa-plane-arrival"></i> Laporan Penggunaan Gedung VIP &
                        VVIP</a></li>
                <li><a href="/halaman-data-feedback"><i class="fas fa-history"></i> Riwayat Respons Pengguna Gedung VIP
                        & VVIP</a></li>
            @elseif (Auth::user()->role == 'IT')
                <li><a href="/dashboard"><i class="fas fa-home"></i> Home</a></li>
                <li>
                    <a href="/halaman-rekapitulasi-kerusakan">
                        <i class="fas fa-tools"></i> Rekapitulasi Inspeksi
                    </a>
                </li>
                <li><a href="/halaman-inspeksi-petugas"><i class="fas fa-clipboard-check"></i> Proses Inspeksi
                        Mingguan</a></li>
                <li><a href="/halaman-manajemen-kerusakan-parah"><i class="fas fa-exclamation-triangle"></i> Laporan
                        Kerusakan Parah</a></li>
                <li><a href="/halaman-laporan-pribadi"><i class="fas fa-file-alt"></i> Laporkan Crash Condition</a></li>
                <li><a href="/halaman-tindak-lanjut-laporan-pribadi"><i class="fas fa-exclamation-triangle"></i> Tindak
                        Crash Condition</a></li>
            @endif
        </ul>
    </div>
