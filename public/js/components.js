document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.getElementById('content-wrapper');
    const sidebarClose = document.getElementById('sidebar-close');

    function toggleSidebar() {
        sidebar.classList.toggle('collapsed');
        contentWrapper.classList.toggle('expanded');
    }

    menuToggle.addEventListener('click', toggleSidebar);
    sidebarClose.addEventListener('click', toggleSidebar);

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function (event) {
        if (window.innerWidth <= 992) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnMenuToggle = menuToggle.contains(event.target);
            const isClickOnSidebarClose = sidebarClose.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnMenuToggle && !isClickOnSidebarClose) {
                sidebar.classList.add('collapsed');
                contentWrapper.classList.remove('expanded');
            }
        }
    });
});
