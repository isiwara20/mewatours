<?php
declare(strict_types=1);

/**
 * Mewa Tours - Admin Logout Entry Point
 */
require_once __DIR__ . '/config/init.php';

$controller = new AuthController();
$controller->logout();
