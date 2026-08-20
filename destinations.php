<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Destinations Entry Point
 */
require_once __DIR__ . '/config/init.php';

$controller = new DestinationController();
$controller->index();
