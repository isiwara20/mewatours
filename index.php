<?php
declare(strict_types=1);

/**
 * Mewa Tours - Main Root Entry Point (Home Page)
 */
require_once __DIR__ . '/config/init.php';

$controller = new HomeController();
$controller->index();
