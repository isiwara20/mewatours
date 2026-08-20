<?php
declare(strict_types=1);

/**
 * Admin Settings Entry Point
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$controller->settings();
