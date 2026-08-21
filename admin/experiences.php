<?php
declare(strict_types=1);

/**
 * Admin Experiences Management Entry Point & Sub-route Dispatcher
 */
require_once __DIR__ . '/../config/init.php';

$controller = new AdminController();
$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    if ($action === 'create' || $action === 'store') {
        $controller->experiencesStore();
        exit;
    }
    if ($action === 'edit' || $action === 'update') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->experiencesUpdate($id);
        exit;
    }
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $controller->experiencesDelete($id);
        exit;
    }
}

switch ($action) {
    case 'create':
        $controller->experiencesCreate();
        break;

    case 'edit':
        $id = (int)($_GET['id'] ?? 0);
        $controller->experiencesEdit($id);
        break;

    case 'index':
    default:
        $controller->experiences();
        break;
}
