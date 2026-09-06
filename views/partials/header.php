<?php
/**
 * Mewa Tours - Public Header Partial Component
 */
$pageTitle = $page_title ?? 'Mewa Tours - Authentic Sri Lankan Travel & Tour Packages';

// Accurate route calculation relative to base_url
$reqPath = strtolower(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
$cleanPath = trim(preg_replace('#^/mewatours#i', '', $reqPath), '/');

$isHome = ($cleanPath === '' || $cleanPath === 'index.php');
$isTours = (str_starts_with($cleanPath, 'tours') || str_starts_with($cleanPath, 'tour-details'));
$isDestinations = (str_starts_with($cleanPath, 'destinations') || str_starts_with($cleanPath, 'destination-details'));
$isExperiences = (str_starts_with($cleanPath, 'experiences') || str_starts_with($cleanPath, 'experience-details'));
$isAbout = (str_starts_with($cleanPath, 'about'));
$isGallery = (str_starts_with($cleanPath, 'gallery'));
$isReviews = (str_starts_with($cleanPath, 'reviews'));
$isContact = (str_starts_with($cleanPath, 'contact'));
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
    <?php if (!empty($isAbout)): ?>
        <link rel="stylesheet" href="<?= asset_url('css/about.css') ?>">
    <?php endif; ?>
    <?php if (!empty($isReviews)): ?>
        <link rel="stylesheet" href="<?= asset_url('css/reviews.css') ?>">
    <?php endif; ?>
    <?php if (!empty($isContact)): ?>
        <link rel="stylesheet" href="<?= asset_url('css/contact.css') ?>">
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
                    <li class="nav-item-dropdown" id="toursDropdownItem">
                        <button type="button"
                                class="nav-link nav-tours-trigger"
                                id="toursDropdownTrigger"
                                aria-haspopup="true"
                                aria-expanded="false"
                                aria-controls="toursDropdownMenu">
                            Tours <i class="fa-solid fa-chevron-down tours-chevron"></i>
                        </button>
                        <div class="tours-dropdown-menu" id="toursDropdownMenu" role="menu" aria-label="Tour Categories">
                            <div class="tours-dropdown-inner">
                                <a href="<?= base_url('tours') ?>" class="tours-dropdown-item tours-dropdown-all" role="menuitem">
                                    <i class="fa-solid fa-globe"></i> All Tours
                                </a>
                                <div class="tours-dropdown-divider"></div>
                                <a href="<?= base_url('tours') ?>?category=heritage-culture" class="tours-dropdown-item" role="menuitem" data-category-slug="heritage-culture">
                                    <i class="fa-solid fa-landmark"></i> Heritage &amp; Culture
                                </a>
                                <a href="<?= base_url('tours') ?>?category=wildlife-nature" class="tours-dropdown-item" role="menuitem" data-category-slug="wildlife-nature">
                                    <i class="fa-solid fa-paw"></i> Wildlife &amp; Nature
                                </a>
                                <a href="<?= base_url('tours') ?>?category=hill-country" class="tours-dropdown-item" role="menuitem" data-category-slug="hill-country">
                                    <i class="fa-solid fa-mountain"></i> Hill Country
                                </a>
                                <a href="<?= base_url('tours') ?>?category=coastal-beach" class="tours-dropdown-item" role="menuitem" data-category-slug="coastal-beach">
                                    <i class="fa-solid fa-umbrella-beach"></i> Coastal &amp; Beach
                                </a>
                                <a href="<?= base_url('tours') ?>?category=adventure" class="tours-dropdown-item" role="menuitem" data-category-slug="adventure">
                                    <i class="fa-solid fa-person-hiking"></i> Adventure
                                </a>
                                <a href="<?= base_url('tours') ?>?category=romantic" class="tours-dropdown-item" role="menuitem" data-category-slug="romantic">
                                    <i class="fa-solid fa-heart"></i> Romantic
                                </a>
                            </div>
                        </div>
                    </li>
                    <li><a href="<?= base_url('destinations') ?>" class="nav-link <?= $isDestinations ? 'active' : '' ?>">Destinations</a></li>
                    <li><a href="<?= base_url('experiences') ?>" class="nav-link <?= $isExperiences ? 'active' : '' ?>">Experiences</a></li>
                    <li><a href="<?= base_url('about') ?>" class="nav-link <?= $isAbout ? 'active' : '' ?>">About Us</a></li>
                    <li><a href="<?= base_url('gallery') ?>" class="nav-link <?= $isGallery ? 'active' : '' ?>">Gallery</a></li>
                    <li><a href="<?= base_url('reviews') ?>" class="nav-link <?= $isReviews ? 'active' : '' ?>">Reviews</a></li>
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
            <a href="<?= base_url() ?>" class="brand-logo-card drawer-nav-link">
                <img src="<?= asset_url('images/branding/logo.png') ?>" alt="Mewa Tours" class="logo-img">
            </a>
            <button class="drawer-close-btn" id="mobileMenuClose" aria-label="Close navigation menu">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <ul class="drawer-nav-list">
            <li><a href="<?= base_url() ?>" class="drawer-nav-link <?= $isHome ? 'active' : '' ?>">Home</a></li>
            <li class="drawer-tours-item" id="drawerToursItem">
                <button type="button"
                        class="drawer-nav-link drawer-tours-trigger"
                        id="drawerToursTrigger"
                        aria-expanded="false"
                        aria-controls="drawerToursSubmenu">
                    <span>Tours</span>
                    <i class="fa-solid fa-chevron-down drawer-tours-chevron"></i>
                </button>
                <ul class="drawer-tours-submenu" id="drawerToursSubmenu" aria-hidden="true">
                    <li><a href="<?= base_url('tours') ?>" class="drawer-sub-link"><i class="fa-solid fa-globe"></i> All Tours</a></li>
                    <li><a href="<?= base_url('tours') ?>?category=heritage-culture" class="drawer-sub-link"><i class="fa-solid fa-landmark"></i> Heritage &amp; Culture</a></li>
                    <li><a href="<?= base_url('tours') ?>?category=wildlife-nature" class="drawer-sub-link"><i class="fa-solid fa-paw"></i> Wildlife &amp; Nature</a></li>
                    <li><a href="<?= base_url('tours') ?>?category=hill-country" class="drawer-sub-link"><i class="fa-solid fa-mountain"></i> Hill Country</a></li>
                    <li><a href="<?= base_url('tours') ?>?category=coastal-beach" class="drawer-sub-link"><i class="fa-solid fa-umbrella-beach"></i> Coastal &amp; Beach</a></li>
                    <li><a href="<?= base_url('tours') ?>?category=adventure" class="drawer-sub-link"><i class="fa-solid fa-person-hiking"></i> Adventure</a></li>
                    <li><a href="<?= base_url('tours') ?>?category=romantic" class="drawer-sub-link"><i class="fa-solid fa-heart"></i> Romantic</a></li>
                </ul>
            </li>
            <li><a href="<?= base_url('destinations') ?>" class="drawer-nav-link <?= $isDestinations ? 'active' : '' ?>">Destinations</a></li>
            <li><a href="<?= base_url('experiences') ?>" class="drawer-nav-link <?= $isExperiences ? 'active' : '' ?>">Experiences</a></li>
            <li><a href="<?= base_url('about') ?>" class="drawer-nav-link <?= $isAbout ? 'active' : '' ?>">About Us</a></li>
            <li><a href="<?= base_url('gallery') ?>" class="drawer-nav-link <?= $isGallery ? 'active' : '' ?>">Gallery</a></li>
            <li><a href="<?= base_url('reviews') ?>" class="drawer-nav-link <?= $isReviews ? 'active' : '' ?>">Customer Reviews</a></li>
            <li><a href="<?= base_url('contact') ?>" class="drawer-nav-link <?= $isContact ? 'active' : '' ?>">Contact Us</a></li>
        </ul>
        <div class="drawer-cta-wrapper">
            <a href="<?= base_url('contact') ?>" class="btn btn-primary btn-block">Plan My Journey</a>
        </div>
    </div>

    <main class="main-content">
        <?php render_partial('flash-messages'); ?>
