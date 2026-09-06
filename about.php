<?php
declare(strict_types=1);

/**
 * Mewa Tours - About Us Page Entry Point
 */
require_once __DIR__ . '/config/init.php';

$aboutBLL = new AboutBLL();
$aboutData = $aboutBLL->getAboutData();

render_view('client/about', [
    'page_title' => $aboutData['about_meta_title'] ?? 'About Us - Mewan Manju Sri Kandearachchi | Mewa Tours Sri Lanka',
    'meta_description' => $aboutData['about_meta_description'] ?? null,
    'about' => $aboutData
]);
