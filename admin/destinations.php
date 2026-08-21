<?php
declare(strict_types=1);

/**
 * Admin Destinations Management Entry Point & Sub-route Dispatcher
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    if ($action === 'create' || $action === 'store') {
        $controller->destinationsStore();
        exit;
    }
    if ($action === 'edit' || $action === 'update') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->destinationsUpdate($id);
        exit;
    }
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->destinationsDelete($id);
        exit;
    }
}

switch ($action) {
    case 'create':
        $controller->destinationsCreate();
        break;

    case 'edit':
        $id = (int)($_GET['id'] ?? 0);
        $controller->destinationsEdit($id);
        break;

    case 'index':
    default:
        $controller->destinations();
        break;
}
