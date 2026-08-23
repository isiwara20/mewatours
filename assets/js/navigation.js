/**
 * Mewa Tours - Navigation & Mobile Drawer Interaction Logic
 */
document.addEventListener('DOMContentLoaded', () => {
    const siteHeader = document.getElementById('siteHeader');
    const toggleBtn = document.getElementById('mobileMenuToggle');
    const closeBtn = document.getElementById('mobileMenuClose');
    const drawerMenu = document.getElementById('mobileDrawerMenu');
    const drawerOverlay = document.getElementById('mobileDrawerOverlay');
    const drawerLinks = document.querySelectorAll('.drawer-nav-link');

    // 1. Sticky Header Background Transition on Scroll
    window.addEventListener('scroll', () => {
        if (window.scrollY > 40) {
            siteHeader.classList.add('scrolled');
        } else {
            siteHeader.classList.remove('scrolled');
        }
    });

    // 2. Open Mobile Drawer Menu
    function openMobileMenu() {
        if (drawerMenu && drawerOverlay) {
            drawerMenu.classList.add('active');
            drawerOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            if (toggleBtn) {
                toggleBtn.setAttribute('aria-expanded', 'true');
            }
        }
    }

    // 3. Close Mobile Drawer Menu
    function closeMobileMenu() {
        if (drawerMenu && drawerOverlay) {
            drawerMenu.classList.remove('active');
            drawerOverlay.classList.remove('active');
            document.body.style.overflow = '';
            if (toggleBtn) {
                toggleBtn.setAttribute('aria-expanded', 'false');
            }
        }
    }

    if (toggleBtn) toggleBtn.addEventListener('click', openMobileMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMobileMenu);
    if (drawerOverlay) drawerOverlay.addEventListener('click', closeMobileMenu);

    // Close mobile menu on clicking any drawer link
    drawerLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // Close mobile menu on pressing Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && drawerMenu && drawerMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
});
