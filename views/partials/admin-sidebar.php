<?php
/**
 * Mewa Tours - Admin Sidebar Partial Component
 */
$currentUri = current_url();
?>
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <a href="<?= base_url('admin/dashboard') ?>">
            <img src="<?= asset_url('images/branding/logo.png') ?>" alt="Mewa Tours Admin" class="admin-brand-logo" onerror="this.src='https://placehold.co/150x45/ffffff/004080?text=MEWA+ADMIN'">
        </a>
    </div>

    <nav class="sidebar-menu">
        <ul>
            <li>
                <a href="<?= base_url('admin/dashboard') ?>" class="<?= strpos($currentUri, 'dashboard') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/tours') ?>" class="<?= strpos($currentUri, 'tours') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-route"></i> Tour Packages
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/destinations') ?>" class="<?= strpos($currentUri, 'destinations') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-location-dot"></i> Destinations
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/experiences') ?>" class="<?= strpos($currentUri, 'experiences') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-compass"></i> Experiences
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/gallery') ?>" class="<?= strpos($currentUri, 'gallery') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-images"></i> Gallery
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/inquiries') ?>" class="<?= strpos($currentUri, 'inquiries') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-envelope-open-text"></i> Inquiries
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/settings') ?>" class="<?= strpos($currentUri, 'settings') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-sliders"></i> Settings
                </a>
            </li>
        </ul>
    </nav>
</aside>
