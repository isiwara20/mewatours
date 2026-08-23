<?php
declare(strict_types=1);

/**
 * Admin Inquiries Management Entry Point & Sub-route Dispatcher
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    if ($action === 'update_status') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->inquiriesUpdateStatus($id);
        exit;
    }
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->inquiriesDelete($id);
        exit;
    }
}

switch ($action) {
    case 'show':
    case 'view':
        $id = (int)($_GET['id'] ?? 0);
        $controller->inquiriesShow($id);
        break;

    case 'index':
    default:
        $controller->inquiries();
        break;
}
