/**
 * Mewa Tours - Navigation & Mobile Drawer Interaction Logic
 */
document.addEventListener('DOMContentLoaded', () => {
    const siteHeader    = document.getElementById('siteHeader');
    const toggleBtn     = document.getElementById('mobileMenuToggle');
    const closeBtn      = document.getElementById('mobileMenuClose');
    const drawerMenu    = document.getElementById('mobileDrawerMenu');
    const drawerOverlay = document.getElementById('mobileDrawerOverlay');

    // Ensure body scroll is unlocked when page loads/restores
    document.body.style.overflow = '';

    // =========================================================================
    // 1. Sticky Header Background Transition on Scroll
    // =========================================================================
    window.addEventListener('scroll', () => {
        if (siteHeader) {
            siteHeader.classList.toggle('scrolled', window.scrollY > 40);
        }
    });


    // =========================================================================
    // 2. Open / Close Mobile Drawer Menu
    // =========================================================================
    function openMobileMenu() {
        if (drawerMenu && drawerOverlay) {
            drawerMenu.classList.add('active');
            drawerOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'true');
        }
    }

    function closeMobileMenu() {
        if (drawerMenu && drawerOverlay) {
            drawerMenu.classList.remove('active');
            drawerOverlay.classList.remove('active');
            document.body.style.overflow = '';
            if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
        }
    }

    if (toggleBtn)     toggleBtn.addEventListener('click', openMobileMenu);
    if (closeBtn)      closeBtn.addEventListener('click', closeMobileMenu);
    if (drawerOverlay) drawerOverlay.addEventListener('click', closeMobileMenu);

    // Close mobile menu when any drawer link is clicked
    document.querySelectorAll('#mobileDrawerMenu a').forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // Close mobile menu on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && drawerMenu && drawerMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });


    // =========================================================================
    // 3. DESKTOP TOURS DROPDOWN — Hover with leave-delay to prevent flicker
    // =========================================================================
    const dropdownItem    = document.getElementById('toursDropdownItem');
    const dropdownTrigger = document.getElementById('toursDropdownTrigger');
    const dropdownMenu    = document.getElementById('toursDropdownMenu');

    if (dropdownItem && dropdownTrigger && dropdownMenu) {
        let leaveTimer = null;

        // Mark trigger as "active" when we're on a tours page
        if (document.documentElement.classList.contains('page-tours') ||
            window.location.pathname.toLowerCase().includes('/tours') ||
            window.location.pathname.toLowerCase().includes('/tour-details')) {
            dropdownItem.classList.add('tours-active');
        }

        function openDropdown() {
            if (leaveTimer) { clearTimeout(leaveTimer); leaveTimer = null; }
            dropdownMenu.classList.add('open');
            dropdownTrigger.setAttribute('aria-expanded', 'true');
        }

        function closeDropdown() {
            dropdownMenu.classList.remove('open');
            dropdownTrigger.setAttribute('aria-expanded', 'false');
        }

        function scheduleClose() {
            leaveTimer = setTimeout(closeDropdown, 120);
        }

        // Hover on the parent <li>
        dropdownItem.addEventListener('mouseenter', openDropdown);
        dropdownItem.addEventListener('mouseleave', scheduleClose);

        // Cancel close if mouse re-enters the menu
        dropdownMenu.addEventListener('mouseenter', () => {
            if (leaveTimer) { clearTimeout(leaveTimer); leaveTimer = null; }
        });
        dropdownMenu.addEventListener('mouseleave', scheduleClose);

        // Keyboard: Enter / Space opens; Escape closes
        dropdownTrigger.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                if (dropdownMenu.classList.contains('open')) {
                    closeDropdown();
                } else {
                    openDropdown();
                    // Focus first item
                    const firstItem = dropdownMenu.querySelector('.tours-dropdown-item');
                    if (firstItem) firstItem.focus();
                }
            }
            if (e.key === 'Escape') {
                closeDropdown();
                dropdownTrigger.focus();
            }
        });

        // Arrow key navigation within dropdown items
        dropdownMenu.addEventListener('keydown', (e) => {
            const items = Array.from(dropdownMenu.querySelectorAll('.tours-dropdown-item'));
            const idx   = items.indexOf(document.activeElement);

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                const next = items[idx + 1] || items[0];
                if (next) next.focus();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                const prev = items[idx - 1] || items[items.length - 1];
                if (prev) prev.focus();
            } else if (e.key === 'Escape') {
                e.preventDefault();
                closeDropdown();
                dropdownTrigger.focus();
            } else if (e.key === 'Tab') {
                // Close when tabbing out of the last item
                if (!e.shiftKey && idx === items.length - 1) {
                    closeDropdown();
                } else if (e.shiftKey && idx === 0) {
                    closeDropdown();
                }
            }
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!dropdownItem.contains(e.target)) {
                closeDropdown();
            }
        });
    }


    // =========================================================================
    // 4. MOBILE DRAWER — Tours accordion submenu
    // =========================================================================
    const drawerToursTrigger  = document.getElementById('drawerToursTrigger');
    const drawerToursSubmenu  = document.getElementById('drawerToursSubmenu');

    if (drawerToursTrigger && drawerToursSubmenu) {
        drawerToursTrigger.addEventListener('click', () => {
            const isOpen = drawerToursSubmenu.classList.contains('open');

            if (isOpen) {
                drawerToursSubmenu.classList.remove('open');
                drawerToursSubmenu.setAttribute('aria-hidden', 'true');
                drawerToursTrigger.setAttribute('aria-expanded', 'false');
            } else {
                drawerToursSubmenu.classList.add('open');
                drawerToursSubmenu.setAttribute('aria-hidden', 'false');
                drawerToursTrigger.setAttribute('aria-expanded', 'true');
            }
        });

        // Close submenu links also close the whole mobile drawer
        drawerToursSubmenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
    }
});

