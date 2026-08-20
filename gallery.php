<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Photo Gallery Entry Point
 */
require_once __DIR__ . '/config/init.php';

$controller = new GalleryController();
$controller->index();
