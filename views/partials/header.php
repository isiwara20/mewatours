<?php
/**
 * Mewa Tours - Public Header Partial Component
 */
$pageTitle = $page_title ?? 'Mewa Tours - Authentic Sri Lankan Travel & Tour Packages';

// Accurate route calculation relative to base_url
$reqPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
$basePath = parse_url(base_url(), PHP_URL_PATH);
$routePath = '/' . trim(substr($reqPath, strlen($basePath)), '/');

$isHome = ($routePath === '/' || $routePath === '' || $routePath === '/index.php');
$isTours = (strpos($routePath, '/tours') === 0 || $routePath === '/tours.php');
$isDestinations = (strpos($routePath, '/destinations') === 0 || $routePath === '/destinations.php');
$isExperiences = (strpos($routePath, '/experiences') === 0 || $routePath === '/experiences.php');
$isAbout = ($routePath === '/about' || $routePath === '/about.php');
$isGallery = ($routePath === '/gallery' || $routePath === '/gallery.php');
$isContact = ($routePath === '/contact' || $routePath === '/contact.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="Experience authentic Sri Lankan luxury travel, tailor-made tour itineraries, cultural heritage, and wildlife safaris with Mewa Tours.">
    
    <!-- Favicon / Title Logo (Browser Search Bar / Tab Icon with White Background) -->
    <link rel="icon" type="image/png" href="<?= asset_url('images/branding/favicon.png') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= asset_url('images/branding/favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= asset_url('images/branding/favicon.png') ?>">
    
    <!-- Google Fonts: Playfair Display & Plus Jakarta Sans / Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <!-- Application CSS Architecture -->
    <link rel="stylesheet" href="<?= asset_url('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/reset.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/components.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/home.css') ?>">
    <?php if (!empty($isTours)): ?>
        <link rel="stylesheet" href="<?= asset_url('css/tours.css') ?>">
    <?php endif; ?>
    <?php if (!empty($isDestinations)): ?>
        <link rel="stylesheet" href="<?= asset_url('css/destinations.css') ?>">
    <?php endif; ?>
    <?php if (!empty($isExperiences)): ?>
        <link rel="stylesheet" href="<?= asset_url('css/experiences.css') ?>">
    <?php endif; ?>
    <?php if (!empty($isGallery)): ?>
        <link rel="stylesheet" href="<?= asset_url('css/gallery.css') ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= asset_url('css/responsive.css') ?>">
</head>
<body>

    <!-- Sticky Glassmorphic Header -->
    <header class="site-header" id="siteHeader">
        <div class="container header-container">
            <!-- White Logo Container Badge -->
            <a href="<?= base_url() ?>" class="brand-logo-card" id="headerLogoLink" aria-label="Mewa Tours Homepage">
                <img src="<?= asset_url('images/branding/logo.png') ?>" alt="Mewa Tours Sri Lanka Logo" class="logo-img" id="mainLogoImg">
            </a>

            <!-- Public Navigation Links -->
            <nav class="public-nav" id="mainPublicNav" aria-label="Main Navigation">
                <ul class="nav-list">
                    <li><a href="<?= base_url() ?>" class="nav-link <?= $isHome ? 'active' : '' ?>">Home</a></li>
                    <li><a href="<?= base_url('tours') ?>" class="nav-link <?= $isTours ? 'active' : '' ?>">Tours</a></li>
                    <li><a href="<?= base_url('destinations') ?>" class="nav-link <?= $isDestinations ? 'active' : '' ?>">Destinations</a></li>
                    <li><a href="<?= base_url('experiences') ?>" class="nav-link <?= $isExperiences ? 'active' : '' ?>">Experiences</a></li>
                    <li><a href="<?= base_url('about') ?>" class="nav-link <?= $isAbout ? 'active' : '' ?>">About Us</a></li>
                    <li><a href="<?= base_url('gallery') ?>" class="nav-link <?= $isGallery ? 'active' : '' ?>">Gallery</a></li>
                    <li><a href="<?= base_url('contact') ?>" class="nav-link <?= $isContact ? 'active' : '' ?>">Contact</a></li>
                </ul>
            </nav>

            <!-- Header Action CTA -->
            <div class="header-action">
                <a href="<?= base_url('contact') ?>" class="btn btn-header-cta">
                    Plan Your Trip <i class="fa-solid fa-arrow-right"></i>
                </a>
                <button class="mobile-toggle-btn" id="mobileMenuToggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobileDrawerMenu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer Overlay & Navigation -->
    <div class="mobile-drawer-overlay" id="mobileDrawerOverlay"></div>
    <div class="mobile-drawer-menu" id="mobileDrawerMenu">
        <div class="drawer-header">
            <a href="<?= base_url() ?>" class="brand-logo-card">
                <img src="<?= asset_url('images/branding/logo.png') ?>" alt="Mewa Tours" class="logo-img">
            </a>
            <button class="drawer-close-btn" id="mobileMenuClose" aria-label="Close navigation menu">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <ul class="drawer-nav-list">
            <li><a href="<?= base_url() ?>" class="drawer-nav-link <?= $isHome ? 'active' : '' ?>">Home</a></li>
            <li><a href="<?= base_url('tours') ?>" class="drawer-nav-link <?= $isTours ? 'active' : '' ?>">Tours</a></li>
            <li><a href="<?= base_url('destinations') ?>" class="drawer-nav-link <?= $isDestinations ? 'active' : '' ?>">Destinations</a></li>
            <li><a href="<?= base_url('experiences') ?>" class="drawer-nav-link <?= $isExperiences ? 'active' : '' ?>">Experiences</a></li>
            <li><a href="<?= base_url('about') ?>" class="drawer-nav-link <?= $isAbout ? 'active' : '' ?>">About Us</a></li>
            <li><a href="<?= base_url('gallery') ?>" class="drawer-nav-link <?= $isGallery ? 'active' : '' ?>">Gallery</a></li>
            <li><a href="<?= base_url('contact') ?>" class="drawer-nav-link <?= $isContact ? 'active' : '' ?>">Contact Us</a></li>
        </ul>
        <div class="drawer-cta-wrapper">
            <a href="<?= base_url('contact') ?>" class="btn btn-primary btn-block">Plan My Journey</a>
        </div>
    </div>

    <main class="main-content">
        <?php render_partial('flash-messages'); ?>
