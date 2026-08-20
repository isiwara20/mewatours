<?php
declare(strict_types=1);

/**
 * Admin Tours Management Entry Point
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$controller->tours();
