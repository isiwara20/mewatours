<?php
declare(strict_types=1);

/**
 * Admin Experiences Entry Point
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$controller->experiences();
