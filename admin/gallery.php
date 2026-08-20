<?php
declare(strict_types=1);

/**
 * Admin Gallery Entry Point
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$controller->gallery();
