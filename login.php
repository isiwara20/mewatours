<?php
declare(strict_types=1);

/**
 * Mewa Tours - Private Admin Login Entry Point
 */
require_once __DIR__ . '/config/init.php';

$controller = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->login();
} else {
    $controller->showLoginForm();
}
