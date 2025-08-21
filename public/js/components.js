document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.getElementById('content-wrapper');
    const sidebarClose = document.getElementById('sidebar-close');

    if (!sidebar || !menuToggle) return;

    const isMobile = () => window.innerWidth <= 992;

    function isSidebarOpen() {
        // Di mobile: .collapsed = TERBUKA, di desktop: .collapsed = TERTUTUP
        return isMobile()
            ? sidebar.classList.contains('collapsed')
            : !sidebar.classList.contains('collapsed');
    }

    function openSidebar() {
        if (isMobile()) {
            // Mobile: pakai .collapsed untuk MEMBUKA
            sidebar.classList.add('collapsed');
        } else {
            // Desktop: hapus .collapsed untuk MEMBUKA
            sidebar.classList.remove('collapsed');
        }
        if (contentWrapper) contentWrapper.classList.add('expanded');
    }

    function closeSidebar() {
        if (isMobile()) {
            // Mobile: hapus .collapsed untuk MENUTUP
            sidebar.classList.remove('collapsed');
        } else {
            // Desktop: tambah .collapsed untuk MENUTUP
            sidebar.classList.add('collapsed');
        }
        if (contentWrapper) contentWrapper.classList.remove('expanded');
    }

    // Keadaan awal: mobile tertutup, desktop terbuka
    if (isMobile()) {
        closeSidebar();
    } else {
        sidebar.classList.remove('collapsed');
        if (contentWrapper) contentWrapper.classList.remove('expanded');
    }

    menuToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        if (isSidebarOpen()) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    if (sidebarClose) {
        sidebarClose.addEventListener('click', function (e) {
            e.stopPropagation();
            closeSidebar();
        });
    }

    // Cegah klik di dalam sidebar menutupnya
    sidebar.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    // Klik di area luar menutup sidebar (HANYA di mobile & ketika terbuka)
    document.addEventListener('click', function (e) {
        if (!isMobile()) return;
        if (!isSidebarOpen()) return;

        const clickedInsideSidebar = sidebar.contains(e.target);
        const clickedMenuToggle = menuToggle.contains(e.target);
        const clickedSidebarClose = sidebarClose ? sidebarClose.contains(e.target) : false;

        if (!clickedInsideSidebar && !clickedMenuToggle && !clickedSidebarClose) {
            closeSidebar();
        }
    });

    // Sinkronkan saat resize
    window.addEventListener('resize', function () {
        if (isMobile()) {
            // pastikan tertutup saat pindah ke mobile
            closeSidebar();
        } else {
            // pastikan terbuka saat kembali ke desktop
            sidebar.classList.remove('collapsed');
            if (contentWrapper) contentWrapper.classList.remove('expanded');
        }
    });
});
