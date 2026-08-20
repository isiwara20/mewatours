<?php
declare(strict_types=1);

/**
 * Mewa Tours - Contact & Inquiry Entry Point
 */
require_once __DIR__ . '/config/init.php';

$controller = new ContactController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->submitInquiry();
} else {
    $controller->index();
}
