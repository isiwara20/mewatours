/**
 * Mewa Tours - Navigation & Mobile Drawer Interaction
 */
document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('mobileMenuToggle');
    const publicNav = document.getElementById('mainPublicNav');

    if (toggleBtn && publicNav) {
        toggleBtn.addEventListener('click', () => {
            publicNav.classList.toggle('active');
            const icon = toggleBtn.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-xmark');
            }
        });
    }
});
