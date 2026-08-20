<?php
declare(strict_types=1);

/**
 * Mewa Tours - Public Tours Listing Entry Point
 */
require_once __DIR__ . '/config/init.php';

$controller = new TourController();
$controller->index();
