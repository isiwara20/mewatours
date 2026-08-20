<?php
declare(strict_types=1);

/**
 * Admin Dashboard Entry Point
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$controller->dashboard();
