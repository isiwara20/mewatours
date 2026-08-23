<?php
declare(strict_types=1);

/**
 * Admin Settings Management Entry Point & Sub-route Dispatcher
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    if ($action === 'update_settings') {
        $controller->settingsUpdate();
        exit;
    }
    if ($action === 'update_profile') {
        $controller->profileUpdate();
        exit;
    }
    if ($action === 'update_password') {
        $controller->passwordUpdate();
        exit;
    }
}

$controller->settings();
