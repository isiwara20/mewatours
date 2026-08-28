<?php
declare(strict_types=1);

/**
 * Admin Customer Reviews Management Entry Point & Sub-route Dispatcher
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    if ($action === 'update_status') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->reviewsUpdateStatus($id);
        exit;
    }
    if ($action === 'toggle_featured') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->reviewsToggleFeatured($id);
        exit;
    }
    if ($action === 'reply') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->reviewsReply($id);
        exit;
    }
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->reviewsDelete($id);
        exit;
    }
}

switch ($action) {
    case 'index':
    default:
        $controller->reviews();
        break;
}
