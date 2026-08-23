<?php
/**
 * Mewa Tours - Admin Sidebar Partial Component
 */
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$path = parse_url($requestUri, PHP_URL_PATH) ?? '';

$isDashboard = (bool)preg_match('#/admin/dashboard#i', $path);
$isTours = (bool)preg_match('#/admin/tours#i', $path);
$isDestinations = (bool)preg_match('#/admin/destinations#i', $path);
$isExperiences = (bool)preg_match('#/admin/experiences#i', $path);
$isGallery = (bool)preg_match('#/admin/gallery#i', $path);
$isInquiries = (bool)preg_match('#/admin/inquiries#i', $path);
$isSettings = (bool)preg_match('#/admin/settings#i', $path);
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
                <a href="<?= base_url('admin/dashboard') ?>" class="<?= $isDashboard ? 'active' : '' ?>">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/tours') ?>" class="<?= $isTours ? 'active' : '' ?>">
                    <i class="fa-solid fa-route"></i> Tour Packages
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/destinations') ?>" class="<?= $isDestinations ? 'active' : '' ?>">
                    <i class="fa-solid fa-location-dot"></i> Destinations
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/experiences') ?>" class="<?= $isExperiences ? 'active' : '' ?>">
                    <i class="fa-solid fa-compass"></i> Experiences
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/gallery') ?>" class="<?= $isGallery ? 'active' : '' ?>">
                    <i class="fa-solid fa-images"></i> Gallery
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/inquiries') ?>" class="<?= $isInquiries ? 'active' : '' ?>">
                    <i class="fa-solid fa-envelope-open-text"></i> Inquiries
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/settings') ?>" class="<?= $isSettings ? 'active' : '' ?>">
                    <i class="fa-solid fa-sliders"></i> Settings
                </a>
            </li>
        </ul>
    </nav>
</aside>
