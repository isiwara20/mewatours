<?php
/**
 * Mewa Tours - Public Header Partial Component
 */
$pageTitle = $page_title ?? 'Mewa Tours - Sri Lanka Tourism';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="Explore luxury custom tour packages, Sri Lankan heritage, wildlife safaris, and pristine beaches with Mewa Tours.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6.4.0 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Application CSS -->
    <link rel="stylesheet" href="<?= asset_url('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/reset.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/components.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/responsive.css') ?>">
</head>
<body>

    <!-- Glassmorphic Header / Navigation Bar -->
    <header class="site-header" id="siteHeader">
        <div class="container header-container">
            <a href="<?= base_url() ?>" class="brand-logo" id="headerLogoLink">
                <img src="<?= asset_url('images/branding/mewa-tours-logo.jpeg') ?>" alt="Mewa Tours Logo" class="logo-img" id="mainLogoImg" onerror="this.src='https://placehold.co/180x60/ffffff/004080?text=MEWA+TOURS'">
            </a>

            <nav class="public-nav" id="mainPublicNav">
                <ul class="nav-list">
                    <li><a href="<?= base_url() ?>" class="nav-link">Home</a></li>
                    <li><a href="<?= base_url('tours') ?>" class="nav-link">Tours</a></li>
                    <li><a href="<?= base_url('destinations') ?>" class="nav-link">Destinations</a></li>
                    <li><a href="<?= base_url('experiences') ?>" class="nav-link">Experiences</a></li>
                    <li><a href="<?= base_url('gallery') ?>" class="nav-link">Gallery</a></li>
                    <li><a href="<?= base_url('about') ?>" class="nav-link">About Us</a></li>
                    <li><a href="<?= base_url('contact') ?>" class="nav-link btn-nav-cta">Enquire Now</a></li>
                </ul>
            </nav>

            <button class="mobile-toggle-btn" id="mobileMenuToggle" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <?php render_partial('flash-messages'); ?>
        </div>
