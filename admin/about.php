<?php
declare(strict_types=1);

/**
 * Mewa Tours - Admin About Us Management Entry Point & Sub-route Dispatcher
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    $controller->aboutUpdate();
    exit;
}

$controller->about();
