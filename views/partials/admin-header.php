<?php
/**
 * Mewa Tours - Admin Header Partial Component
 */
$pageTitle = $page_title ?? 'Mewa Tours Admin Portal';
$currentAdmin = $_SESSION['admin'] ?? ['name' => 'Administrator'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    
    <!-- Google Fonts for Admin -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= asset_url('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/reset.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/admin.css') ?>">
</head>
<body class="admin-body">

    <div class="admin-wrapper">
        <?php render_partial('admin-sidebar'); ?>

        <div class="admin-main-wrapper">
            <header class="admin-topbar">
                <div class="topbar-left">
                    <button id="adminSidebarToggle" class="sidebar-toggle-btn"><i class="fa-solid fa-bars"></i></button>
                    <span class="portal-badge">Mewa Tours Admin Portal</span>
                </div>
                <div class="topbar-right">
                    <span class="admin-user-name"><i class="fa-solid fa-user-shield"></i> <?= e($currentAdmin['name']) ?></span>
                    <a href="<?= base_url('logout') ?>" class="admin-logout-link" title="Sign Out"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </header>

            <main class="admin-content-body">
                <div class="admin-container">
                    <?php render_partial('flash-messages'); ?>
