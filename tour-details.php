<?php
declare(strict_types=1);

/**
 * Mewa Tours - Individual Tour Details Entry Point
 */
require_once __DIR__ . '/config/init.php';

$slug = $_GET['slug'] ?? '';
if (empty($slug)) {
    // If slug not passed via GET query parameter, attempt parsing URI path segment
    $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $segments = explode('/', $path);
    $slug = end($segments);
}

$controller = new TourController();
$controller->details($slug);
