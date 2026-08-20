/**
 * Mewa Tours - Admin Portal Interaction Helper
 */
document.addEventListener('DOMContentLoaded', () => {
    const sidebarToggle = document.getElementById('adminSidebarToggle');
    const sidebar = document.getElementById('adminSidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    }
});
