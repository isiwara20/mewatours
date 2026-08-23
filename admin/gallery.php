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
    $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
    if ($action === 'create' || $action === 'store') {
        if ($id > 0) {
            $controller->galleryUpdate($id);
        } else {
            $controller->galleryStore();
        }
        exit;
    }
    if ($action === 'update' || $action === 'edit') {
        $controller->galleryUpdate($id);
        exit;
    }
    if ($action === 'delete') {
        $controller->galleryDelete($id);
        exit;
    }
}

$controller->gallery();
