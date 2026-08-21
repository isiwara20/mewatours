<?php
declare(strict_types=1);

/**
 * Admin Gallery Management Entry Point & Sub-route Dispatcher
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    if ($action === 'create' || $action === 'store') {
        $controller->galleryStore();
        exit;
    }
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->galleryDelete($id);
        exit;
    }
}

$controller->gallery();
